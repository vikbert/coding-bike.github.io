<?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

class Book implements BookInterface
{
    private $amountPages;
    private $currentPage;

    public function __construct(int $amountPages)
    {
        $this->amountPages = $amountPages;
    }

    public function open()
    {
        $this->currentPage = 1;
    }

    public function turnPage()
    {
        if ($this->currentPage === $this->amountPages) {
            throw new \Exception('Failed: already the last page!');
        }

        ++$this->currentPage;
    }

    public function getPage(): int
    {
        return $this->currentPage;
    }
}
