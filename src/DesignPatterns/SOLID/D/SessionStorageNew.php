<?php

declare(strict_types = 1);

namespace DesignPatterns\SOLID\D;

class SessionStorageNew implements StorageInterface
{
    /** @var User[] */
    private $users = [];

    public function isAuthenticated(User $user)
    {
        return array_key_exists(spl_object_hash($user), $this->users);
    }
}