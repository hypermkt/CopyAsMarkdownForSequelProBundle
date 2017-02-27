#!/usr/bin/php
<?php

if (!isset($_ENV['TEST_ENV'])) {
    $c = new CopyAsMarkdown();
    $c->exec(fopen('php://stdin', 'r'));
}

class CopyAsMarkdown
{
    protected $_output;
    protected $_columnCount;

    public function exec($stdin)
    {
        $cmd = 'echo ' . escapeshellarg($this->convert($this->read($stdin))) . ' | __CF_USER_TEXT_ENCODING=' . posix_getuid() . ':0x8000100:0x8000100 pbcopy';
        exec($cmd);
    }

    protected function read($stdin)
    {
        $result = [];
        while ($row = fgetcsv($stdin, 0)) {
            array_push($result, $row);
        }
        return $result;
    }

    protected function convert(array $rows)
    {
        $this->_columnCount = $this->_calculateColumnCount($rows);
        $columns = array_shift($rows);
        $result = [];
        $result[] = $this->_createHeaderRows($columns);
        $result[] = $this->_createDataRows($rows);
        return implode("\n", $result);
    }

    protected function _createHeaderRows(array $columns)
    {
        $result = [];
        $str = '';
        foreach ($columns as $column) {
            $str .= '|' . $column;
        }
        $result[] = $str;

        $str = '';
        for ($i = 0; $i < count($columns); $i++) {
            $str .= '|---';
        }
        $result[] = $str;

        return implode("\n", $result);
    }

    protected function _calculateColumnCount(array $rows)
    {
        $count = 0;
        foreach ($rows as $row) {
            $c = count($row);
            if ($c > $count) {
                $count = $c;
            }
        }
        return $count;
    }

    protected function _createDataRows(array $rows)
    {
        $result = [];
        foreach ($rows as $row) {
            $str = '';
            foreach ($row as $val) {
                $str .= '|' . str_replace(array("\n", "\r"), '', nl2br($val));
            }
            $result[] = $str;
        }
        return implode("\n", $result);
    }
}
