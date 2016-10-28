<?php

namespace Reposter\tests;

use Reposter\Configuration\Configuration;
use Reposter\Reposter;

/**
 * Class ReposterTest.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class ReposterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the constructor and properties.
     */
    public function testConstructor()
    {
        $configuration = $this->prophesize(Configuration::class)->reveal();

        $reposter = new Reposter($configuration);

        $this->assertSame($configuration, $reposter->getConfiguration());
    }
}
