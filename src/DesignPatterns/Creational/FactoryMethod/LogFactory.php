<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod;

abstract class LogFactory
{
    abstract public function createLog(): Log;
}