<?php

declare(strict_types = 1);

namespace DesignPatterns\SOLID\D;

class User
{
    private $email;
    private $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}