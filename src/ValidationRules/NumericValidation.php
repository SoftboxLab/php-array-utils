<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 15/06/17
 * Time: 16:11
 */

namespace PHP\Cast\ValidationRules;

use PHP\Cast\ValidationRule;

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
