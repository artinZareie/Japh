<?php

namespace App\Core;

use Closure;

/**
 * Middleware class
 * 
 * Used for creating middlewares.
 */
abstract class Middleware {
    /**
     * The urls this middleware has no effect on those.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * Handle function
     * 
     * Handle the request and next middleware.
     *
     * @return void
     */
    public abstract function handle(Request $request, Closure $next);

    /**
     * Guard function
     * 
     * If returns false redirect function will run.
     *
     * @return boolean
     */
    public function guard(Request $request): bool
    {
        return true;
    }

    /**
     * Run if guard returns false.
     *
     * @param Request $request
     * @return void
     */
    public function redirect(Request $request): void
    {
        redirect(uri('/'));
    }
}