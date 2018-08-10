<?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

interface EbookInterface
{
    public function unlock();

    public function pressNext();

    public function getViewNumber(): int;
}
