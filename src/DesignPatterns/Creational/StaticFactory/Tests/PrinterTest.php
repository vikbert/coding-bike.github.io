<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\StaticFactory\Tests;

use DesignPatterns\Creational\StaticFactory\ClassicLetter;
use DesignPatterns\Creational\StaticFactory\ClassicResume;
use DesignPatterns\Creational\StaticFactory\ModernLetter;
use DesignPatterns\Creational\StaticFactory\ModernResume;
use DesignPatterns\Creational\StaticFactory\Printer;
use PHPUnit\Framework\TestCase;

class PrinterTest extends TestCase
{
    public function testPrintDocument()
    {
        $printer = new Printer();
        $this->assertInstanceOf(ClassicLetter::class, $printer->printClassicLetter());
        $this->assertInstanceOf(ClassicResume::class, $printer->printClassicResume());

        $this->assertInstanceOf(ModernLetter::class, $printer->printModernLetter());
        $this->assertInstanceOf(ModernResume::class, $printer->printModernResume());
    }
}
