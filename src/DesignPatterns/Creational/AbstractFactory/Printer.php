<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\AbstractFactory;

use DesignPatterns\Creational\AbstractFactory\Factory\DocumentFactory;

final class Printer
{
    private $factory;

    public function __construct(DocumentFactory $factory)
    {
        $this->factory = $factory;
    }

    public function printLetter(): Document
    {
        return $this->factory->createLetterDocument();
    }

    public function printResume(): Document
    {
        return $this->factory->createResumeDocument();
    }
}