<?php

namespace App\Firelines\Cli;

use App\Firelines\CliRenderable;
use Exception;

class CommandMap
{
    public function runCommand($command_target, $args)
    {
        foreach (config("commands", "cli") as $command => $controller) {
            if (condition) {
                # code...
            }
        }
        return new CliRenderable("Command ${command_target} doesn't exists!");
    }
}
