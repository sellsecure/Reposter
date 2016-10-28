<?php

namespace Reposter\tests\Configuration;

use Reposter\Configuration\ResourceMapping;

/**
 * Class ResourceMappingTest.
 *
 * @author Raphael De Freitas <raphael@de-freitas.net>
 */
class ResourceMappingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the property type.
     */
    public function testPropertyType()
    {
        $resourceMapping = new ResourceMapping();

        $fluent = $resourceMapping->setType('test_type');
        $this->assertSame($resourceMapping, $fluent);
        $this->assertSame('test_type', $resourceMapping->getType());
    }

    /**
     * Tests that an attribute exists.
     */
    public function testHasAttribute()
    {
        $resourceMapping = new ResourceMapping();

        $this->assertFalse($resourceMapping->hasAttribute('test_attribute'));
        $resourceMapping->addAttribute('test_attribute', 'test_value');
        $this->assertTrue($resourceMapping->hasAttribute('test_attribute'));
    }

    /**
     * Tests that an attribute is added.
     */
    public function testAddAttribute()
    {
        $resourceMapping = new ResourceMapping();

        $fluent = $resourceMapping->addAttribute('test_attribute', 'test_value');
        $this->assertSame($resourceMapping, $fluent);
    }

    /**
     * Tests.
     */
    public function testGetAttribute()
    {
        $resourceMapping = new ResourceMapping();

        $resourceMapping->addAttribute('test_attribute', 'test_value');
        $this->assertSame('test_value', $resourceMapping->getAttribute('test_attribute'));
    }

    /**
     * Tests that an attribute get is valid.
     */
    public function testGetAttributes()
    {
        $resourceMapping = new ResourceMapping();

        $resourceMapping->addAttribute('test_attribute', 'test_value');
        $this->assertArrayHasKey('test_attribute', $resourceMapping->getAttributes());
        $this->assertContains('test_value', $resourceMapping->getAttributes());
    }

    /**
     * Tests that an attribute is removed.
     */
    public function testRemoveAttribute()
    {
        $resourceMapping = new ResourceMapping();

        $resourceMapping->addAttribute('test_attribute', 'test_value');
        $resourceMapping->removeAttribute('test_attribute');
        $this->assertFalse($resourceMapping->hasAttribute('test_attribute'));
    }

    /**
     * Tests that setting attributes is doing well.
     */
    public function testSetAttributes()
    {
        $resourceMapping = new ResourceMapping();

        $attributes = [
            'test_name_1' => 'test_value_1',
            'test_name_2' => 'test_value_2',
            'test_name_3' => 'test_value_3',
        ];

        $fluent = $resourceMapping->setAttributes($attributes);
        $this->assertSame($resourceMapping, $fluent);

        $this->assertArraySubset($attributes, $resourceMapping->getAttributes());
    }
}
