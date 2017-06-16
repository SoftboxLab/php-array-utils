<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 14/05/17
 * Time: 19:40
 */

namespace ArrayUtils\CastRules;

use ArrayUtils\CastRule;

class BooleanCastRuleTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $instance = new BooleanCastRule();
        $this->assertInstanceOf(CastRule::class, $instance);
    }

    public function testId() {
        $instance = new BooleanCastRule();

        $this->assertEquals("bool", $instance->getIdentifier());
    }

    public function testCast() {
        $instance = new BooleanCastRule();

        $this->assertTrue($instance->cast(1) === true);
        $this->assertTrue($instance->cast(0) === false);
        $this->assertTrue($instance->cast("1") === true);
        $this->assertTrue($instance->cast("0") === false);
        $this->assertTrue($instance->cast("true") === true);
        $this->assertTrue($instance->cast("false") === true);
        $this->assertTrue($instance->cast(null) === false);

        $this->assertTrue(gettype($instance->cast(1)) === "boolean");
        $this->assertTrue(gettype($instance->cast(0)) === "boolean");
        $this->assertTrue(gettype($instance->cast("1")) === "boolean");
        $this->assertTrue(gettype($instance->cast("0")) === "boolean");
        $this->assertTrue(gettype($instance->cast("true")) === "boolean");
        $this->assertTrue(gettype($instance->cast("false")) === "boolean");
        $this->assertTrue(gettype($instance->cast(null)) === "boolean");
    }
}
