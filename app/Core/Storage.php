<?php

namespace App\Core;

class Storage
{
    
    public static function delete(string $file)
    {
        if (file_exists($file)) {
            unlink($file);
        }
        else {
            return false;
        }
    }
}
