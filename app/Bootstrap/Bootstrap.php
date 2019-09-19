<?php

namespace App\Bootstrap;

class Bootstrap
{
    public function __construct()
    {
        $this->inject();
    }

    public function inject(): void
    {
        HttpBootstrap::start_sessions();
        DIBootstrap::boot();
    }

    public function __destruct()
    {
        
    }
}
