<?php

namespace App\Core;

interface IProvider 
{
    /**
     * Boot function
     * 
     * Boot will be called after all dependencies prepared.
     *
     * @return void
     */
    public function boot(): void;

    /**
     * Notice: You can define a method called "run" that takes no parameters.
     * And is public. "run" method if exists will runs after calling kernel.
     * 
     * Defination:
     * 
     * public function run(): void;
     */
}