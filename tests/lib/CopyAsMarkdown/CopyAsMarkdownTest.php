<?php

require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/lib/CopyAsMarkdown/CopyAsMarkdown.php';

class CopyAsMarkdownTest extends PHPUnit_Framework_TestCase
{
  protected $copyAsMarkdown;

  public function setUp()
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
    return $this->_createHeaderRows($rows);
  }

  public function calculateColumnCount(array $rows)
  {
    return $this->_calculateColumnCount($rows);
  }

  public function createDataRows(array $rows)
  {
    return $this->_createDataRows($rows);
  }
}
