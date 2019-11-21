<?php

return [
    "providers" => [
        App\Providers\HttpResponseProvider::class,
        App\Providers\MiddlewareProvider::class
    ],
    "singletones" => [
        App\Core\Kernel::class,
    ],
    "exception_handler" => \Whoops\Handler\PrettyPageHandler::class,
];