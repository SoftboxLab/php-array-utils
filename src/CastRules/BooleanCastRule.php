<?php

namespace ArrayUtils\CastRules;

class BooleanCastRule  extends CastRuleBase {

    public function getIdentifier() {
        return "bool";
    }

    public function cast($value) {
        return (boolean) $value;
    }
}
