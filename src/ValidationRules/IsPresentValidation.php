<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\AttributeAccessors\AttributeNotExists;
use ArrayUtils\ValidationRule;

class IsPresentValidation implements ValidationRule {

    /**
     * @return string
     */
    public function getIdentifier() {
        return "present";
    }

    /**
     * @param $value
     *
     * @return array
     */
    public function validate($value) {
        if ($value instanceof AttributeNotExists) {
            return array("O campo deve estar presente.");
        }

        return array();
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
    }
}
