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

    public static function collect(array $values){
        return new static($values);
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

    /**
     * Remove
     *
     * Remove passed value from collection.
     * 
     * @param mixed $value
     * @return void
     */
    public function remove($value): void
    {
        foreach ($this->collection as $key => $item) {
            if ($value == $item) 
                unset($this->collection[$key]);
        }
    }

    public function uniques(): Collection
    {
        return Collection::collect(array_unique($this->collection));
    }
}
