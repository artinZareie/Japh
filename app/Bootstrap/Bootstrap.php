<?php

namespace App\Bootstrap;
use App\Core\Kernel;
use App\Core\Platform;

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
        $this->exceptionBoot();
        $this->dependencyInjectionBoot();
        $this->providerBoot();
        $this->cliBoot();
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
     * Cli Boot
     * 
     * Runs ob_start and other things to use cli.
     *
     * @return void
     */
    public function cliBoot(): void
    {
        if (Platform::isCli()) CliBootstrap::boot();
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
     * Exception Boot
     * 
     * Register an exception handler like whoops and etc. 
     *
     * @return void
     */
    public function exceptionBoot(): void
    {
        ExceptionBootstrap::registerWhoops();
    }

    /**
     * Provider Boot
     * 
     * Runs boot function from defined providers.
     *
     * @return void
     */
    public function providerBoot(): void
    {
        ProviderBootstrap::boot();
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
        foreach (ProviderBootstrap::$providers as $provider) {
            if (\method_exists($provider, 'run')) {
                $provider->run();
            }
        }
        $kernel->render();
    }
}
