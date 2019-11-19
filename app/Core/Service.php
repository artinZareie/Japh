<?php

namespace App\Core;

/**
 * Service class
 * 
 * Used for creating services. Here, a Service is a "data context" that
 * contains some data that can be change in a request life cycle.
 * Data will be available from anywhere of application by calling them.
 * And It's almost like "Redis".
 */
class Service {
    /**
     * Context
     * 
     * Contains keys and values of service.
     *
     * @var array
     */
    protected static $context = [];

    /**
     * Get Context function
     *
     * @return array
     */
    public static function getContext(): array 
    {
        return self::$context;
    }

    /**
     * Set function
     *
     * @param string $name
     * @param any $value
     * @return void
     */
    public static function set(string $name, $value): void
    {
        self::$context[$name] = $value;
    }

    /**
     * Get function
     *
     * @param string $name
     * @return any
     */
    public static function get(string $name)
    {
        return self::$context[$name];    
    }
}