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
        if (!array_key_exists($this->attribute, $target)) {
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

    /**
     * @param array $target
     *
     * @return mixed|null
     */
    protected function get($target) {
        if (!is_array($target) || !array_key_exists($this->attribute, $target)) {
            return AttributeNotExists::instance();
        }

        return $target[$this->attribute];
    }

    public function validate($target) {
        $ret = parent::validate($this->get($target));

        foreach ($ret as &$failMsg) {
            $failMsg = $this->attribute . "." . $failMsg;
        }

        return $ret;
    }
}
