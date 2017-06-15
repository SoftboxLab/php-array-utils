<?php

namespace PHP\Cast\AttributeAccessors;


use PHP\Cast\CastRule;
use PHP\Cast\ValidationRule;

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
     * @return boolean
     */
    public function validate($target) {
        $ret = array();

        $total = count($target);

        for ($i = 0; $i < $total; $i++) {
            $ret = array_merge($ret, $this->appendAttrToFailMessages($i, $this->validateRule->validate(isset($target[$i]) ? $target[$i] : null)));
        }

        return $ret;
    }
}
