<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 15/06/17
 * Time: 19:34
 */

namespace ArrayUtils;

use Throwable;

class ValidationException extends \Exception {

    public function __construct($message = "", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
