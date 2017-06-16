<?php

namespace ArrayUtils\CastRules;

class IntegerCastRule  extends CastRuleBase {

    public function getIdentifier() {
        return "int";
    }

    public function cast($value) {
        return (int) $value;
    }
}
