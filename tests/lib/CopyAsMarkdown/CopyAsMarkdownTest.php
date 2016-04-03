<?php

class CopyAsMarkdownTest extends PHPUnit_Framework_TestCase
{
  protected $copyAsMarkdown;

  public function setUp()
  {
    $this->copyAsMarkdown = new CopyAsMarkdownExtended();
  }

  public function testConvert()
  {
    $expected = 'hoge|fuga
---|---
1|2';
    $this->assertEquals($expected, $this->copyAsMarkdown->convert(array(
          array('hoge', 'fuga'),
          array('1', '2')
        )));
  }

  public function testCreateHeaderRows()
  {
    $expected = 'hoge|fuga
---|---';
    $this->assertEquals($expected, $this->copyAsMarkdown->createHeaderRows(array('hoge', 'fuga')));
  }


  public function testCalculateColumnCount()
  {
    $this->assertEquals(3, $this->copyAsMarkdown->calculateColumnCount(array(array('a', 'b', 'c'))));
  }

  public function testCreateDataRows()
  {
    $expected = 'a|b|c
d|e|f';
    $this->assertEquals($expected, $this->copyAsMarkdown->createDataRows(array(
          array('a', 'b', 'c'),
          array('d', 'e', 'f'),
        )));
  }
}

class CopyAsMarkdownExtended extends \CopyAsMarkdown\CopyAsMarkdown
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
