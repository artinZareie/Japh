<?php

namespace App\Firelines\Cli\Commands;

use App\Core\CommandLine;
use App\Core\Storage;
use App\Core\TerminalColors;
use App\Firelines\Cli\ICommand;

class CreateConfigCommand implements ICommand
{
	
	public function run(array $args): string
	{
		if (count($args) == 1 && ($args[0] == "-h" || $args[0] == "--help")) {
			return CommandLine::coloredString("\tThe only input has to be file name (like app for app.php) to create the config file.", TerminalColors::FCyan);
		}
		elseif (count($args) != 1) {
			return CommandLine::coloredString("Use -h parameter to see how it works!");
		}
		$config = $args[0];
		$directory = dir_glue(config("app_root"), "Config", $config . '.php');
		Storage::write($directory, [
			"<?php",
			"",
			"return [",
			"\t// Write your variables here!",
			"];",
			""
		]);
		return CommandLine::coloredString("${config} has been created in ${directory}!", TerminalColors::FGreen);
	}
}
