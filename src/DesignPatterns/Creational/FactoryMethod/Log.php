<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod;

abstract class Log
{
    abstract public function writeLog(): void;
}