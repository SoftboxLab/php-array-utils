<?php

namespace ArrayUtils\AttributeAccessors;

class AttributeNotExists {
    private static $instance;

    public static final function instance() {
        if (!static::$instance) {
            static::$instance = new AttributeNotExists();
        }

        return static::$instance;
    }
}
