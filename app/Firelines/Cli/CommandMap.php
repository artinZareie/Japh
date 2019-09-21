<?php

namespace App\Firelines\Cli;

use App\Firelines\CliRenderable;

class CommandMap
{
    public function runCommand($command_target, $args): CliRenderable
    {
        foreach (config("commands", "cli") as $command => $controller) {
            if ($command_target == $command) {
                $controller = inject($controller);
                return new CliRenderable($controller->run($args));
            }
        }
        return new CliRenderable("Command ${command_target} doesn't exists!");
    }
}
