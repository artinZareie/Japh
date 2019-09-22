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

    public static function coloredString(string $expr, ?string $foreground_color = null, ?string $background_color = null): string
    {
        $colored_string = "";

        // Check if given foreground color found
        if (isset($foreground_color)) {
            $colored_string .= "\033[" . $foreground_color . "m";
        }
        // Check if given background color found
        if (isset($background_color)) {
            $colored_string .= "\033[" . $background_color . "m";
        }

        // Add string and end coloring
        $colored_string .=  $expr . "\033[0m";

        return $colored_string;
    }
}
