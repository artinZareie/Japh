<?php

namespace App\Core;

use App\Services\HttpResponseService;

abstract class Controller
{
    public abstract function index();

    public function redirect(string $uri): void
    {
        response()->redirect($uri);
    }
}
