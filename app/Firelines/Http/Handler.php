<?php

namespace App\Firelines\Http;
use App\Core\IFireline;
use App\Core\IRenderable;
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
        inject(HttpRenderable::class);
        return new CliRenderable("Hello");
    }   
}
