<?php

declare(strict_types = 1);

namespace DesignPatterns\Creational\Singleton;

final class Locker
{
    /** @var Locker */
    private static $instance;

    /** @var bool */
    private $isLocked = false;

    public static function getInstance(): Locker
    {
        if (null === static::$instance) {
            static::$instance = new Static();
        }

        return self::$instance;
    }

    public function lock()
    {
        $this->isLocked = true;
    }

    public function unlock()
    {
        $this->isLocked = false;
    }

    public function isLocked(): bool
    {
        return $this->isLocked;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}