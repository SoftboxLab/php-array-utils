<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 12/05/17
 * Time: 21:43
 */

namespace ArrayUtils;

interface AttributeAccessor {

    /**
     * @param array $target
     *
     * @return mixed
     */
    public function getValue(array $target);

    /**
     * @param array $target
     * @param       $newValue
     *
     * @return mixed
     */
    public function setValue(array &$target, $newValue);

    /**
     * @param array $target
     *
     * @return array
     */
    public function cast(array $target);

    /**
     * @return AttributeAccessor
     */
    public function withCasting();

    /**
     * @return AttributeAccessor
     */
    public function withoutCasting();

    /**
     * @param array $target
     *
     * @return array
     */
    public function validate($target);

    /**
     * @param ValidationRule $validateRule
     *
     * @return AttributeAccessor
     */
    public function setValidateRule(ValidationRule $validateRule);

    /**
     * @param CastRule $castRule
     *
     * @return AttributeAccessor
     */
    public function setCastRule(CastRule $castRule);
}
