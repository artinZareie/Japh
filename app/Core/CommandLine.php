<?php

namespace App\Core;

/**
 * Commandline
 * 
 * Helper to write a Cli application.
 */
class CommandLine
{
    /**
     * Args
     * 
     * Returns $argv
     *
     * @return array|null
     */
    public static function args(): ?array
    {
        global $argv;
        return $argv;
    }

    /**
     * parameters
     *
     * @return array|null
     */
    public static function parameters(): ?array
    {
        global $argv;
        return array_slice($argv, 1);
    }

    /**
     * TargetFile
     * 
     * Return the first file (lile index.php when you run `php index.php`).
     *
     * @return string|null
     */
    public static function targetFile(): ?string
    {
        global $argv;
        return $argv[0];
    }

    /**
     * print
     * 
     * Prints expr to screen buffer and then flush the screen buffer.
     *
     * @param string $expr
     * @return void
     */
    public static function ptint(string $expr): void
    {
        echo $expr;
        flush();
        ob_flush();
    }

    /**
     * Clear
     * 
     * Cleans screen buffer.
     *
     * @return void
     */
    public static function clear(): void
    {
        ob_clean();    
    }

    /**
     * contents
     * 
     * Returns screen buffer.
     *
     * @return string
     */
    public static function contents(): string
    {
        return ob_get_contents();    
    }
}
