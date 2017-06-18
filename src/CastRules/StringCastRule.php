<?php

namespace ArrayUtils\CastRules;

class StringCastRule extends CastRuleBase {
    public function __construct() {
        $this->loadOptionsHandlers();
    }

    public function getIdentifier() {
        return "string";
    }

    public function cast($value) {
        return parent::cast((string) $value);
    }

    private function loadOptionsHandlers() {
        $self = $this;

        $this->addOptionHandler("max_length", function($value) use ($self) {
            $params = $this->getParams();

            return substr(
                $value,
                0,
                isset($params["max_length"][0]) ? $params["max_length"][0] : 0
            );
        });

        $this->addOptionHandler("rpad", function($value) use ($self) {
            $params = $this->getParams();

            return str_pad(
                $value,
                isset($params["rpad"][0]) ? $params["rpad"][0] : 0,
                isset($params["rpad"][1]) ? $params["rpad"][1] : "",
                STR_PAD_RIGHT);
        });

        $this->addOptionHandler("lpad", function($value) use ($self) {
            $params = $this->getParams();

            return str_pad(
                $value,
                isset($params["lpad"][0]) ? $params["lpad"][0] : 0,
                isset($params["lpad"][1]) ? $params["lpad"][1] : "",
                STR_PAD_LEFT);
        });
    }
}
