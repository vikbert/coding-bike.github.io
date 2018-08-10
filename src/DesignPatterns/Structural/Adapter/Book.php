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

    public function turnPage()
    {
        $this->currentPage++;
    }

    public function open()
    {
        $this->currentPage = 1;
    }

    public function getPage(): int
    {
        return $this->currentPage;
    }
}