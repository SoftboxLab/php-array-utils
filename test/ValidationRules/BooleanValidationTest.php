<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\AttributeAccessors\AttributeNotExists;
use ArrayUtils\ValidationRule;

class BooleanValidationTest extends \PHPUnit_Framework_TestCase {

    public function testInstance() {
        $boolValidation = new BooleanValidation();

        $this->assertInstanceOf(ValidationRule::class, $boolValidation);
    }

    public function testValidValues() {
        $boolValidation = new BooleanValidation();

        $this->assertEmpty($boolValidation->validate(true));
        $this->assertEmpty($boolValidation->validate(false));
    }

    public function testInvalidValues() {
        $boolValidation = new BooleanValidation();

        $this->assertNotEmpty($boolValidation->validate(1));
        $this->assertNotEmpty($boolValidation->validate(0));
        $this->assertNotEmpty($boolValidation->validate("1"));
        $this->assertNotEmpty($boolValidation->validate("0"));
        $this->assertNotEmpty($boolValidation->validate("teste"));
        $this->assertNotEmpty($boolValidation->validate("false"));
        $this->assertNotEmpty($boolValidation->validate("true"));
        $this->assertNotEmpty($boolValidation->validate(null));
        $this->assertNotEmpty($boolValidation->validate(AttributeNotExists::instance()));
    }
}
