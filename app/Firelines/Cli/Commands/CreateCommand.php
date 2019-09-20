<?php

namespace App\Firelines\Cli;
use App\Core\IRenderable;

class CreateCommand implements ICommand
{
    public function run(array $args): IRenderable
    {
        $map = inject(CommandMap::class);
        return $map->runCommand();
    }
}
