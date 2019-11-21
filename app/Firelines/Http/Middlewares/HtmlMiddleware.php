<?php

namespace App\Firelines\Http\Middlewares;

use App\Core\Middleware;
use App\Core\Request;
use Closure;

class HtmlMiddleware extends Middleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->getCurrentURI() == '/') {
            \response()->addHeader("Content-Type", 'text/plain');
        }
        return $next($request);
    }
}
