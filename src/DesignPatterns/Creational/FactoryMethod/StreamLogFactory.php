<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod;

class StreamLogFactory extends LogFactory
{
    public function createLog(): Log
    {
        return new StreamLog();
    }
}