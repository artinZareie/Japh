<?php

namespace App\Firelines\Cli\Commands;

use App\Core\CommandLine;
use App\Core\Storage;
use App\Firelines\Cli\ICommand;

class CreateCommand implements ICommand
{

    public function run(array $args): string
    {
        if (count($args) == 1 && ($args[0] == "-h" || $args[0] == "--help")) {
            return "You have to run this command like `php pumkin create:command mycommand MyCommand`";
        }
        elseif (count($args) != 2) {
            return "arguments has to be like 'command controller'. or call -h parameter.";
        }
        $command = $args[0];
        $controller = $args[1];
        $code = Storage::read(dir_glue(config("app_root"), 'Config', "cli.php"));
        $source = 0;
        foreach ($code as $key => $item) {
            if (preg_match('/\* Commands Comes Here/', $item)) {
                $source = $key + 3;                
            }
        }
        array_insert($code, $source, "\n\t\t\"${command}\" => \\App\\Fireline\\Cli\\Commands\\${controller}::class,");
        Storage::write(dir_glue(config("app_root"), 'Config', 'cli.php'), $code, "");
        Storage::write(dir_glue(config("app_root"), "Firelines", "Cli", "Commands", "${controller}.php"), [
            "<?php",
            "",
            "namespace App\Firelines\Cli\Commands;",
            "",
            "use App\Core\CommandLine;",
            "use App\Firelines\Cli\ICommand;",
            "",
            "class ${controller} implements ICommand",
            "{",
            "\t",
            "\tpublic function run(array \$args): string",
            "\t{",
            "\t\treturn 'Hello ${command}!';",
            "\t}",
            "}",
            ""
        ]);
        return "Command ${command} Has Been Created!";
    }
}
