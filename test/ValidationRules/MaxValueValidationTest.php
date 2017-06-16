<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\AttributeAccessors\AttributeNotExists;
use ArrayUtils\ValidationRule;

class MaxValueValidationTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $validation = new MaxValueValidation();

        $this->assertInstanceOf(ValidationRule::class, $validation);
    }

    public function testValidValues() {
        $validation = new MaxValueValidation();
        $validation->setParams([10]);

        $this->assertEmpty($validation->validate("1"));
        $this->assertEmpty($validation->validate(2));
        $this->assertEmpty($validation->validate("4"));
        $this->assertEmpty($validation->validate("10"));
        $this->assertEmpty($validation->validate(10));
        $this->assertEmpty($validation->validate(-10));
        $this->assertEmpty($validation->validate(0));
    }

    public function testInvalidValues() {
        $validation = new MaxValueValidation();
        $validation->setParams([10]);

        $this->assertNotEmpty($validation->validate("um"));
        $this->assertNotEmpty($validation->validate("dois"));
        $this->assertNotEmpty($validation->validate("30"));
        $this->assertNotEmpty($validation->validate(11));
        $this->assertNotEmpty($validation->validate("11"));
        $this->assertNotEmpty($validation->validate("10.1"));
        $this->assertNotEmpty($validation->validate(array()));
        $this->assertNotEmpty($validation->validate(null));
        $this->assertNotEmpty($validation->validate(AttributeNotExists::instance()));
    }
}
