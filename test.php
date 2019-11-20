<?php

/**
 * Dump Die
 * 
 * Var_dump given parameters and then execute die().
 *
 * @param mixed ...$vars
 * @return void
 */
function dd(...$vars): void
{
        foreach ($vars as $item) {
            var_dump($item);
        }
        die();
}

$array = [
    function() {}
];