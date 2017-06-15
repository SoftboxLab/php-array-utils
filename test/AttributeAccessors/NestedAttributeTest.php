<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 13/05/17
 * Time: 14:25
 */

namespace PHP\Cast\AttributeAccessors;

use PHP\Cast\AttributeAccessor;

class NestedAttributeTest extends \PHPUnit_Framework_TestCase {

    public function testInstanceOf() {
        $mock = $this->getMockBuilder(AttributeAccessor::class)
                             ->setMethods(["getValue", "cast", "withoutCasting", "withCasting", "setValue"])
                             ->getMock();

        $nestedAttr = new NestedAttribute($mock);

        $this->assertInstanceOf(AttributeAccessor::class, $nestedAttr);
    }

    public function testGetValue() {
        $mock = $this->getMockBuilder(AttributeAccessor::class)
                     ->setMethods(["getValue", "cast", "withoutCasting", "withCasting", "setValue"])
                     ->getMock();

        $mock->method("getValue")->willReturn("mockValue");

        $nestedAttr = new NestedAttribute($mock);

        $ret = $nestedAttr->getValue([]);

        $this->assertEquals("mockValue", $ret);
    }

    public function testCastValue() {
        $mock = $this->getMockBuilder(AttributeAccessor::class)
                     ->setMethods(["getValue", "cast", "withoutCasting", "withCasting", "setValue"])
                     ->getMock();

        $mock->method("cast")->willReturn("mockValue");

        $nestedAttr = new NestedAttribute($mock);

        $ret = $nestedAttr->cast([]);

        $this->assertEquals("mockValue", $ret);
    }
}
