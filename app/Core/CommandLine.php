<?php

namespace App\Core;

class CommandLine
{
    public static function args(): ?array
    {
        global $argv;
        return $argv;
    }

    public static function parameters(): ?array
    {
        global $argv;
        return array_slice($argv, 1);
    }

    public static function targetFile(): ?string
    {
        global $argv;
        return $argv[0];
    }
}
