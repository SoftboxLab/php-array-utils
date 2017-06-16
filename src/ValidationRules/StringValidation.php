<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\ValidationRule;

class StringValidation implements ValidationRule {
    /**
     * @return string
     */
    public function getIdentifier() {
        return "string";
    }

    /**
     * @param $value
     *
     * @return array
     */
    public function validate($value) {
        return is_string($value) ? array() : array("O campo deve ser uma string.");
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
    }
}
