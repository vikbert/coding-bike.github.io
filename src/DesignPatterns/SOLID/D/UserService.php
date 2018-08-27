<?php

declare(strict_types = 1);

namespace DesignPatterns\SOLID\D;

class UserService
{
    private $sessionStorage;

    public function __construct(SessionStorage $storage)
    {
        $this->sessionStorage = $storage;
    }

    public function isAuthenticated(User $user): bool
    {
        return $this->sessionStorage->isAuthenticated($user);
    }
}