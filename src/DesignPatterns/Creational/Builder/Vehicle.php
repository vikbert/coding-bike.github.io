<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Builder;

abstract class Vehicle
{
    /**
     * @var object[]
     */
    protected $parts = [];

    /**
     * @param string $key
     * @param object $part
     */
    public function setPart(string $key, $part)
    {
        $this->parts[$key] = $part;
    }
}