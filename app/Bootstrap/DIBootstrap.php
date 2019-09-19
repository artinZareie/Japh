<?php

namespace App\Bootstrap;

class DIBootstrap
{
    public static function boot(){
        \App\Core\Injector::buildContainer();
    }
}
