<?php

namespace Reposter\tests\Configuration;

use Psr\Log\LoggerInterface;
use Reposter\Configuration\Api;
use Reposter\Configuration\Configuration;
use Reposter\Exception\InvalidArgumentException;
use Reposter\Http\Client\HttpClientInterface;
use Reposter\Http\Message\HttpMessageFactoryInterface;

/**
 * Class ConfigurationTest.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the property Logger.
     */
    public function testPropertyLogger()
    {
        $configuration = new Configuration();

        $logger = $this->prophesize(LoggerInterface::class)->reveal();

        $fluent = $configuration->setLogger($logger);
        $this->assertSame($configuration, $fluent);
        $this->assertSame($logger, $configuration->getLogger());
    }

    /**
     * Tests the property HttpClient.
     */
    public function testPropertyHttpClient()
    {
        $configuration = new Configuration();

        $httpClient = $this->prophesize(HttpClientInterface::class)->reveal();

        $fluent = $configuration->setHttpClient($httpClient);
        $this->assertSame($configuration, $fluent);
        $this->assertSame($httpClient, $configuration->getHttpClient());
    }

    /**
     * Tests the property HttpMessageFactory.
     */
    public function testPropertyHttpMessageFactory()
    {
        $configuration = new Configuration();

        $httpMessageFactory = $this->prophesize(HttpMessageFactoryInterface::class)->reveal();

        $fluent = $configuration->setHttpMessageFactory($httpMessageFactory);
        $this->assertSame($configuration, $fluent);
        $this->assertSame($httpMessageFactory, $configuration->getHttpMessageFactory());
    }

    /**
     * Tests that the API is successfully added with logger.
     */
    public function testAddApiWithLogger()
    {
        $configuration = new Configuration();

        $logger = $this->prophesize(LoggerInterface::class)->reveal();
        $configuration->setLogger($logger);

        $api = $this->prophesize(Api::class)
            ->getName()->willReturn('test_api')->getObjectProphecy()
            ->getLogger()->willReturn(null)->shouldBeCalled()->getObjectProphecy()
            ->setLogger($logger)->shouldBeCalled()->getObjectProphecy()
            ->reveal();

        $fluent = $configuration->addApi($api);
        $this->assertEquals($configuration, $fluent);

        $this->assertEquals($api, $configuration->getApi('test_api'));
        $this->assertContains($api, $configuration->getApis());
    }

    /**
     * Tests that the API is successfully added without logger.
     */
    public function testAddApiWithoutLogger()
    {
        $configuration = new Configuration();

        $logger = $this->prophesize(LoggerInterface::class)->reveal();

        $api = $this->prophesize(Api::class)
            ->getName()->willReturn('test_api')->getObjectProphecy()
            ->getLogger()->willReturn($logger)->getObjectProphecy()
            ->reveal();

        $fluent = $configuration->addApi($api);
        $this->assertEquals($configuration, $fluent);

        $this->assertEquals($api, $configuration->getApi('test_api'));
        $this->assertContains($api, $configuration->getApis());
    }

    /**
     * Tests that an API cannot be added twice.
     */
    public function testAddApiTwice()
    {
        $configuration = new Configuration();

        $api = $this->prophesize(Api::class)
            ->getName()->willReturn('test_api')->getObjectProphecy()
            ->getLogger()->willReturn($this->prophesize(LoggerInterface::class)->reveal())->getObjectProphecy()
            ->reveal();

        $configuration->addApi($api);

        $this->expectException(InvalidArgumentException::class);
        $configuration->addApi($api);
    }

    /**
     * Tests that 2 APIs with the same name cannot be added.
     */
    public function testAddApiWithSameName()
    {
        $configuration = new Configuration();

        $api1 = $this->prophesize(Api::class)
            ->getName()->willReturn('test_api')->getObjectProphecy()
            ->getLogger()->willReturn($this->prophesize(LoggerInterface::class)->reveal())->getObjectProphecy()
            ->reveal();
        $api2 = $this->prophesize(Api::class)
            ->getName()->willReturn('test_api')->getObjectProphecy()
            ->getLogger()->willReturn($this->prophesize(LoggerInterface::class)->reveal())->getObjectProphecy()
            ->reveal();

        $configuration->addApi($api1);

        $this->expectException(InvalidArgumentException::class);
        $configuration->addApi($api2);
    }

    /**
     * Tests that we get the correct added API.
     */
    public function testGetApiAdded()
    {
        $configuration = new Configuration();

        $api = $this->prophesize(Api::class)
            ->getName()->willReturn('test_api')->getObjectProphecy()
            ->getLogger()->willReturn($this->prophesize(LoggerInterface::class)->reveal())->getObjectProphecy()
            ->reveal();

        $this->assertNull($configuration->getApi('test_api'));

        $configuration->addApi($api);
        $this->assertEquals($api, $configuration->getApi('test_api'));
    }

    /**
     * Tests that NULL is returned when we retrieve an API nonexistent.
     */
    public function testGetApiNonexistent()
    {
        $configuration = new Configuration();

        $this->assertNull($configuration->getApi('test_api'));
    }

    /**
     * Tests that the APIs can be retrieved.
     */
    public function testGetApis()
    {
        $configuration = new Configuration();

        $api = $this->prophesize(Api::class)
            ->getName()->willReturn('test_api')->getObjectProphecy()
            ->getLogger()->willReturn($this->prophesize(LoggerInterface::class)->reveal())->getObjectProphecy()
            ->reveal();

        $this->assertCount(0, $configuration->getApis());
        $configuration->addApi($api);
        $this->assertCount(1, $configuration->getApis());
        $this->assertContains($api, $configuration->getApis());
    }

    /**
     * Tests removing an API.
     */
    public function testRemoveApi()
    {
        $configuration = new Configuration();

        $api = $this->prophesize(Api::class)
            ->getName()->willReturn('test_api')->getObjectProphecy()
            ->getLogger()->willReturn($this->prophesize(LoggerInterface::class)->reveal())->getObjectProphecy()
            ->reveal();

        $configuration->addApi($api);
        $this->assertSame($api, $configuration->getApi('test_api'));

        $fluent = $configuration->removeApi($api);
        $this->assertSame($configuration, $fluent);
        $this->assertNull($configuration->getApi('test_api'));

        // The second time, it should not throw any error
        $fluent = $configuration->removeApi($api);
        $this->assertSame($configuration, $fluent);
        $this->assertNull($configuration->getApi('test_api'));
    }
}
