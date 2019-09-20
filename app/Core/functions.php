<?php

function dir_glue(string ...$dirs)
{
    return implode(DIRECTORY_SEPARATOR, $dirs);
}

function config(string $name, string $file = "app")
{
    if (file_exists(dir_glue(__DIR__, "..", "config", "app" . ".php"))) {
        # code...
    }
    else {
        return null;
    }
}

function inject(string $class)
{
    // TODO: Use Injector class to inject the dependency
    // NOTICE: Singletones will be filter
}