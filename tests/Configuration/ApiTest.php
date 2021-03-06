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
     * Tests the property name.
     */
    public function testPropertyName()
    {
        $api = new Api();

        $fluent = $api->setName('test_api');
        $this->assertSame($api, $fluent);
        $this->assertSame('test_api', $api->getName());
    }

    /**
     * Tests the property baseUrl.
     */
    public function testPropertyBaseUrl()
    {
        $api = new Api();

        $fluent = $api->setBaseUrl('test_base_url');
        $this->assertSame($api, $fluent);
        $this->assertSame('test_base_url', $api->getBaseUrl());
    }
}
