<?php

namespace App\Bootstrap;

class CliBootstrap
{
    public static function boot(): void
    {
        ob_start();
    }
}
