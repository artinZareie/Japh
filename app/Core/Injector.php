<?php

namespace App\Core;

class Injector
{
    private static $container;

    public static function buildContainer(): void 
    {
        $builder = new \DI\ContainerBuilder();
        $builder->useAnnotations(true);
        if (config("production")) {
            $builder->enableCompilation(dir_glue(config("base_root"), "temp"));
            $builder->writeProxiesToFile(true, dir_glue(config("base_root"), "temp", "proxies"));
        }
        self::$container = $builder->build();
    }

    public static function getContainer(): \DI\Container
    {
        return self::$container;
    }

    public static function get(string $class)
    {
        return self::$container->get($class);
    }
}
