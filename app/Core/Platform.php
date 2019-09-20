<?php

namespace App\Core;

class Platform
{
    public static function isCli()
    {
        return php_sapi_name() == "cli";
    }
}
