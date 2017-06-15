<?php

namespace PHP\Cast\AttributeAccessors;

use PHP\Cast\AttributeAccessor;
use PHP\Cast\CastRule;

class AttributeWrapperTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $attrWrapper = new AttributeWrapper('a');

        $this->assertInstanceOf(AttributeAccessor::class, $attrWrapper);
    }

    public function testGetValue() {
        $target = ["attr_a" => "hello"];

        $attrWrapper = new AttributeWrapper('attr_a');
        $this->assertEquals("hello", $attrWrapper->getValue($target));

        $target = ["attr_b" => "hello"];

        $this->assertNull($attrWrapper->getValue($target));

        $mockCastRule = $this->getMockBuilder(CastRule::class)
            ->setMethods(["cast", "getIdentifier", "setParams"])
            ->getMock();

        $mockCastRule->method("cast")->willReturn("mock");

        $attrWrapper = new AttributeWrapper("attr_b", $mockCastRule);
        $this->assertEquals("mock", $attrWrapper->getValue($target));
    }

    public function testCastValue() {
        $target = ["attr_a" => "hello"];

        $attrWrapper = new AttributeWrapper('attr_a');

        $ret = $attrWrapper->cast($target);
        $this->assertEquals("hello", $ret["attr_a"]);

        $target = ["attr_b" => "hello"];

        $ret = $attrWrapper->cast($target);

        $this->assertEquals("hello", $ret["attr_b"]);
        $this->assertFalse(isset($ret["attr_a"]));

        $mockCastRule = $this->getMockBuilder(CastRule::class)
                             ->setMethods(["cast", "getIdentifier", "setParams"])
                             ->getMock();

        $mockCastRule->method("cast")->willReturn("mock");

        $attrWrapper = new AttributeWrapper("attr_b", $mockCastRule);

        $ret = $attrWrapper->cast($target);

        $this->assertEquals("mock", $ret["attr_b"]);
    }
}
