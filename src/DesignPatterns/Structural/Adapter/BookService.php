<?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

class BookService
{
    private $book;

    public function __construct(BookInterface $book)
    {
        $this->book = $book;
    }

    public function read(int $pageNumber): bool
    {
        $this->book->open();
        while ($this->book->getPage() < $pageNumber) {
            $this->book->turnPage();
        }

        echo '... read the page ' . $this->book->getPage() . "\n";
        return true;
    }
}
