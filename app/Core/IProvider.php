<?php

namespace App\Core;

interface IProvider 
{
    public function boot();
    public function run();
}