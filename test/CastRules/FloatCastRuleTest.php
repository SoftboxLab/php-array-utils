<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 14/05/17
 * Time: 19:40
 */

namespace PHP\Cast\CastRules;

use PHP\Cast\CastRule;

class FloatCastRuleTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $instance = new FloatCastRule();
        $this->assertInstanceOf(CastRule::class, $instance);
    }

    public function testId() {
        $instance = new FloatCastRule();

        $this->assertEquals("float", $instance->getIdentifier());
    }

    public function testCast() {
        $instance = new FloatCastRule();

        $this->assertTrue($instance->cast(1) === 1.0);
        $this->assertTrue($instance->cast(0.5) === 0.5);
        $this->assertTrue($instance->cast("1.5") === 1.5);
        $this->assertTrue($instance->cast("0.9") === 0.9);
        $this->assertTrue($instance->cast(1.3) === 1.3);
        $this->assertTrue($instance->cast(null) === 0.0);

    }
}
