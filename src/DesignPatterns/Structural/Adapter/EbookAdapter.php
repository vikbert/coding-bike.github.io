<?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

class EbookAdapter implements BookInterface
{
    private $ebook;

    public function __construct(EbookInterface $ebook)
    {
        $this->ebook = $ebook;
    }

    public function open()
    {
        $this->ebook->unlock();
    }

    public function turnPage()
    {
        $this->ebook->pressNext();
    }

    public function getPage(): int
    {
        return $this->ebook->getViewNumber();
    }
}
