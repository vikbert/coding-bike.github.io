<?php

declare(strict_types = 1);

namespace DesignPatterns\SOLID\D;

interface StorageInterface
{
    public function isAuthenticated(User $user);
}