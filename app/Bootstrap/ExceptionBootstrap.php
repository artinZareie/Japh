<?php

namespace App\Bootstrap;

use App\Core\Platform;

class ExceptionBootstrap
{
    public static function registerWhoops() {
        $handler = config("exception_handler", "kernel");
        $whoops = new \Whoops\Run();
        if (!Platform::isCli()) $whoops->prependHandler(new $handler);
        else $whoops->prependHandler(new \Whoops\Handler\PlainTextHandler);
        $whoops->register();
    }
}
