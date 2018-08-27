<?php

declare(strict_types = 1);

namespace DesignPatterns\SOLID\D;

class UserServiceNew
{
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function isAuthenticated(User $user): bool
    {
        return $this->storage->isAuthenticated($user);
    }
}