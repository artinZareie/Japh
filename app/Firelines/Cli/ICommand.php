<?php

namespace App\Firelines\Cli;
use App\Core\IRenderable;

interface ICommand 
{
    public function run(array $args): string;
}