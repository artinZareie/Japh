<?php

namespace App\Core;

interface IKernel
{
    public function call();
    public function result();
}
