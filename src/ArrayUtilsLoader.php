<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 15/06/17
 * Time: 20:53
 */

namespace PHP\Cast;

class ArrayUtilsLoader {
    const NAMESPACE_BASE = 'PHP\Cast';

    public static function load($className) {
        $length = strlen(self::NAMESPACE_BASE);

        if (substr($className, 0, $length) !== self::NAMESPACE_BASE) {
            return false;
        }

        $path = str_replace('\\', '/', substr($className, $length));

        $filePath = __DIR__ . $path . '.php';

        include_once($filePath);

        return true;
    }
}
