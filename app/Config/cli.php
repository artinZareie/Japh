<?php

/**
 * Notice: Don't touch comments!!!
 */

return [
    "commands" => [
        /**
         * Commands Comes Here
         */

		"test" => \App\Firelines\Cli\Commands\TestCommand::class,
		"test" => \App\Firelines\Cli\Commands\TestCommand::class,
		"create:config" => \App\Firelines\Cli\Commands\CreateConfigCommand::class,
        "create:command" => \App\Firelines\Cli\Commands\CreateCommand::class,
    ]
];
