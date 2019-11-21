<?php

namespace App\Core;
use Iterator;

/**
 * Collection
 * 
 * Collectios are like indexed arrays but with 
 * some extra oop things and some utilities.
 */
class Collection implements Iterator
{
    /**
     * collection
     *
     * @var array
     */
    private $collection;
    /**
     * Iterator position
     *
     * @var integer
     */
    private $position = 0;

    /**
     * Construct
     *
     * @param array $values
     */
    public function __construct(array $values){
        $this->collection = array_values($values);
    }

    /**
     * Collect function
     *
     * @param array $values
     * @return Collection
     */
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
        $this->collection[] = $value;
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
        $this->sortKeys();
    }

    /**
     * uniqe
     * 
     * Give a collection of unique values of current collection.
     *
     * @return Collection
     */
    public function uniques(): Collection
    {
        return Collection::collect(array_unique($this->collection));
    }

    /**
     * Sort Keys
     *
     * @return void
     */
    public function sortKeys(): void {
        $this->collection = array_values($this->collection);
    }

    /**
     * Sort
     * 
     * Sort values
     *
     * @return void
     */
    public function sort(): void {
        $this->collection = sort($this->collection);
        $this->sortKeys();    
    }

    /**
     * Rewind function
     * 
     * Iterator Interface
     *
     * @return void
     */
    public function rewind() {
        $this->position = 0;
        sort($this->collection);
    }

    /**
     * validate function
     * 
     * Iterator Interface
     *
     * @return void
     */
    public function valid(){
        return isset($this->collection[$this->position]);
    }

    /**
     * current function
     * 
     * Iterator Interface
     *
     * @return mixed
     */
    public function current() {
        return $this->collection[$this->position];
    }

    /**
     * key function
     * 
     * Iterator Interface
     *
     * @return void
     */
    public function key(): int {
        return $this->position;        
    }

    /**
     * next function
     * 
     * Iterator Interface
     *
     * @return void
     */
    public function next() {
        ++$this->position;
    }

    public function toArray(){
        return $this->collection;
    }

}
