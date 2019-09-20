<?php

return [
    "singletones" => [
        App\Core\Kernel::class,
    ],
    "exception_handler" => \Whoops\Handler\PrettyPageHandler::class,
];