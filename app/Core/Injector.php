<?php

namespace App\Core;

class Injector
{
    private static $container;

    public static function buildContainer(): void 
    {
        $builder = new \DI\ContainerBuilder();
        $builder->useAnnotations(true);
        self::$container = $builder->build();
    }

    public static function getContainer(): \DI\Container
    {
        return self::$container;
    }

    public static function get(string $class)
    {
        return slef::$container->get($class);
    }
}
