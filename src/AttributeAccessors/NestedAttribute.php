<?php

namespace PHP\Cast\AttributeAccessors;

use PHP\Cast\AttributeAccessor;
use PHP\Cast\CastRule;
use PHP\Cast\ValidationRule;

class NestedAttribute implements AttributeAccessor {
    /** @var AttributeAccessor */
    private $attributeAccessor;

    public function __construct(AttributeAccessor $attributeAccessor) {
        $this->attributeAccessor = $attributeAccessor;
    }

    public function getValue(array $target) {
        return $this->attributeAccessor->getValue($target);
    }

    public function setValue(array &$target, $newValue) {
        $this->attributeAccessor->setValue($target, $newValue);
    }


    public function cast(array $target) {
        return $this->attributeAccessor->cast($target);
    }

    /**
     * @return AttributeAccessor
     */
    public function withCasting() {
        $this->attributeAccessor->withCasting();

        return $this;
    }

    /**
     * @return AttributeAccessor
     */
    public function withoutCasting() {
        $this->attributeAccessor->withCasting();

        return $this;
    }

    public function validate($target) {
        return $this->attributeAccessor->validate($target);
    }

    /**
     * @param ValidationRule $validateRule
     *
     * @return AttributeAccessor
     */
    public function setValidateRule(ValidationRule $validateRule) {
        return $this->attributeAccessor->setValidateRule($validateRule);
    }

    /**
     * @param CastRule $castRule
     *
     * @return AttributeAccessor
     */
    public function setCastRule(CastRule $castRule) {
        return $this->attributeAccessor->setCastRule($castRule);
    }
}
