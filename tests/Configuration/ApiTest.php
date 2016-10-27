<?php

namespace Reposter\tests\Configuration;

use Reposter\Configuration\Api;

/**
 * Class ApiTest.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class ApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that we get the correct information as constructor arguments.
     */
    public function testConstructor()
    {
        $api = new Api('test_api', 'test_base_URL');

        $this->assertSame('test_api', $api->getName());
        $this->assertSame('test_base_URL', $api->getBaseUrl());
    }
}
