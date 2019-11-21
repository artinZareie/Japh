<?php

namespace App\Services;

use App\Core\Service;
use Exception;

class MiddlewaresService
{
    use Service;

    protected static $context = [];

    public static function init(): void
    {
        self::$context = config('default_middlewares', 'http');    
    }

    /**
     * Adds a middleware
     *
     * @param string|Middleware $middleware
     * @return void
     */
    public static function add($middleware): void
    {
        self::$context[] = $middleware;
    }
}
