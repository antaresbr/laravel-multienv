<?php

namespace Antares\Multienv;

use Antares\Foundation\CurrentEnv;

class BootstrapEnv extends CurrentEnv
{
    /**
     * Singleton instance object
     * 
     * @var static
     */
    private static $_instance = null;

    /**
     * Check if the singleton instance has been created
     * 
     * @return static
     */
    public static function hasInstance()
    {
        return (static::$_instance !== null);
    }

    /**
     * Get the singleton object instance
     * 
     * @return static
     */
    public static function singleton()
    {
        if (!static::hasInstance()) {
            static::$_instance = static::make();
        }
        return static::$_instance;
    }
}
