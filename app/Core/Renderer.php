<?php

namespace App\Core;

use App\Firelines\CliRenderable;
use App\Firelines\HttpRenderable;

/**
 * Renderer
 * 
 * To render renderable contexes in result.
 */
class Renderer
{
    /**
     * render To Terminal fucntion
     * 
     * render CliRenderable as a plain text into terminal!
     *
     * @param IRenderable $renderable
     * @return void
     */
    public static function renderToTerminal(CliRenderable $renderable)
    {
        echo $renderable;
        self::exit();
    }

    /**
     * Render to Http fucntion
     * 
     * Renders HttpRenderable to http.
     *
     * @param HttpRenderable $renderable
     * @return void
     */
    public function renderToHttp(HttpRenderable $renderable)
    {
        foreach ($renderable->headers as $header => $value) {
            header("${header}" . ($header == "" ? "" : "") . "${value}");    
        }
        http_response_code($renderable->status_code);
        if ($renderable->session_overwriting) {
            $_SESSION = $renderable->sessions;
        }

        echo $renderable->getBody(); 

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
