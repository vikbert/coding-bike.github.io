<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\StaticFactory;

abstract class Document
{
    protected $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}