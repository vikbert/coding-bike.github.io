<?php

declare(strict_types = 1);

namespace DesignPatterns\Structural\Adapter;

/**
 * @author Xun Zhou <xun.zhou@lidl.com>
 */
interface BookInterface
{
    public function turnPage();

    public function open();

    public function getPage(): int;
}