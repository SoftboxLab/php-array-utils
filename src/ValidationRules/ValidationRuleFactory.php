<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 15/06/17
 * Time: 15:48
 */

namespace ArrayUtils\ValidationRules;

use ArrayUtils\ValidationRule;

class ValidationRuleFactory {
    private static $validationRules = array();

    public static function load() {
        if (empty(static::$validationRules)) {
            $classes = array(
                new NumericValidation(),
                new RequiredValidation(),
                new MaxValueValidation(),
                new DateValidation(),
                new InValidation(),
                new NotInValidation(),
                new StringValidation(),
                new IsPresentValidation(),
                new BooleanValidation()
            );

            foreach ($classes as $instance) {
                static::$validationRules[$instance->getIdentifier()] = $instance;
            }
        }
    }

    public static function register(ValidationRule $validationRule) {
        self::load();

        static::$validationRules[$validationRule->getIdentifier()] = $validationRule;
    }

    public static function create($rules) {
        static::load();

        $rules = explode("|", $rules);

        $groupOfRules = new GroupOfValidationRules();

        foreach ($rules as $ruleCommand) {
            list($rule, $params) = array_pad(explode(":", $ruleCommand, 2), 2, null);

            if (!isset(static::$validationRules[$rule])) {
                throw new \InvalidArgumentException("There is no validation rule for '$rule' identifier.");
            }

            /** @var ValidationRule $validationRule */
            $validationRule = clone static::$validationRules[$rule];
            $validationRule->setParams(static::parseParams($params));

            $groupOfRules->addValidationRule($validationRule);
        }

        return $groupOfRules;
    }

    private static function parseParams($params) {
        if ($params == null) {
            return null;
        }

        return array_filter(explode(",", $params));
    }
}
