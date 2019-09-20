<?php

namespace App\Core;

/**
 * Main Kernel
 * 
 * Main kernel of application
 */
class Kernel implements IKernel, ISingletone
{
    /**
     * Instance of kernel
     *
     * @var Kernel
     */
    private static $instance;

    /**
     * getInstance
     * 
     * If an instance exists returns existing instance and if
     * instance doesn't exists creates a new instance and return it.
     *
     * @return ISingletone
     */
    public static function getInstance(): ISingletone
    {
        if (self::$instance != null) {
            return self::$instance;
        }
        self::$instance = Injector::get(self::class);
        return self::$instance;
    }

    /**
     * @Inject
     * @var Platform
     */
    private $hello;

    /**
     * Kernel call
     * 
     * Will execute when everything is booted and application is ready
     * to execute.
     *
     * @return void
     */
    public function call()
    {
    }
}
