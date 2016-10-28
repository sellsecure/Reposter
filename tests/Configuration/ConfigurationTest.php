<?php

namespace Reposter\tests\Configuration;

use Psr\Log\LoggerInterface;
use Reposter\Configuration\Api;
use Reposter\Configuration\Configuration;
use Reposter\Exception\InvalidArgumentException;

/**
 * Class ConfigurationTest.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $name
     * @param array $logger
     *
     * @return object
     */
    public function createApiMock($name, $logger = [null, null])
    {
        $apiProphecy = $this->prophesize(Api::class);

        $apiProphecy->getName()->willReturn($name);

        return $apiProphecy;
    }

    /**
     * Tests the property DefaultLogger.
     */
    public function testPropertyDefaultLogger()
    {
        $configuration = new Configuration();

        $logger = $this->prophesize(LoggerInterface::class)->reveal();

        $fluent = $configuration->setDefaultLogger($logger);
        $this->assertSame($configuration, $fluent);
        $this->assertSame($logger, $configuration->getDefaultLogger());
    }

    /**
     * Tests that the API is successfully added with logger.
     */
    public function testAddApiWithLogger()
    {
        $configuration = new Configuration();

        $logger = $this->prophesize(LoggerInterface::class)->reveal();
        $configuration->setDefaultLogger($logger);

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
