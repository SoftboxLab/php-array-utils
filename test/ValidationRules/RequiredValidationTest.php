<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\AttributeAccessors\AttributeNotExists;
use ArrayUtils\ValidationRule;

class RequiredValidationTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $validation = new RequiredValidation();

        $this->assertInstanceOf(ValidationRule::class, $validation);
    }

    public function testValidValues() {
        $validation = new RequiredValidation();

        $this->assertEmpty($validation->validate(""));
        $this->assertEmpty($validation->validate("123"));
        $this->assertEmpty($validation->validate("abc"));
        $this->assertEmpty($validation->validate(1));
        $this->assertEmpty($validation->validate(false));
        $this->assertEmpty($validation->validate(true));
        $this->assertEmpty($validation->validate(array()));
    }

    public function testInvalidValues() {
        $validation = new RequiredValidation();

        $this->assertNotEmpty($validation->validate(null));
        $this->assertNotEmpty($validation->validate(AttributeNotExists::instance()));
    }
}
