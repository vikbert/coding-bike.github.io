<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\AbstractFactory\Factory;

use DesignPatterns\Creational\AbstractFactory\Document;
use DesignPatterns\Creational\AbstractFactory\LetterDocument;
use DesignPatterns\Creational\AbstractFactory\ModernLetter;
use DesignPatterns\Creational\AbstractFactory\ModernResume;

final class ModernDocumentFactory extends DocumentFactory
{
    public function createLetterDocument(): Document
    {
        return new ModernLetter('Modern Letter');
    }

    public function createResumeDocument(): Document
    {
        return new ModernResume('Modern Resume');
    }
}