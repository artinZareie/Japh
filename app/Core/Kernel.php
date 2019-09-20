<?php

namespace App\Core;

class Kernel implements IKernel, ISingletone
{
    private static $instance;

    public static function getInstance(): ISingletone
    {
        if (self::$instance != null) {
            return self::$instance;
        }
        self::$instance = Injector::get(self::class);
        return self::$instance;
    }

    public function call()
    {

    }
}
