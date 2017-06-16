<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\ValidationRule;

class NotInValidation implements ValidationRule {
    private $allowedValues;

    /**
     * @return string
     */
    public function getIdentifier() {
        return "not_in";
    }

    /**
     * @param $value
     *
     * @return array
     */
    public function validate($value) {
        if (in_array($value, $this->allowedValues)) {
            return array("O campo não deve ser um destes valores " . implode(", ", $this->allowedValues));
        }

        return array();
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
        $this->allowedValues = is_array($params) ? $params : array();
    }
}
