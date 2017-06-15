<?php

namespace PHP\Cast\CastRules;

class IntegerCastRule  extends CastRuleBase {

    public function getIdentifier() {
        return "int";
    }

    public function cast($value) {
        return (int) $value;
    }
}
