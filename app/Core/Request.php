<?php

namespace App\Core;

use Exception;

/**
 * Request class
 * 
 * Details about incoming request.
 */
class Request
{
    /**
     * Requests list
     *
     * @var Arr
     */
    private $requests;

    public function __construct()
    {
        $this->requests = new Arr(array_merge($_REQUEST, $_POST, $_GET, $this->parseRequestString(file_get_contents('php://input'))));
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = new static();
        return $instance->{$name}(...$arguments);   
    }

    /**
     * Return all requests
     *
     * @return Arr
     */
    public function all(): Arr
    {
        return $this->requests;
    }

    /**
     * Returns post method data as a collection
     *
     * @return Arr
     */
    public function post()
    {
        return new Arr($_POST);
    }

    /**
     * Returns get method data as a collection
     *
     * @return Arr
     */
    public function get(): Arr
    {
        return new Arr($_GET);
    }

    /**
     * Returns put and delete method data
     *
     * @return Arr
     */
    public function put(): Arr
    {
        return new Arr($this->parseRequestString(file_get_contents('php://input')));
    }

    /**
     * Parses request string
     *
     * @param string $requests
     * @return array
     */
    protected function parseRequestString(string $requests): array
    {
        if ($requests != '') {
            $tokens = explode('&', $requests);
            $requests = [];
            foreach ($tokens as $item) {
                if (!preg_match('/^(.*)=(.*)$/', $item, $mathces)) {
                    throw new Exception("Other Error: Invalid Format of String.", 902);
                } else {
                    $requests[$mathces[1]] = $mathces[2];
                }
            }
            return $requests;
        }
        return [];
    }

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
}
