<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\StaticFactory;

use DesignPatterns\Creational\StaticFactory\Factory\StaticDocumentFactory;

final class Printer
{
    public function printClassicLetter(): Document
    {
        return StaticDocumentFactory::build('classic_letter');
    }

    public function printClassicResume(): Document
    {
        return StaticDocumentFactory::build('classic_resume');
    }

    public function printModernLetter(): Document
    {
        return StaticDocumentFactory::build('modern_letter');
    }

    public function printModernResume(): Document
    {
        return StaticDocumentFactory::build('modern_resume');
    }
}