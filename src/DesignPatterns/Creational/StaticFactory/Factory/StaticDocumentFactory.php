<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\StaticFactory\Factory;

use DesignPatterns\Creational\StaticFactory\ClassicLetter;
use DesignPatterns\Creational\StaticFactory\ClassicResume;
use DesignPatterns\Creational\StaticFactory\Document;
use DesignPatterns\Creational\StaticFactory\ModernLetter;
use DesignPatterns\Creational\StaticFactory\ModernResume;

final class StaticDocumentFactory
{
    public static function build(string $documentType): Document
    {
        switch ($documentType) {
            case 'classic_letter':
                return new ClassicLetter('classic Letter');
            case 'classic_resume':
                return new ClassicResume('classic Resume');
            case 'modern_letter':
                return new ModernLetter('modern Letter');
            case 'modern_resume':
                return new ModernResume('modern Resume');
            default:
                throw new \Exception('Unknow document type!');
        }
    }
}