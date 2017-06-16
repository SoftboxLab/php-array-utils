<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\AttributeAccessors\AttributeNotExists;
use ArrayUtils\ValidationRule;

class NumericValidationTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $strValidation = new NumericValidation();

        $this->assertInstanceOf(ValidationRule::class, $strValidation);
    }

    public function testValidValues() {
        $validation = new NumericValidation();

        $this->assertEmpty($validation->validate("0"));
        $this->assertEmpty($validation->validate("123"));
        $this->assertEmpty($validation->validate(123));
        $this->assertEmpty($validation->validate(123.45));
        $this->assertEmpty($validation->validate("123.56"));
        $this->assertEmpty($validation->validate("-123.56"));
        $this->assertEmpty($validation->validate(-123.56));
        $this->assertEmpty($validation->validate(-2));
    }

    public function testInvalidValues() {
        $validation = new NumericValidation();

        $this->assertNotEmpty($validation->validate(true));
        $this->assertNotEmpty($validation->validate(false));
        $this->assertNotEmpty($validation->validate("Z"));
        $this->assertNotEmpty($validation->validate("AB"));
        $this->assertNotEmpty($validation->validate(null));
        $this->assertNotEmpty($validation->validate(array()));
        $this->assertNotEmpty($validation->validate(AttributeNotExists::instance()));
    }

    public function testNullableParam() {
        $validation = new NumericValidation();
        $validation->setParams(["nullable"]);

        $this->assertEmpty($validation->validate(null));
        $this->assertEmpty($validation->validate(1));
        $this->assertEmpty($validation->validate(0));

        $validation->setParams([]);
        $this->assertNotEmpty($validation->validate(null));
        $this->assertEmpty($validation->validate(1));
        $this->assertEmpty($validation->validate(0));
    }
}
