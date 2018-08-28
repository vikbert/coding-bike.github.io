<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod;

class StreamLog extends Log
{
    public function writeLog(): void
    {
        echo 'stream logs';
    }
}