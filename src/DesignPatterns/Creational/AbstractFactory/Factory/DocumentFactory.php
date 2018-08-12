<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\AbstractFactory\Factory;

use DesignPatterns\Creational\AbstractFactory\Document;

abstract class DocumentFactory
{
    abstract public function createLetterDocument(): Document;

    abstract public function createResumeDocument(): Document;
}