<?php

namespace CopyAsMarkdown;

class CopyAsMarkdown
{
  protected $_output;
  protected $_columnCount;

  public function convert(array $rows)
  {
    $this->_columnCount = $this->_calculateColumnCount($rows);
    $columns = array_shift($rows);
    $result = [];
    $result[]  =$this->_createHeaderRows($columns);
    $result[] = $this->_createDataRows($rows);
    return implode("\n", $result);
  }

  protected function _createHeaderRows(array $columns)
  {
    $result = [];
    $str = '';
    foreach ($columns as $column) {
      if (!empty($str)) {
        $str .= "|";
      }
      $str .= $column;
    }
    $result[] = $str;
    $str = '';
    for($i=0; $i<count($columns); $i++) {
      if (!empty($str)) {
        $str .= "|";
      }
      $str .= "---";
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
        if (!empty($str)) {
          $str .= "|";
        }
        $str .= $val;
      }
      $result[] = $str;
    }
    return implode("\n", $result);
  }
}
