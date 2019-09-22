<?php

namespace App\Firelines\Cli\Commands;

use App\Core\CommandLine;
use App\Firelines\Cli\ICommand;

class CreateConfigCommand implements ICommand
{
	
	public function run(array $args): string
	{
		return 'Hello create:config!';
	}
}

