<?php

namespace App\Firelines\Http\Middlewares;

use App\Core\Middleware;
use App\Core\Request;
use Closure;

class CustomMiddleware extends Middleware
{
    public function handle(Request $request, Closure $next){
        echo "Hello";
        return $next($request);
    }
}
