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
        if (($value === null && !$this->allowNull) || !is_numeric($value)) {
            return array("Campo não é numérico.");
        }

        return array();
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
        $this->allowNull = isset($params[0]) && $params[0] == "nullable";
    }
}
