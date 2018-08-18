<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Prototype;

class TravelBookPrototype extends BookPrototype
{
    protected $category = 'travel';

    public function __clone()
    {
    }
}