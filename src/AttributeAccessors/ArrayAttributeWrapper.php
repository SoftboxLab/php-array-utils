<?php

namespace ArrayUtils\AttributeAccessors;


use ArrayUtils\CastRule;
use ArrayUtils\ValidationRule;

class ArrayAttributeWrapper extends AttributeWrapper {

    /**
     * @param CastRule       $castRule
     * @param ValidationRule $validateRule
     */
    public function __construct($castRule = null, $validateRule = null) {
        parent::__construct(null, $castRule, $validateRule);
    }

    public function getValue(array $target) {
        if (empty($target)) {
            return array();
        }

        if ($this->castRule === null || !$this->castEnabled) {
            return $target;
        }

        $ret = array();

        foreach ($target as $value) {
            $ret[] = $this->castRule->cast($value);
        }

        return $ret;
    }

    public function setValue(array &$target, $newValue) {
        foreach ($target as &$value) {
            $value = $this->castRule && $this->castEnabled ? $this->castRule->cast($newValue) : $newValue;
        }
    }

    public function cast(array $target) {
        if (empty($target)) {
            return array();
        }

        if ($this->castRule === null) {
            return $target;
        }

        $ret = array();

        $total = count($target);

        for ($i = 0; $i < $total; $i++) {
            $ret[] = $this->castRule->cast($target[$i]);
        }

        return $ret;
    }

    protected function appendAttrToFailMessages($index, $failMsgs) {
        foreach ($failMsgs as &$failMsg) {
            $failMsg = "$index:" . $failMsg;
        }

        return $failMsgs;
    }

    /**
     * @param array $target
     *
     * @return array
     */
    public function validate($target) {
        if (!is_array($target)) {
            return $this->validateRule->validate(AttributeNotExists::instance());
        }

        $ret = array();

        foreach ($target as $key => $value) {
            $ret = array_merge($ret, $this->appendAttrToFailMessages($key, $this->validateRule->validate($value)));
        }

        return $ret;
    }
}
