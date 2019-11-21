<?php

namespace App\Services;

use App\Core\Service;
use App\Firelines\HttpRenderable;

/**
 * Http Response Service class
 * 
 * Contains the main response of application when using http.
 */
class HttpResponseService
{
    use Service;
    
    /**
     * Init function
     *
     * @return void
     */
    public static function init(): void
    {
        self::$context["Response"] = new HttpRenderable();
    }
    
    /**
     * Get Response function
     * 
     * Get "Response" of this service.
     *
     * @return HttpRenderable
     */
    public static function getResponseClass(): HttpRenderable
    {
        return self::$context['Response'];
    }

    /**
     * Set Response Class function
     * 
     * Changes the context with passed parameter.
     *
     * @param HttpRenderable $renderable
     * @return void
     */
    public static function setResponseClass(HttpRenderable $renderable): void
    {
        self::$context['Response'] = $renderable;
    }

    /**
     * Get function
     *
     * @param string $name
     * @return void
     */
    public static function get(string $name)
    {
        return self::$context['Response']->{$name};
    }

    /**
     * Set function
     *
     * @param string $name
     * @param any $value
     * @return void
     */
    public static function set(string $name, $value): void
    {
        self::$context['Response']->{$name} = $value;
    }

    public static function addHeader(string $name, string $value): void
    {
        self::$context['Response']->headers[$name] = $value;
    }

    /**
     * Remove Header function
     *
     * @param string $name
     * @return void
     */
    public static function removeHeader(string $name): void
    {
        unset(self::$context['Response']->headers[$name]);
    }

    /**
     * Clear header function
     *
     * @return void
     */
    public function clearHeaders(): void
    {
        self::$context['Response']->headers = [];
    }
}
