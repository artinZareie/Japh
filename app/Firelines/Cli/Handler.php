<?php

namespace App\Firelines\Cli;

use App\Core\CommandLine;
use App\Core\IFireline;
use App\Core\IRenderable;
use App\Firelines\CliRenderable;

class Handler implements IFireline
{
    public function fire(): IRenderable
    {
        if (count(CommandLine::parameters()) > 0) {
            $main_command = CommandLine::parameters()[0];
            $params = array_slice(CommandLine::parameters(), 1);
            $map = inject(CommandMap::class);
            return $map->runCommand($main_command, $params);
        }
        return new CliRenderable("No Action Selected");
    }
}
