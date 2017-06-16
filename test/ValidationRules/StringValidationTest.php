<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\AttributeAccessors\AttributeNotExists;
use ArrayUtils\ValidationRule;

class StringValidationTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $strValidation = new StringValidation();

        $this->assertInstanceOf(ValidationRule::class, $strValidation);
    }

    public function testValidValues() {
        $validation = new StringValidation();

        $this->assertEmpty($validation->validate(""));
        $this->assertEmpty($validation->validate("123"));
        $this->assertEmpty($validation->validate("abc"));
    }

    public function testInvalidValues() {
        $validation = new StringValidation();

        $this->assertNotEmpty($validation->validate(1));
        $this->assertNotEmpty($validation->validate(0));
        $this->assertNotEmpty($validation->validate(1.5));
        $this->assertNotEmpty($validation->validate(null));
        $this->assertNotEmpty($validation->validate(array()));
        $this->assertNotEmpty($validation->validate(AttributeNotExists::instance()));
    }
}
