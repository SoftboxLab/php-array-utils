<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 13/05/17
 * Time: 14:25
 */

namespace ArrayUtils\AttributeAccessors;

use ArrayUtils\AttributeAccessor;

class NestedAttributeTest extends \PHPUnit_Framework_TestCase {

    public function testInstanceOf() {
        $mock = $this->getMockBuilder(AttributeAccessor::class)
                             ->setMethods(["getValue", "cast", "withoutCasting", "withCasting", "setValue", "setValidateRule", "setCastRule", "validate"])
                             ->getMock();

        $nestedAttr = new NestedAttribute($mock);

        $this->assertInstanceOf(AttributeAccessor::class, $nestedAttr);
    }

    public function testGetValue() {
        $mock = $this->getMockBuilder(AttributeAccessor::class)
                     ->setMethods(["getValue", "cast", "withoutCasting", "withCasting", "setValue", "setValidateRule", "setCastRule", "validate"])
                     ->getMock();

        $mock->method("getValue")->willReturn("mockValue");

        $nestedAttr = new NestedAttribute($mock);

        $ret = $nestedAttr->getValue([]);

        $this->assertEquals("mockValue", $ret);
    }

    public function testCastValue() {
        $mock = $this->getMockBuilder(AttributeAccessor::class)
                     ->setMethods(["getValue", "cast", "withoutCasting", "withCasting", "setValue", "setValidateRule", "setCastRule", "validate"])
                     ->getMock();

        $mock->method("cast")->willReturn("mockValue");

        $nestedAttr = new NestedAttribute($mock);

        $ret = $nestedAttr->cast([]);

        $this->assertEquals("mockValue", $ret);
    }
}
