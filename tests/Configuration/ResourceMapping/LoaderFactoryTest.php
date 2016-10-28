<?php

namespace Reposter\tests\Configuration\ResourceMapping;

use Reposter\Configuration\ResourceMapping\LoaderFactory;
use Reposter\Configuration\ResourceMapping\LoaderInterface;
use Reposter\Exception\InvalidArgumentException;

/**
 * Class LoaderFactoryTest.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class LoaderFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests that a loader is successfully added.
     */
    public function testAddLoader()
    {
        $loaderFactory = new LoaderFactory();

        $loader = $this->prophesize(LoaderInterface::class)
            ->getType()->willReturn('test_loader')->getObjectProphecy()
            ->reveal();

        $fluent = $loaderFactory->addLoader($loader);
        $this->assertSame($loaderFactory, $fluent);

        $this->assertContains($loader, $loaderFactory->getLoaders());
    }

    /**
     * Tests that a loader is successfully removed.
     */
    public function testRemoveLoader()
    {
        $loaderFactory = new LoaderFactory();

        $loader = $this->prophesize(LoaderInterface::class)
            ->getType()->willReturn('test_loader')->getObjectProphecy()
            ->reveal();

        $loaderFactory->addLoader($loader);
        $loaderFactory->removeLoader($loader);

        $this->assertNotContains($loader, $loaderFactory->getLoaders());
    }

    /**
     * Tests that a loader is successfully removed.
     */
    public function testRemoveNonexistentLoader()
    {
        $loaderFactory = new LoaderFactory();

        $loader = $this->prophesize(LoaderInterface::class)
            ->getType()->willReturn('test_loader')->getObjectProphecy()
            ->reveal();

        $loaderFactory->removeLoader($loader);

        $this->assertNotContains($loader, $loaderFactory->getLoaders());
    }

    /**
     * Tests that a loader is successfully created.
     */
    public function testCreateWithAddedLoader()
    {
        $loaderFactory = new LoaderFactory();

        $loader = $this->prophesize(LoaderInterface::class)
            ->getType()->willReturn('test_loader')->getObjectProphecy()
            ->reveal();

        $loaderFactory->addLoader($loader);

        $createdLoader = $loaderFactory->create('test_loader');
        $this->assertEquals($loader, $createdLoader);
    }

    /**
     * Tests that a loader nonexistent throw an exception on creation.
     */
    public function testCreateWithNonexistentLoader()
    {
        $loaderFactory = new LoaderFactory();

        $this->expectException(InvalidArgumentException::class);

        $loaderFactory->create('test_loader');
    }
}
