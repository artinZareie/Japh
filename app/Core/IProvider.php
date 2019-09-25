<?php

namespace App\Core;

interface IProvider 
{
    public function boot(): void;
    public function run(): void;
}