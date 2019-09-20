<?php

namespace App\Bootstrap;
use App\Core\Kernel;

/**
 * Bootstrap class
 * 
 * very first class in application
 */
class Bootstrap
{
    /**
     * Boot construct
     * 
     * Entry point of application.
     * will load other boot functions.
     */
    public function __construct()
    {
        $this->boot();
        $this->runApplication();
    }

    /**
     * Boot
     * 
     * Boot and config all dependency.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->httpBoot();
        $this->dependencyInjectionBoot();
    }

    /**
     * Http Boot
     * 
     * Boot http things like
     * sessions, headers, cors
     * and etc.
     *
     * @return void
     */
    public function httpBoot(): void
    {
        HttpBootstrap::start_sessions();        
    }

    /**
     * DI Boot
     * 
     * Boot Injector class and make a builder
     * and containers and make cache for DI in
     * production mode.
     *
     * @return void
     */
    public function dependencyInjectionBoot(): void
    {
        DIBootstrap::boot();        
    }

    /**
     * Run kernel
     * 
     * Runs kernel and application and renderer in kernel will render the result.
     *
     * @return void
     */
    public function runApplication(): void
    {
        $kernel = inject(Kernel::class);
        $kernel->call();
    }
}
