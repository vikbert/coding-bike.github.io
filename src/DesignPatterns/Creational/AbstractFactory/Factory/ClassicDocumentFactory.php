<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\AbstractFactory\Factory;

use DesignPatterns\Creational\AbstractFactory\ClassicLetter;
use DesignPatterns\Creational\AbstractFactory\ClassicResume;
use DesignPatterns\Creational\AbstractFactory\Document;

final class ClassicDocumentFactory extends DocumentFactory
{
    public function createLetterDocument(): Document
    {
        return new ClassicLetter('classic Letter');
    }

    public function createResumeDocument(): Document
    {
        return new ClassicResume('classic resume');
    }
}