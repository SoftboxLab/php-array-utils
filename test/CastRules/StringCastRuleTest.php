<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 14/05/17
 * Time: 19:40
 */

namespace ArrayUtils\CastRules;

use ArrayUtils\CastRule;

class StringCastRuleTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $instance = new StringCastRule();
        $this->assertInstanceOf(CastRule::class, $instance);
    }

    public function testId() {
        $instance = new StringCastRule();

        $this->assertEquals("string", $instance->getIdentifier());
    }

    public function testCast() {
        $instance = new StringCastRule();

        $this->assertTrue($instance->cast(1) === "1");
        $this->assertTrue($instance->cast(0) === "0");
        $this->assertTrue($instance->cast("1") === "1");
        $this->assertTrue($instance->cast("0") === "0");
        $this->assertTrue($instance->cast(1.3) === "1.3");
        $this->assertTrue($instance->cast(null) === "");
    }

    public function testMaxLength() {
        $instance = new StringCastRule();
        $instance->setParams([
           "max_length" => [3]
        ]);

        $this->assertEquals("123", $instance->cast("1234"));
    }

    public function testPad() {
        $instance = new StringCastRule();
        $instance->setParams([
            "rpad" => [6, "x"]
        ]);;

        $this->assertEquals("12xxxx", $instance->cast("12"));

        $instance = new StringCastRule();
        $instance->setParams([
            "lpad" => [6, "x"]
        ]);;

        $this->assertEquals("xxxx12", $instance->cast("12"));
    }
}
