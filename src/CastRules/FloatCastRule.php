<?php

namespace ArrayUtils\CastRules;

class FloatCastRule extends CastRuleBase {

    public function getIdentifier() {
        return "float";
    }

    public function cast($value) {
        return (float) $value;
    }
}
