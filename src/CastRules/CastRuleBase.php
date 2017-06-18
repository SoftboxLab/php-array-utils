<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 13/05/17
 * Time: 14:34
 */

namespace ArrayUtils\CastRules;

use ArrayUtils\CastRule;

abstract class CastRuleBase implements CastRule {

    protected $params;

    protected $options = array();

    public function addOptionHandler($option, callable $handler) {
        $this->options[$option] = $handler;
    }

    public function setParams($params) {
        $this->params = $params;
    }

    private function executeOptions($value) {
        if (!$this->params) {
            return $value;
        }

        foreach (array_keys($this->params) as $option) {
            if (isset($this->options[$option])) {
                $value = $this->options[$option]($value);
            }
        }

        return $value;
    }

    public function getParams() {
        return $this->params;
    }

    public function cast($value) {
        return $this->executeOptions($value);
    }
}
