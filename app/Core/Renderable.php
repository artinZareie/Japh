<?php

namespace App\Core;

class Renderable implements IRenderable
{
    public function __toStirng(): string {
        return '';
    }
}
