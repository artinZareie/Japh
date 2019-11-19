<?php

/**
 * Notice: Don't touch comments!!!
 */

return [
    "commands" => [
        /**
         * Commands Comes Here
         */
        
		"create:config" => \App\Firelines\Cli\Commands\CreateConfigCommand::class,
        "create:command" => \App\Firelines\Cli\Commands\CreateCommand::class,
    ]
];
