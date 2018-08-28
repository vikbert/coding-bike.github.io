<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod;

class FileLogFactory extends LogFactory
{
    public function createLog(): Log
    {
        return new FileLog();
    }
}