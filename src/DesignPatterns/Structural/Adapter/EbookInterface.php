<?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

/**
 * @author Xun Zhou <xun.zhou@lidl.com>
 */
interface EbookInterface
{
    public function unlock();

    public function pressNext();

    public function getViewNumber(): int;
}
