<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod;

class FileLog extends Log
{
    public function __construct()
    {
    }

    public function writeLog(): void
    {
        echo 'file logs';
    }
}