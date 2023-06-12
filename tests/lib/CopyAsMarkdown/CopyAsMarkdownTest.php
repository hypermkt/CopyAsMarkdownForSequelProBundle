<?php

namespace lib\CopyAsMarkdown;

use CopyAsMarkdown;
use PHPUnit\Framework\TestCase;

class CopyAsMarkdownTest extends TestCase
{
    protected CopyAsMarkdownExtended $copyAsMarkdown;

    public function setUp(): void
    {
        $this->copyAsMarkdown = new CopyAsMarkdownExtended('hoge');
    }

    public function testCreateHeaderRows()
    {
        $expected = '|hoge|fuga
|---|---';
        $this->assertEquals($expected, $this->copyAsMarkdown->createHeaderRows(array('hoge', 'fuga')));
    }

    public function testCreateHeaderRows_WhenHasOneColumn()
    {
        $expected = '|hoge
|---';
        $this->assertEquals($expected, $this->copyAsMarkdown->createHeaderRows(array('hoge')));
    }

    public function testCalculateColumnCount()
    {
        $this->assertEquals(3, $this->copyAsMarkdown->calculateColumnCount(array(array('a', 'b', 'c'))));
    }

    public function testCreateDataRows()
    {
        $expected = '|a|b|c
|d|e|f';
        $this->assertEquals($expected, $this->copyAsMarkdown->createDataRows(array(
          array('a', 'b', 'c'),
          array('d', 'e', 'f'),
        )));
    }

    public function testCreateDataRows_WhenHasOneColumn()
    {
        $expected = '|a';
        $this->assertEquals($expected, $this->copyAsMarkdown->createDataRows(array(
          array('a'),
        )));
    }

    public function testCreateDataRows_ReturnLineFeedRemovedData_WhenHasLineFeedInData()
    {
        $expected = '|a|b1<br />b2<br />b3|c';
        $this->assertEquals($expected, $this->copyAsMarkdown->createDataRows(array(
          array('a', 'b1
b2
b3', 'c'),
        )));
    }
}

class CopyAsMarkdownExtended extends CopyAsMarkdown
{
    public function createHeaderRows(array $rows)
    {
        return parent::createHeaderRows($rows);
    }

    public function calculateColumnCount(array $rows)
    {
        return parent::calculateColumnCount($rows);
    }

    public function createDataRows(array $rows)
    {
        return parent::createDataRows($rows);
    }
}
