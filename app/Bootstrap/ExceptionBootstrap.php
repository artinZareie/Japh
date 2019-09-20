<?php

namespace App\Bootstrap;

class ExceptionBootstrap
{
    public static function registerWhoops() {
        $handler = config("exception_handler", "kernel");
        $whoops = new \Whoops\Run();
        $whoops->prependHandler(new $handler);
        $whoops->register();
    }
}
