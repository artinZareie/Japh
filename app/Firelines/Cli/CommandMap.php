<?php

namespace App\Firelines\Cli;

use App\Core\CommandLine;
use App\Core\TerminalColors;
use App\Firelines\CliRenderable;

/**
 * Command Map
 * 
 * Searchs if command is defined in cli file pass the args to controller and execute the run method on controller
 * and if the command is not defined, then returns error message.
 */
class CommandMap
{
    /**
     * runCommand
     * 
     * searchs for command and execute it!
     *
     * @param string $command_target
     * @param array $args
     * @return CliRenderable
     */
    public function runCommand(string $command_target, array $args): CliRenderable
    {
        foreach (config("commands", "cli") as $command => $controller) {
            if ($command_target == $command) {
                $controller = inject($controller);
                return new CliRenderable($controller->run($args));
            }
        }
        return new CliRenderable(CommandLine::coloredString("Command ${command_target} doesn't exists!", TerminalColors::FRed));
    }
}
