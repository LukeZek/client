<?php

namespace LukeBozek\ApiClient\Util;

use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    /**
     * @var Collection
     */
    private $collection;

    public function setUp()
    {
        $this->collection = new Collection();
    }

    public function testEmptyCollection()
    {
        $this->assertEquals(0, $this->collection->count());
    }

    public function testCanCreateCollectionFromArray()
    {
        $collection = Collection::makeFromArray(['testKey1' => 'testValue1', 'testKey2' => 'testValue2']);
        $this->assertInstanceOf(Collection::class, $collection);
    }

    public function testElementCount()
    {
        $this->collection->setData(['testKey1' => 'testValue1', 'testKey2' => 'testValue2']);

        $this->assertEquals(2, $this->collection->count());
    }

    public function testCanCreateIterator()
    {
        $this->collection->setData(['testKey1' => 'testValue1', 'testKey2' => 'testValue2']);

        $this->assertInstanceOf('\Iterator', $this->collection->getIterator());
    }

    public function testOffsetExists()
    {
        $this->collection->setData(['testKey1' => 'testValue1', 'testKey2' => 'testValue2']);

        $this->assertEquals(true, $this->collection->offsetExists('testKey1'));
        $this->assertEquals(false, $this->collection->offsetExists('testKey4'));
    }

    public function testOffsetGet()
    {
        $this->collection->setData(['testKey1' => 'testValue1', 'testKey2' => 'testValue2']);

        $this->assertEquals('testValue1', $this->collection->offsetGet('testKey1'));
        $this->assertEquals('', $this->collection->offsetExists('testKey4'));
    }

    public function testOffsetUnset()
    {
        $this->collection->setData(['testKey1' => 'testValue1', 'testKey2' => 'testValue2']);
        $this->collection->offsetUnset('testKey1');

        $this->assertEquals('', $this->collection->offsetExists('testKey1'));
    }

    public function testOffsetSet()
    {
        $this->collection->setData(['testKey1' => 'testValue1', 'testKey2' => 'testValue2']);

        $this->collection->offsetSet('testKey3', 'testValue3');

        $this->assertEquals('testValue3', $this->collection->offsetGet('testKey3'));
    }
}
