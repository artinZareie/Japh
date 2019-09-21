<?php

namespace App\Firelines\Cli;

use App\Core\IRenderable;
use App\Firelines\CliRenderable;
use Exception;

class CommandMap
{
    public function runCommand($command_target, $args): CliRenderable
    {
        foreach (config("commands", "cli") as $command => $controller) {
            if ($command_target == $command) {
                dd((new \DI\Container())->get($controller));
                $controller = inject($controller);
                dd($controller);
                return new CliRenderable($controller->run($args));
            }
        }
        return new CliRenderable("Command ${command_target} doesn't exists!");
    }
}
