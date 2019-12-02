<?php

namespace App\Core\ViewCompiler;

/**
 * Interface for a compiler
 */
abstract class Compiler
{
    /**
     * Paths for compiling
     *
     * @var array
     */
    protected $paths = [];

    /**
     * Caches
     *
     * @var array
     */
    protected $cahcePath = "";
}
