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
    }

    public function __destruct()
    {
        
    }
}
