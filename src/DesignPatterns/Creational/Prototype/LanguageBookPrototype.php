<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Prototype;

class LanguageBookPrototype extends BookPrototype
{
    protected $category = 'language';

    public function __clone()
    {
    }
}