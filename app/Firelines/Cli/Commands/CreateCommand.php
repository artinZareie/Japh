<?php

namespace App\Firelines\Cli\Commands;

use App\Core\CommandLine;
use App\Firelines\Cli\ICommand;

class CreateCommand implements ICommand
{

    public function run(array $args): string
    {
        CommandLine::ptint("STARTING..." . PHP_EOL);
        for ($i = 0; $i < 10; $i++) {
            CommandLine::ptint($i . PHP_EOL);
            sleep(1);
        }
        return "";
    }
}
