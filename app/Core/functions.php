<?php

/**
 * Functions file
 * 
 * Any function that is not related to any
 * class, namespace and etc. will apear hear.
 */

use App\Core\CommandLine;
use App\Core\Injector;
use App\Core\Request;
use App\Firelines\HttpRenderable;
use App\Services\HttpResponseService;

/**
 * array_insert
 *
 * @param array $array
 * @param int $position
 * @param mixed $insert
 * @return array
 */
function array_insert(array &$array, int $position, $insert): array
{
    if ($position > 0) {
        if ($position == 1) {
            array_unshift($array, array());
        } else {
            $position = $position - 1;
            array_splice($array, $position, 0, array(
                ''
            ));
        }
        $array[$position] = $insert;
    }

    return $array;
}

/**
  * Dir Glue 
  *
  * Implode all parts with directory seprator.
  *
  * @param string ...$dirs
  * @return string
  */
function dir_glue(string ...$dirs): string
{
    return implode(DIRECTORY_SEPARATOR, $dirs);
}

/**
 * Config function
 * 
 * will return the name offset in
 * file wich is returned in array.
 *
 * @param string|null $name
 * @param string $file
 * @return mixed
 */
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

/**
 * Inject Function
 * 
 * Useful cases for this function are using DI or Singletones.
 * If you pass name of a singletone or a DI, it will return you an instance.
 *
 * @param string $class
 * @return void
 */
function inject(string $class)
{
    $singletons = config("singletones", "kernel");
    if (in_array($class, $singletons)) {
        return call_user_func($class . "::getInstance");
    }
    return Injector::get($class);
}

/**
 * Dump Die
 * 
 * Var_dump given parameters and then execute die().
 *
 * @param mixed ...$vars
 * @return void
 */
function dd(...$vars): void
{
    if (!config("production")) {
        foreach ($vars as $item) {
            var_dump($item);
        }
        die();
    }
}

/**
 * Response function
 *
 * @return void
 */
function response(): HttpRenderable
{
    return HttpResponseService::getResponseClass();
}

/**
 * Uri function
 * 
 * Takes a parameter and combine it with base url.
 * 
 * @example uri("/app"); ---> http://localhost:8000/app
 *
 * @param string $uri
 * @return string
 */
function uri(string $uri): string
{
    return rtrim(config('base_url'), '/') . $uri;
}

/**
 * Route function
 * 
 * Takes a route name and if it exists returns its uri and if not throws an error.
 *
 * @param string $name
 * @return string
 */
function route(string $name): string
{
    $routes = config(null, "routes");
    foreach ($routes as $route) {
        if (array_key_exists("name", $route) && $route['name'] == $name) {
            $uri = $route['uri'];
            break;
        }
    }

    if (!isset($uri)) {
        throw new Exception("Router Error: No route has defined with name \"${name}\"", 101);
    }

    return rtrim(config('base_url'), '/') . $uri;
}

/**
 * Returns an instance of Request class.
 *
 * @return Request
 */
function request(): Request
{
    return new Request();
}