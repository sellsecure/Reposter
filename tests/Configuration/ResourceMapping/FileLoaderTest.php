<?php

namespace Reposter\tests\Configuration\ResourceMapping;

use Reposter\Configuration\ResourceMapping\FileLoader;

/**
 * Class FileLoaderTest.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class FileLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the name is correct.
     */
    public function testGetName()
    {
        $fileLoader = new FileLoader();

        $this->assertEquals('file', $fileLoader->getType());
    }

    /**
     * Tests the property file.
     */
    public function testPropertyFile()
    {
        $fileLoader = new FileLoader();

        $fluent = $fileLoader->setFile('test_file');
        $this->assertSame($fluent, $fileLoader);
        $this->assertSame('test_file', $fileLoader->getFile());
    }
}
