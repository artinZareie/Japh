<?php

namespace App\Firelines\Http;
use App\Core\IFireline;
use App\Core\IRenderable;
use App\Core\Router;
use App\Firelines\CliRenderable;
use App\Firelines\HttpRenderable;

/**
 * Http Fireline Handler class
 */
class Handler implements IFireline
{
    /**
     * Runs Handler
     *
     * @return void
     */
    public function fire(): IRenderable
    {
        Router::runRoute(Router::getCurrentURI());
        return new HttpRenderable();
    }   
}
