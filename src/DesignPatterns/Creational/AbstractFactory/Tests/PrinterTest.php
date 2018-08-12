<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\AbstractFactory\Tests;

use DesignPatterns\Creational\AbstractFactory\ClassicLetter;
use DesignPatterns\Creational\AbstractFactory\ClassicResume;
use DesignPatterns\Creational\AbstractFactory\Factory\ClassicDocumentFactory;
use DesignPatterns\Creational\AbstractFactory\Factory\ModernDocumentFactory;
use DesignPatterns\Creational\AbstractFactory\ModernLetter;
use DesignPatterns\Creational\AbstractFactory\ModernResume;
use DesignPatterns\Creational\AbstractFactory\Printer;
use PHPUnit\Framework\TestCase;

class PrinterTest extends TestCase
{
    public function testPrintDocument()
    {
        $printer = new Printer(new ClassicDocumentFactory());
        $this->assertInstanceOf(ClassicLetter::class, $printer->printLetter());
        $this->assertInstanceOf(ClassicResume::class, $printer->printResume());

        $printer = new Printer(new ModernDocumentFactory());
        $this->assertInstanceOf(ModernLetter::class, $printer->printLetter());
        $this->assertInstanceOf(ModernResume::class, $printer->printResume());
    }
}
