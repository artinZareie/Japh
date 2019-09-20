<?php

function dir_glue(string ...$dirs): string
{
    return implode(DIRECTORY_SEPARATOR, $dirs);
}

function config(?string $name = null, string $file = "app")
{
    if (file_exists(dir_glue(__DIR__, "..", "config", $file . ".php"))) {
        $data = include (dir_glue(__DIR__, "..", "config", $file . ".php"));
        if (!is_null($name)) {
            if (array_key_exists($name, $data)) {
                return $data[$name];
            }
            return null;
        }
        return $data;
    }
    return null;
}

function inject(string $class)
{
    $singletons = config("singletones", "kernel");
    if (in_array($class, $singletons)) {
        return call_user_func($class . "::getInstance");
    }
    return App\Core\Injector::get($class);
}

function dd(...$vars): void
{
    if (!config("production")) {
        foreach ($vars as $item) {
            var_dump($item);
        }
        die();
    }
}