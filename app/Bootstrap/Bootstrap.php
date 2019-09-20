<?php

namespace App\Bootstrap;
use App\Core\Kernel;

class Bootstrap
{
    public function __construct()
    {
        $this->boot();
        $this->runApplication();
    }

    public function boot(): void
    {
        HttpBootstrap::start_sessions();
        DIBootstrap::boot();
    }

    public function runApplication()
    {
        $kernel = inject(Kernel::class);
        $kernel->call();
    }
}
