<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 14/05/17
 * Time: 19:40
 */

namespace PHP\Cast\CastRules;

use PHP\Cast\CastRule;

class IntegerCastRuleTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $instance = new IntegerCastRule();
        $this->assertInstanceOf(CastRule::class, $instance);
    }

    public function testId() {
        $instance = new IntegerCastRule();

        $this->assertEquals("int", $instance->getIdentifier());
    }

    public function testCast() {
        $instance = new IntegerCastRule();

        $this->assertTrue($instance->cast(1) === 1);
        $this->assertTrue($instance->cast(0) === 0);
        $this->assertTrue($instance->cast("1") === 1);
        $this->assertTrue($instance->cast("0") === 0);
        $this->assertTrue($instance->cast(1.3) === 1);
        $this->assertTrue($instance->cast(null) === 0);

    }
}
