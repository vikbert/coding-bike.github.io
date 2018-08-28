<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\FactoryMethod\Tests;

use DesignPatterns\Creational\FactoryMethod\FileLogFactory;
use DesignPatterns\Creational\FactoryMethod\StreamLogFactory;
use PHPUnit\Framework\TestCase;

class FactoryMethodTest extends TestCase
{
    public function testWriteFileLogs()
    {
        $fileLogFactory = new FileLogFactory();
        $fileLog = $fileLogFactory->createLog();
        $fileLog->writeLog();

        $this->expectOutputString('file logs');
    }

    public function testWriteStreamLogs()
    {
        $streamLogFactory = new StreamLogFactory();
        $streamLog = $streamLogFactory->createLog();
        $streamLog->writeLog();

        $this->expectOutputString('stream logs');
    }
}
