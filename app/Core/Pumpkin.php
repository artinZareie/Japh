<?php

namespace App\Core;

/**
 * Pumpkin
 * 
 * command line managment class
 */
class Pumpkin
{
    /**
     * Commands
     *
     * @var array
     */
    private static $commands = [];

    public static function registerCommand(string $name, string $controller): void
    {
        self::$commands[$name] = $controller;    
    }
}
