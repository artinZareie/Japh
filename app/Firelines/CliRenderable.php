<?php

namespace App\Firelines;

class CliRenderable
{
    private $screen_buffer = "";

    public function __construct(string $data)
    {
        $this->screen_buffer = $data;
    }

    public function add(string $data): void
    {
        $this->screen_buffer .= $data;
    }

    public function clear(): void
    {
        $this->screen_buffer = "";
    }

    public function __toString(): string
    {
        return $this->screen_buffer;
    }
}
