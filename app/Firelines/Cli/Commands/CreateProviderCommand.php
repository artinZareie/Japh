<?php

namespace App\Firelines\Cli\Commands;

use App\Core\CommandLine;
use App\Core\Storage;
use App\Core\TerminalColors;
use App\Firelines\Cli\ICommand;

class CreateProviderCommand implements ICommand
{
	
	public function run(array $args): string
	{
		if (count($args) == 1 && ($args[0] == "-h" || $args[0] == "--help")) {
			return CommandLine::coloredString("\tThe only input is the name of provider. for example `php ./pumpkin create:provider CustomProvider`", TerminalColors::FCyan);
		} elseif (count($args) != 1) {
			return CommandLine::coloredString("Use -h parameter to see how it works!");
		}

		$provider_name = $args[0];
		$directory = \dir_glue(config("app_root"), 'Providers', $provider_name . '.php');
		Storage::write($directory, [
			"<?php",
			"",
			"namespace App\Providers;",
			"",
			"use App\Core\IProvider;",
			"",
			"class ${provider_name} implements IProvider",
			"{",
			"\tpublic function boot(): void",
			"\t{",
			"\t\t# Your codes comes here",
			"\t}",
			"}",
		]);

		return CommandLine::coloredString("\tYour provider has been created in ${directory}!", TerminalColors::FGreen);
	}
}

