<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\ValidationRule;

class BooleanValidation implements ValidationRule {
    /**
     * @return string
     */
    public function getIdentifier() {
        return "boolean";
    }

    /**
     * @param $value
     *
     * @return array
     */
    public function validate($value) {
        return is_bool($value) ? array() : array("O campo deve ser um valor boleano.");
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
    }
}
