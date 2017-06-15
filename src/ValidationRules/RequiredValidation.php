<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 15/06/17
 * Time: 15:49
 */

namespace PHP\Cast\ValidationRules;

use PHP\Cast\ValidationRule;

class RequiredValidation implements ValidationRule {

    /**
     * @return string
     */
    public function getIdentifier() {
        return 'required';
    }

    /**
     * @param $value
     *
     * @return array
     */
    public function validate($value) {
        if (!isset($value)) {
            return array("Campo obrigatório. ");
        }

        return array();
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
    }
}
