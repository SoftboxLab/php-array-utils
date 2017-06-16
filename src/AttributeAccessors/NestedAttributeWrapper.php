<?php

namespace ArrayUtils\AttributeAccessors;

use ArrayUtils\AttributeAccessor;

class NestedAttributeWrapper extends NestedAttribute {

    /** @var string */
    private $attribute;

    public function __construct($attribute, AttributeAccessor $attributeAccessor) {
        parent::__construct($attributeAccessor);

        $this->attribute = $attribute;
    }

    public function getValue(array $target) {
        if (!isset($target[$this->attribute])) {
            return null;
        }

        return parent::getValue($target[$this->attribute]);
    }

    public function setValue(array &$target, $newValue) {
        if (!isset($target[$this->attribute])) {
            return;
        }

        parent::setValue($target[$this->attribute], $newValue);
    }

    public function cast(array $target) {
        if (!isset($target[$this->attribute])) {
            $target[$this->attribute] = array();
        }

        $target[$this->attribute] = parent::cast($target[$this->attribute]);

        return $target;
    }

    public function validate($target) {
        $ret = parent::validate(isset($target[$this->attribute]) ? $target[$this->attribute] : null);

        foreach ($ret as &$failMsg) {
            $failMsg = $this->attribute . "." . $failMsg;
        }

        return $ret;
    }
}
