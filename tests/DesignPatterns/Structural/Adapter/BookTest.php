<?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

use PHPUnit\Framework\TestCase;

class BookTest extends TestCase
{
    /** @var Book */
    private $book;

    public function setUp()
    {
        $this->book = new Book(245);
    }

    /**
     * @expectedException \Exception
     */
    public function testPageNumberExceed()
    {
        $this->book->turnPageTo(300);
    }

    /**
     * @expectedException \Exception
     */
    public function testCanNotTurnPageAnyMore()
    {
        $this->book->turnPageTo(245);
        $this->book->turnPage();
    }

    public function testBook()
    {
        $this->assertEquals(0, $this->book->getPage());

        $this->book->open();
        $this->assertEquals(1, $this->book->getPage());

        $this->book->turnPage();
        $this->assertEquals(2, $this->book->getPage());

        $this->book->turnPageTo(100);
        $this->assertEquals(100, $this->book->getPage());
    }

}
