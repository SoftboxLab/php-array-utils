<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\AttributeAccessors\AttributeNotExists;
use ArrayUtils\ValidationRule;

class DateValidationTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $validation = new DateValidation();

        $this->assertInstanceOf(ValidationRule::class, $validation);
    }

    public function testValidValues() {
        $validation = new DateValidation();

        $this->assertEmpty($validation->validate("2017-01-01"));
        $this->assertEmpty($validation->validate("now"));
        $this->assertEmpty($validation->validate("today"));

        $validation->setParams(["d-m-Y"]);

        $this->assertEmpty($validation->validate("31-01-2017"));
    }

    public function testInvalidValues() {
        $validation = new DateValidation();


        $this->assertNotEmpty($validation->validate("ABC"));
        $this->assertNotEmpty($validation->validate("hoje"));
        $this->assertNotEmpty($validation->validate(null));
        $this->assertNotEmpty($validation->validate(array()));
        $this->assertNotEmpty($validation->validate(AttributeNotExists::instance()));

        $validation->setParams(["d-m-Y"]);

        $this->assertEmpty($validation->validate("01-31-2017"));
    }
}
