<?php

namespace App\Core;

interface ISingletone
{
    public static function getInstance(): ISingletone;
}