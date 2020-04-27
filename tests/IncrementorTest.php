<?php

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use nhalstead\Incrementor\Incrementor;
use Tightenco\Collect\Support\Collection;


class IncrementorTest extends TestCase
{

    public function testGetExpressionParts()
    {
        $parts = Incrementor::getExpressionParts('TEST_{0000^}');

        $this->assertEquals($parts->expression, 'TEST_{0000^}');
        $this->assertEquals($parts->prefix, 'TEST_');
        $this->assertEquals($parts->incrementor, '0000^');
        $this->assertEquals($parts->start, 0);
        $this->assertEquals($parts->length, 4);
        $this->assertEquals($parts->suffix, "");
    }

    public function testGet()
    {
        // Create a new Instance using shorthand and get a collection back.
        $collection = Incrementor::get('TEST_{0000^}', 4);

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertEquals($collection->count(), 4);
    }

    public function testHasExpression()
    {
        $this->assertTrue(Incrementor::hasExpression('TEST_{0000^}'));
        $this->assertFalse(Incrementor::hasExpression('TEST_'));
    }

    public function testToCollection()
    {
        $instance = new Incrementor('TEST_{0000^}');

        $this->assertInstanceOf(Incrementor::class, $instance);
        $this->assertInstanceOf(Collection::class, $instance->toCollection());
    }

    public function testGetNumber()
    {
        $instance = new Incrementor('TEST_{0000^}');

        $this->assertEquals($instance->getNumber(1), '0001');
    }
}
