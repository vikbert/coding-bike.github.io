<?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

use PHPUnit\Framework\TestCase;

class BookServiceTest extends TestCase
{
    public function testReadBook()
    {
        $service = new BookService(new Book(200));

        echo "Open Book: \n";
        $this->assertTrue($service->read(10));
    }

    public function testReadEbook()
    {
        $ebook = new Ebook(100);

        echo "Open E-Book: \n";
        $service = new BookService(new EbookAdapter($ebook));
        $this->assertTrue($service->read(10));
    }
}
