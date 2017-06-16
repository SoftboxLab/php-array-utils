<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\AttributeAccessors\AttributeNotExists;
use ArrayUtils\ValidationRule;

class IsPresentValidationTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $validation = new IsPresentValidation();

        $this->assertInstanceOf(ValidationRule::class, $validation);
    }

    public function testValidValues() {
        $validation = new IsPresentValidation();

        $this->assertEmpty($validation->validate("1"));
        $this->assertEmpty($validation->validate(""));
        $this->assertEmpty($validation->validate(2));
        $this->assertEmpty($validation->validate(10));
        $this->assertEmpty($validation->validate(-10));
        $this->assertEmpty($validation->validate(0));
        $this->assertEmpty($validation->validate(null));
        $this->assertEmpty($validation->validate(array()));
    }

    public function testInvalidValues() {
        $validation = new IsPresentValidation();

        $this->assertNotEmpty($validation->validate(AttributeNotExists::instance()));
    }
}
