<?php

namespace App\Bootstrap;

class ProviderBootstrap
{
    public static $providers = [];

    public static function boot()
    {
        foreach (config("providers", 'kernel') as $provider) {
            $inst = self::$providers[] = inject($provider);
            $inst->boot();
        }
    }
}
