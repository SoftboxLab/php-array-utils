<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 12/05/17
 * Time: 23:34
 */

namespace ArrayUtils\CastRules;

use ArrayUtils\CastRule;

abstract class CastRuleFactory {
    private static $castRules = array();

    private static function load() {
        if (empty(static::$castRules)) {
            $classes = array(
                new IntegerCastRule(),
                new FloatCastRule(),
                new FloatCastRule(),
                new StringCastRule(),
                new BooleanCastRule()
            );

            foreach ($classes as $instance) {
                static::$castRules[$instance->getIdentifier()] = $instance;
            }
        }
    }

    private static function parseParams($params) {
        if (empty($params)) {
            return array();
        }

        $ret = array();

        $options = explode(";", $params);

        foreach ($options as $opt) {
            list($key, $value) = array_pad(explode(":", $opt, 2), 2, null);

            $ret[$key] = explode(",", $value);
        }

        return $ret;
    }

    public static function register(CastRule $castRule) {
        static::load();

        static::$castRules[$castRule->getIdentifier()] = $castRule;
    }

    /**
     * @param string $rule
     *
     * @return CastRule
     */
    public static function create($rule) {
        static::load();

        list($identifier, $params) = array_pad(explode("|", $rule, 2), 2, null);

        if (!isset(static::$castRules[$identifier])) {
            throw new \InvalidArgumentException("There is no cast rule for '$identifier'.");
        }

        /** @var CastRule $castRule */
        $castRule = new static::$castRules[$identifier];

        $castRule->setParams(static::parseParams($params));

        return $castRule;
    }
}
