<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 11/05/17
 * Time: 22:13
 */

namespace ArrayUtils;


class CastHelper {

    /**
     * @var AttributeAccessor[]
     */
    private $rules;

    public function cast(array $value) {
        foreach ($this->rules as $attrAccessor) {
            $value = $attrAccessor->cast($value);
        }

        return $value;
    }

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
     * @param array  $target
     * @param string $path
     * @param string $castRule
     *
     * @return mixed
     */
    public static function get(array $target, $path, $castRule = null) {
        $castHelper = new CastHelper();

        return $castHelper->getValue($target, $path, $castRule);
    }

    public static function doCast(array $target, $rules) {
        $castHelper = new CastHelper();

        return $castHelper->addRules($rules)->cast($target);
    }

    public function getValue(array $value, $path, $castRule = null) {
        return $this->getAttributeAccessor($path, $castRule)->getValue($value);
    }

    /**
     * @param $path
     * @param $rule
     *
     * @return AttributeAccessor
     */
    private function getAttributeAccessor($path, $rule) {
        return AttributeAccessorFactory::createAttributeAccessor($path, $rule);
    }
}
