<?php

namespace PHP\Cast;

interface ValidationRule {

    /**
     * @return string
     */
    public function getIdentifier();

    /**
     * @param $value
     *
     * @return array
     */
    public function validate($value);

    /**
     * @param mixed $params
     */
    public function setParams($params);
}
