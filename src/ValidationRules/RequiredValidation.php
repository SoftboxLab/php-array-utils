<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 15/06/17
 * Time: 15:49
 */

namespace ArrayUtils\ValidationRules;

use ArrayUtils\AttributeAccessors\AttributeNotExists;
use ArrayUtils\ValidationRule;

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
        if (!isset($value) || $value instanceof AttributeNotExists) {
            return array("Campo obrigatório.");
        }

        return array();
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
    }
}
