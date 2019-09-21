<?php

namespace App\Core;

interface IKernel
{
    public function call(): void;
    public function render(): void;
}
