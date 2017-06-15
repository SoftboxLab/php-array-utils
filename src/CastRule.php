<?php

namespace PHP\Cast;

interface CastRule {

    /**
     * @return string
     */
    public function getIdentifier();

    /**
     * @param $value
     *
     * @return mixed
     */
    public function cast($value);

    /**
     * @param mixed $params
     *
     * @return null
     */
    public function setParams($params);
}
