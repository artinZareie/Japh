<?php

namespace App\Core;

use Iterator;

/**
 * Adcanced Array
 * 
 * An array with extra utilities.
 */
class Arr implements Iterator
{
    /**
     * Collection
     *
     * @var array
     */
    private $collection = [];

    /**
     * Array keys
     *
     * @var array
     */
    private $keys = [];

    /**
     * Position of iterator
     *
     * @var integer
     */
    private $position = 0;

    /**
     * Array values
     *
     * @var array
     */
    private $values = [];

    public function __construct(?array $data = [])
    {
        $this->collection = $data;    
    }

    /**
     * Set the key equal value.
     *
     * @param string $key
     * @param string $value
     * @return Arr
     */
    public function set(string $key, string $value): Arr
    {
        $this->collection[$key] = $value;
        return $this;    
    }

    /**
     * Get value of a key
     *
     * @param string $key
     * @return any
     */
    public function get(string $key)
    {
        return $this->collection[$key];
    }

    public function __set($name, $value)
    {
        $this->collection[$name] = $value;
    }

    public function __get($name)
    {
        return $this->collection[$name];
    }

    /**
     * Return only passed keys.
     *
     * @param array $keys
     * @return Arr
     */
    public function only(array $keys): Arr
    {
        return new Arr(array_filter($this->collection, function ($key, $value) use ($keys) {
            return in_array($key, $keys);
        }));
    }

    /**
     * Remove passed keys from array.
     *
     * @param array $keys
     * @return Arr
     */
    public function except(array $keys): Arr
    {
        return new Arr(array_filter($this->collection, function ($key, $value) use ($keys) {
            return !in_array($key, $keys);
        }));
    }

    /**
     * Rewind function
     * 
     * Iterator Interface
     *
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;
        $this->keys = array_keys($this->collection);
        $this->values = array_values($this->collection);
    }

    /**
     * validate function
     * 
     * Iterator Interface
     *
     * @return bool
     */
    public function valid()
    {
        return isset($this->keys[$this->position]);
    }

    /**
     * current function
     * 
     * Iterator Interface
     *
     * @return mixed
     */
    public function current()
    {
        return $this->collection[$this->keys[$this->position]];
    }

    /**
     * key function
     * 
     * Iterator Interface
     *
     * @return any
     */
    public function key()
    {
        return $this->keys[$this->position];
    }

    /**
     * next function
     * 
     * Iterator Interface
     *
     * @return any
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Returns array
     *
     * @return any
     */
    public function toArray(): array
    {
        return $this->collection;
    }
}
