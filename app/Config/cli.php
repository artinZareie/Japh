<?php

/**
 * Notice: Don't touch comments!!!
 */

return [
    "commands" => [
        /**
         * Commands Comes Here
         */

		"create:kernel" => \App\Fireline\Cli\Commands\KernelCommand::class,
        "create:command" => \App\Firelines\Cli\Commands\CreateCommand::class,
    ]
];
