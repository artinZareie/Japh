<?php

namespace App\Core;

use App\Firelines\HttpRenderable;
use App\Services\HttpResponseService;
use App\Services\MiddlewaresService;
use Closure;
use Exception;

/**
 * Router class
 * 
 * Base routing class for http.
 */
class Router
{
    /**
     * Get Current URI function
     *
     * @return string
     */
    public static function getCurrentURI(): string
    {
        // Delete fragmets and get data from REQUEST_URI
        return explode("?", explode("?", $_SERVER['REQUEST_URI'])[0])[0];    
    }

    /**
     * Match function
     *
     * @param string $uri
     * @param string $rule
     * @param string[] $matches
     * @return boolean
     */
    public static function match(string $uri, string $rule, &$matches = null): bool
    {
        $rule = self::regexFromRule($rule);

        return \preg_match($rule, $uri, $matches);
    }

    /**
     * Regex From Rule frunction
     *
     * @param string $rule
     * @return string
     */
    public static function regexFromRule(string $rule): string
    {
        $rule = "/^" . str_replace("/", "\/", $rule) . "$/";
        $rule = str_replace('<', "(", $rule);
        $rule = str_replace('>', ")", $rule);
        
        return $rule;
    }

    /**
     * Run Route function
     * 
     * Gets a uri and iterate routes. if uri matches with rule, then it will run it.
     *
     * @param string $uri
     * @return void
     */
    public static function runRoute(string $uri): void
    {
        $routes = \config(null, 'routes');
        foreach ($routes as $route) {
            if (self::match($uri, $route['uri'], $matches)) {
                if (array_key_exists('method', $route) && !self::checkMethod($route['method'])) {
                    continue;
                }
                self::directController($route, array_slice($matches, 1));
                break;
            }
        }
    }

    /**
     * Get Method function
     * 
     * Returns $_SERVER['REQUEST_METHOD']
     *
     * @return string
     */
    public static function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Check Method function
     * 
     * Checks if the method is matched then will return true.
     *
     * @param string|array $method
     * @return boolean
     */
    public static function checkMethod($method): bool
    {
        if (is_string($method)) {
            $method = [$method];
        }

        foreach ($method as $key => $value) {
            $method[$key] = \strtoupper($value);
        }

        return in_array(self::getMethod(), $method);
    }

    /**
     * Direct Route
     * 
     * Gets a route and detects its type and etc. Then will run it and returns "HttpRenderable".
     *
     * @param array $route
     * @return void
     */
    public static function directController(array $route, array $matches = []): void
    {
        if ($route['controller'] instanceof Closure) {
            self::runMidlewares();
            $result = self::runClosureController($route['controller'], $matches);
        }
        elseif (is_string($route['controller'])) {
            $params = self::createClassControllerInstance($route['controller']);
            self::runMidlewares();
            $result = self::runClassController(...array_merge($params, [$matches]));
        }
        elseif ($route['controller'] instanceof Controller) {
            self::runMidlewares();
            if (array_key_exists('method', $route)) {
                $method = $route['method'];
            }
            else {
                $method = 'index';
            }
            $result = self::runClassController($route['controller'], $method, $matches);
        }
        self::responseChecker($result);
    }

    /**
     * Response Checker function
     *
     * @param mixed $result
     * @return void
     */
    public static function responseChecker($result): void
    {
        if (is_string($result)) {
            response()->setBody($result);
        }
        elseif (is_numeric($result)) {
            response()->setBody((string) $result);
        }
        elseif (is_array($result)) {
            response()->json($result);
        }
        elseif ($result instanceof HttpRenderable) {
            HttpResponseService::setResponseClass($result);
        }
        elseif (is_null($result)) {
            \response()->clearBody();
        }
        else {
            throw new Exception("Other Error: Not supported type. Your route has returned a not supported type", 901);
        }
    }

    /**
     * Run Closure Controller
     * 
     * If the controller type is <Closure>, then will run it with matched parameters and returns response.
     *
     * @param Closure $controller
     * @param array $matches
     * @return any
     */
    public static function runClosureController(Closure $controller, array $matches = [])
    {
        return $controller(...$matches);
    }

    /**
     * Create Class Controller Instance function
     *
     * @param string $controller_string
     * @return array
     */
    public static function createClassControllerInstance(string $controller_string): array
    {
        $rule = '/^([a-zA-Z_0-9]+)\.([a-zA-Z_0-9]*)$/';
        if (!preg_match($rule, $controller_string, $matches)) {
            throw new Exception("Router Error: Class controller string is not valid. it's form must be \"Class.Methdo\"", 100);
        }
        $instance = inject($matches[0]);
        return [$instance, $matches[1]];
    }

    /**
     * Run Class Controller
     * 
     * If type of controller is class then will run called method.
     *
     * @param Controller $controller
     * @param string $method
     * @param array $matches
     * @return void
     */
    public static function runClassController(Controller $controller, string $method, array $matches = [])
    {
        if ($method == '') {
            $method = 'index';
        }
        return $controller->{$method}(...$matches);
    }

    protected static function runMidlewares(): void
    {
        $pipeline = (new RecurcivePipeline(MiddlewaresService::getContext()))->send(\request());
        $pipeline->thenReturn();
    }
}
