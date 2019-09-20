<?php

function dd(...$vars)
{
    foreach ($vars as $item) {
        var_dump($item);
    }
    die();
}

function dir_glue(string ...$dirs)
{
    return implode(DIRECTORY_SEPARATOR, $dirs);
}

function config(?string $name = null, string $file = "app")
{
    if (file_exists(dir_glue(__DIR__, "..", "config", "app" . ".php"))) {
        $data = include (dir_glue(__DIR__, "..", "config", "app" . ".php"));
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
    // TODO: Use Injector class to inject the dependency
    // NOTICE: Singletones will be filter
}