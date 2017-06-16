<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 15/06/17
 * Time: 16:11
 */

namespace ArrayUtils\ValidationRules;

use ArrayUtils\ValidationRule;

class NumericValidation implements ValidationRule {
    private $allowNull = false;

    /**
     * @return string
     */
    public function getIdentifier() {
        return "numeric";
    }

    /**
     * @param $value
     *
     * @return array
     */
    public function validate($value) {
        if (($this->allowNull && $value === null) || is_numeric($value)) {
            return array();
        }

        return array("Campo não é numérico.");
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
        $this->allowNull = isset($params[0]) && $params[0] == "nullable";
    }
}
