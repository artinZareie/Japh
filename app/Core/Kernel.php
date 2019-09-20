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
        self::$instance = new static();
        return self::$instance;
    }

    public function call()
    {
        
    }

    public function result()
    {
        
    }
}
