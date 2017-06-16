<?php

namespace ArrayUtils\ValidationRules;

use ArrayUtils\ValidationRule;

class DateValidation implements ValidationRule {
    private $format;

    /**
     * @return string
     */
    public function getIdentifier() {
        return "date";
    }

    private function validateWithFormat($value) {
        $date = DateTime::createFromFormat($this->format, $value);

        if (!$date || $date->format($this->format) != $value) {
            return array("A data fornecida não respeita o padrão '" . $this->format . "'.");
        }

        return array();
    }

    /**
     * @param $value
     *
     * @return array
     */
    public function validate($value) {
        if ($this->format) {
            return $this->validateWithFormat($value);
        }

        return strtotime($value) === false ? array("O campo deve ser uma data valida.") : array();
    }

    /**
     * @param mixed $params
     */
    public function setParams($params) {
        $this->format = isset($params[0]) && is_string($params[0]) ? $params[0] : null;
    }
}
