<?php

namespace App\Firelines\Cli\Commands;

use App\Core\CommandLine;
use App\Firelines\Cli\ICommand;

class TestCommand implements ICommand
{
	
	public function run(array $args): string
	{
		dd(CommandLine::readChar("Do you want to quit ? Y/n"));
		return 'Hello test!';
	}
}

