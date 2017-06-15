<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 15/06/17
 * Time: 16:11
 */

namespace PHP\Cast\ValidationRules;

use PHP\Cast\ValidationRule;

class MaxValueValidation implements ValidationRule {
    private $maxValue = 0;

    /**
     * @return string
     */
    public function getIdentifier() {
        return "max";
    }

    /**
     * @param $value
     *
     * @return array
     */
    public function validate($value) {
        if (is_numeric($value) && $value <= $this->maxValue) {
            return array();
        }

        return array("Campo é maior que o valor máximo " . $this->maxValue . ".");
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
        if (isset($params[0]) && is_numeric($params[0])) {
            $this->maxValue = $params[0];
        }
    }
}
