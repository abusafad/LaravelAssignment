<?php

namespace App\Services;

interface UserServiceInterface
{
    /**
     * Hash the given password.
     *
     * @param  string  $password
     * @return string
     */
    public function hash(string $password): string;
}