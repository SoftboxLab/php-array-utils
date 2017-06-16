<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 15/06/17
 * Time: 16:30
 */

namespace ArrayUtils\ValidationRules;

use ArrayUtils\ValidationRule;

class GroupOfValidationRules implements ValidationRule {
    /** @var ValidationRule[] */
    private $validationRules = array();

    public function addValidationRule(ValidationRule $validationRule) {
        $this->validationRules[] = $validationRule;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdentifier() {
        return "_";
    }

    /**
     * @param $value
     *
     * @return boolean
     */
    public function validate($value) {
        $ret = array();

        foreach ($this->validationRules as $validationRule) {
            $errosMsgs = $validationRule->validate($value);

            $ret = array_merge($ret, $errosMsgs);
        }

        return $ret;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
    }
}
