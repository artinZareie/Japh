<?php

namespace App\Core;

/**
 * Collection
 * 
 * Collectios are like indexed arrays but with 
 * some extra oop things and some utilities.
 */
class Collection
{
    /**
     * collection
     *
     * @var array
     */
    private $collection;

    /**
     * Construct
     *
     * @param array $values
     */
    public function __construct(array $values){
        $this->collection = $values;
    }

    /**
     * Add a value to collection
     *
     * @param mixed $value
     * @return void
     */
    public function add($value): void
    {
        array_push($this->collection, $value);
    }
}
