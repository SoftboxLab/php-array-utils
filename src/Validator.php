<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 15/06/17
 * Time: 14:56
 */

namespace PHP\Cast;

class Validator {
    /**
     * @var AttributeAccessor[]
     */
    private $rules = array();

    /**
     * @param $path
     * @param $rule
     *
     * @return $this
     */
    public function addRule($path, $rule) {
        $attributeAccessor = $this->getAttributeAccessor($path, $rule);

        $this->rules[] = $attributeAccessor;

        return $this;
    }

    /**
     * @param array $rules
     *
     * @return $this
     */
    public function addRules(array $rules) {
        foreach ($rules as $path => $rule) {
            $this->addRule($path, $rule);
        }

        return $this;
    }

    /**
     * @param $path
     * @param $rule
     *
     * @return AttributeAccessor
     */
    private function getAttributeAccessor($path, $rule) {
        return AttributeAccessorFactory::createAttributeAccessor($path, null, $rule);
    }

    /**
     * @param $value
     *
     * @return array
     */
    public function validate($value) {
        $ret = array();

        foreach ($this->rules as $attrAccessor) {
            $ret = array_merge($ret, $attrAccessor->validate($value));
        }

        return $ret;
    }
}
