<?php

namespace App\Core;

/**
 * Router class
 * 
 * Base routing class for http.
 */
class Router
{
    public static function getCurrentURI(): string
    {
        dd($_SERVER['REQUEST_URI']);
        return $_SERVER['REQUEST_URI'];    
    }
}
