<?php

namespace App\Services;

use App\Core\Service;
use App\Firelines\HttpRenderable;

/**
 * Http Response Service class
 * 
 * Contains the main response of application when using http.
 */
class HttpResponseService extends Service
{
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
     * Get response of this service.
     *
     * @return HttpRenderable
     */
    public static function getResponse(): HttpRenderable
    {
        return self::$context['Response'];
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

    public function addHeader(string $name, string $value): void
    {
        self::$context['Response']->headers[$name] = $value;
    }

    /**
     * Remove Header function
     *
     * @param string $name
     * @return void
     */
    public function removeHeader(string $name): void
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
