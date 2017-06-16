<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 15/06/17
 * Time: 15:03
 */

namespace ArrayUtils;

use ArrayUtils\AttributeAccessors\ArrayAttributeWrapper;
use ArrayUtils\AttributeAccessors\ArrayNestedAttributeWrapper;
use ArrayUtils\AttributeAccessors\AttributeWrapper;
use ArrayUtils\AttributeAccessors\NestedAttributeWrapper;
use ArrayUtils\CastRules\CastRuleFactory;
use ArrayUtils\ValidationRules\ValidationRuleFactory;

class AttributeAccessorFactory {

    public static function createAttributeWrapper($attribute, $castRule = null, $validateRule = null) {
        if ($attribute == "*") {
            return new ArrayAttributeWrapper($castRule, $validateRule);
        }

        return new AttributeWrapper($attribute, $castRule, $validateRule);
    }

    public static function createNestedAttributeWrapper($attribute, $childAttrAcessor) {
        if ($attribute == "*") {
            return new ArrayNestedAttributeWrapper($childAttrAcessor);
        }

        return new NestedAttributeWrapper($attribute, $childAttrAcessor);
    }

    public static function createAttributeAccessor($path, $castRule = null, $validationRule = null) {
        $tokens = explode(".", $path);

        $i = count($tokens) - 1;

        $validationRuleInstance = self::getValidationRuleInstance($validationRule);

        $castRuleInstance = self::getCastRuleInstance($castRule);

        /** @var AttributeAccessor $attributeAccessor */
        $attributeAccessor = self::createAttributeWrapper($tokens[$i--], $castRuleInstance, $validationRuleInstance);

        for (; $i >= 0; $i--) {
            $attributeAccessor = self::createNestedAttributeWrapper($tokens[$i], $attributeAccessor);
        }

        return $attributeAccessor;
    }

    /**
     * @param $validationRule
     *
     * @return null|ValidationRule|ValidationRules\GroupOfValidationRules
     */
    private static function getValidationRuleInstance($validationRule) {
        if ($validationRule instanceof ValidationRule) {
            return $validationRule;
        }

        if (is_string($validationRule)) {
            return ValidationRuleFactory::create($validationRule);
        }

        return null;
    }

    /**
     * @param $castRule
     *
     * @return null|CastRule
     */
    private static function getCastRuleInstance($castRule) {
        if ($castRule instanceof CastRule) {
            return $castRule;
        }

        if (is_string($castRule)) {
            return CastRuleFactory::create($castRule);
        }

        return null;
    }
}
