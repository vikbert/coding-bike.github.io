<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Prototype\Tests;

use DesignPatterns\Creational\Prototype\LanguageBookPrototype;
use PHPUnit\Framework\TestCase;

class PrototypeTest extends TestCase
{
    public function testCanGetLanguageBook()
    {
        $languageBook = new LanguageBookPrototype();

        $languageBook1 = clone $languageBook;
        $languageBook1->setTitle('language book band 1');
        $this->assertInstanceOf(LanguageBookPrototype::class, $languageBook1);

        $languageBook2 = clone $languageBook;
        $languageBook2->setTitle('language book band 2');
        $this->assertInstanceOf(LanguageBookPrototype::class, $languageBook2);
    }
}
