<?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

/**
 * @author Xun Zhou <xun.zhou@lidl.com>
 */
class Book implements BookInterface
{
    private $amountPages;
    private $currentPage;

    public function __construct(int $amountPages, int $currentPage = 0)
    {
        $this->amountPages = $amountPages;
        $this->currentPage = $currentPage;
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

    public function turnPageTo(int $pageNumber)
    {
        if ($pageNumber > $this->amountPages) {
            throw new \Exception(sprintf('Failed: the book has only %d pages!', $pageNumber));
        }

        $this->currentPage = $pageNumber;
    }

    public function getPage(): int
    {
        return $this->currentPage;
    }
}
