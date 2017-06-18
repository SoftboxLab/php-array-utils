<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\AttributeAccessors\AttributeNotExists;
use ArrayUtils\ValidationRule;

class NotInValidationTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $validation = new NotInValidation();

        $this->assertInstanceOf(ValidationRule::class, $validation);
    }

    public function testValidValues() {
        $validation = new NotInValidation();
        $validation->setParams([1,"2", "tres"]);

        $this->assertEmpty($validation->validate("um"));
        $this->assertEmpty($validation->validate("dois"));
        $this->assertEmpty($validation->validate("3"));
    }

    public function testInvalidValues() {
        $validation = new NotInValidation();

        $validation->setParams([1,"2", "tres"]);
        $this->assertNotEmpty($validation->validate("1"));
        $this->assertNotEmpty($validation->validate("2"));
        $this->assertNotEmpty($validation->validate("tres"));
        $this->assertEmpty($validation->validate(array()));
        $this->assertEmpty($validation->validate(AttributeNotExists::instance()));
    }
}
