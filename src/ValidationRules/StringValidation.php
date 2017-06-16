<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\ValidationRule;

class StringValidation implements ValidationRule {
    private $allowNull = false;

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
        if ($this->allowNull && $value === null) {
            return array();
        }

        return is_string($value) ? array() : array("O campo deve ser uma string.");
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
        $this->allowNull = isset($params[0]) && $params[0] == "nullable";
    }
}
