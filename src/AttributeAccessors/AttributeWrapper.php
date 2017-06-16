<?php

namespace ArrayUtils\AttributeAccessors;

use ArrayUtils\AttributeAccessor;
use ArrayUtils\CastRule;
use ArrayUtils\ValidationRule;

class AttributeWrapper implements AttributeAccessor {

    /**
     * @var string
     */
    protected $attribute;

    /**
     * @var null|CastRule
     */
    protected $castRule;

    /** @var  null|ValidationRule */
    protected $validateRule;

    protected $castEnabled = true;

    /**
     * @param string         $attribute
     * @param CastRule       $castRule
     * @param ValidationRule $validateRule
     */
    public function __construct($attribute, $castRule = null, $validateRule = null) {
        $this->attribute = $attribute;

        $this->castRule = $castRule;
        $this->validateRule = $validateRule;
    }

    public function setValidateRule(ValidationRule $validateRule) {
        $this->validateRule = $validateRule;

        return $this;
    }

    public function setCastRule(CastRule $castRule) {
        $this->castRule = $castRule;

        return $this;
    }

    public function getValue(array $target) {
        $value = $this->get($target);

        return $this->castRule && $this->castEnabled ? $this->castRule->cast($value) : $value;
    }

    public function setValue(array &$target, $newValue) {
        $target[$this->attribute] = $this->castRule && $this->castEnabled ? $this->castRule->cast($newValue) : $newValue;
    }

    public function cast(array $target) {
        if ($target === null) {
            $target = array();
        }

        $value = $this->get($target);

        $target[$this->attribute] = $this->castRule ? $this->castRule->cast($value) : $value;

        return $target;
    }

    /**
     * @return AttributeAccessor
     */
    public function withCasting() {
        $this->castEnabled = true;

        return $this;
    }

    /**
     * @return AttributeAccessor
     */
    public function withoutCasting() {
        $this->castEnabled = false;

        return $this;
    }

    public function validate($target) {
        $ret = array();

        if ($this->validateRule) {
            $ret = $this->validateRule->validate($this->get($target));
        }

        foreach ($ret as &$failMsg) {
            $failMsg = $this->attribute . ": " . $failMsg;
        }

        return $ret;
    }

    /**
     * @param array $target
     *
     * @return mixed|null
     */
    protected function get($target) {
        return isset($target[$this->attribute]) ? $target[$this->attribute] : null;
    }
}
