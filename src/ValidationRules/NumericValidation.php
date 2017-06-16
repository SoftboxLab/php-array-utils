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
        if (!is_numeric($value)) {
            return array("Campo não é numérico.");
        }

        return array();
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
    }
}
