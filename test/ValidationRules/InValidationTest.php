<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\AttributeAccessors\AttributeNotExists;
use ArrayUtils\ValidationRule;

class InValidationTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $validation = new InValidation();

        $this->assertInstanceOf(ValidationRule::class, $validation);
    }

    public function testValidValues() {
        $validation = new InValidation();
        $validation->setParams([1,"2", "tres"]);

        $this->assertEmpty($validation->validate("1"));
        $this->assertEmpty($validation->validate(2));
        $this->assertEmpty($validation->validate("tres"));
    }

    public function testInvalidValues() {
        $validation = new InValidation();


        $this->assertNotEmpty($validation->validate("um"));
        $this->assertNotEmpty($validation->validate("dois"));
        $this->assertNotEmpty($validation->validate("3"));
        $this->assertNotEmpty($validation->validate(array()));
        $this->assertNotEmpty($validation->validate(AttributeNotExists::instance()));
    }

    public function testArr0Or1() {
        $validation = new InValidation();
        $validation->setParams(explode(",", "0,1"));

        $this->assertEmpty($validation->validate("1"));
        $this->assertEmpty($validation->validate(1));
        $this->assertEmpty($validation->validate("0"));
        $this->assertEmpty($validation->validate(0));
    }
}
