<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Singleton;

use PHPUnit\Framework\TestCase;

class LockerTest extends TestCase
{
    public function testCreateOneJustOneInstance()
    {
        $locker1 = Locker::getInstance();
        $locker2 = Locker::getInstance();
        $this->assertTrue($locker1 === $locker2);
    }

    public function testLockStatus()
    {
        $locker1 = Locker::getInstance();
        $this->assertFalse($locker1->isLocked());

        $locker1->lock();
        $this->assertTrue($locker1->isLocked());

        $locker2 = Locker::getInstance();
        $this->assertTrue($locker2->isLocked());
    }
}
