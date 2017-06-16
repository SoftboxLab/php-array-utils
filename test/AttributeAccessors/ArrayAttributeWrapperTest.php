<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 13/05/17
 * Time: 14:11
 */

namespace ArrayUtils\AttributeAccessors;

use ArrayUtils\AttributeAccessor;

class ArrayAttributeWrapperTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $arrAttrWrapper = new ArrayAttributeWrapper("attr");

        $this->assertInstanceOf(AttributeAccessor::class, $arrAttrWrapper);
    }

    public function testSetValue() {
        $arrAttrWrapper = new ArrayAttributeWrapper();

        $target = [ "attr1", "attr2" ];

        $ret = $arrAttrWrapper->cast($target);

        $this->assertNotEmpty($ret);
        $this->assertCount(2, $ret);
        $this->assertEquals("attr1", $ret[0]);
        $this->assertEquals("attr2", $ret[1]);

        $ret = $arrAttrWrapper->cast([]);

        $this->assertEmpty($ret);
    }

    public function testGetValue() {
        $arrAttrWrapper = new ArrayAttributeWrapper();

        $target = [ "attr1", "attr2" ];

        $ret = $arrAttrWrapper->getValue($target);

        $this->assertNotEmpty($ret);
        $this->assertCount(2, $ret);
        $this->assertEquals("attr1", $ret[0]);
        $this->assertEquals("attr2", $ret[1]);

    }

    public function testSetValueWithCastRule() {
        $mockCastRule = $this->getMockBuilder(CastRule::class)
                             ->setMethods(["cast", "getIdentifier", "setParams"])
                             ->getMock();

        $mockCastRule->method("cast")->willReturn("mock");

        $arrAttrWrapper = new ArrayAttributeWrapper($mockCastRule);

        $target = [ "attr1", "attr2" ];

        $ret = $arrAttrWrapper->cast($target);

        $this->assertNotEmpty($ret);
        $this->assertCount(2, $ret);
        $this->assertEquals("mock", $ret[0]);
        $this->assertEquals("mock", $ret[1]);
    }

    public function testGetValueWithCastRule() {
        $mockCastRule = $this->getMockBuilder(CastRule::class)
                             ->setMethods(["cast", "getIdentifier", "setParams"])
                             ->getMock();

        $mockCastRule->method("cast")->willReturn("mock");

        $arrAttrWrapper = new ArrayAttributeWrapper($mockCastRule);

        $target = [ "attr1", "attr2" ];

        $ret = $arrAttrWrapper->getValue($target);

        $this->assertNotEmpty($ret);
        $this->assertCount(2, $ret);
        $this->assertEquals("mock", $ret[0]);
        $this->assertEquals("mock", $ret[1]);
    }
}
