<?php

namespace Reposter\tests\Configuration;

use Psr\Log\LoggerInterface;
use Reposter\Configuration\Api;
use Reposter\Configuration\ResourceMapping\LoaderInterface;

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

    public function testPropertyResourceMappingLoader()
    {
        $api = new Api();

        $resourceMappingLoader = $this->prophesize(LoaderInterface::class)->reveal();

        $fluent = $api->setResourceMappingLoader($resourceMappingLoader);
        $this->assertSame($api, $fluent);
        $this->assertSame($resourceMappingLoader, $api->getResourceMappingLoader());
    }

    public function testPropertyLogger()
    {
        $api = new Api();

        $logger = $this->prophesize(LoggerInterface::class)->reveal();

        $fluent = $api->setLogger($logger);
        $this->assertSame($api, $fluent);
        $this->assertSame($logger, $api->getLogger());
    }
}
