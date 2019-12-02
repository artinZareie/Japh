<?php

namespace App\Core;

/**
 * Reads and compiles twig files
 */
class ViewLoader
{
    /**
     * Twig file loader
     *
     * @var FilesystemLoader
     */
    protected $loader;

    public function __construct(string $path)
    {
        $this->loader = new FilesystemLoader($path);
    }
}
