<?php

namespace App\Bootstrap;

class HttpBootstrap
{
    public static function start_sessions(){
        session_start();
    }
}
