<?php

namespace App\Core;

use App\Firelines\CliRenderable;

/**
 * Renderer
 * 
 * To render renderable contexes in result.
 */
class Renderer
{
    /**
     * renderToTerminal
     * 
     * render CliRenderable as a plain text into terminal!
     *
     * @param IRenderable $renderable
     * @return void
     */
    public static function renderToTerminal(CliRenderable $renderable)
    {
        echo (string) $renderable;
        self::exit();
    }

    /**
     * Exit
     *
     * @param integer $code
     * @return void
     */
    private static function exit(int $code = 0): void
    {
        exit($code);        
    }
}
