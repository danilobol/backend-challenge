<?php

namespace App\Services\Contracts;

interface IUserService {
    public function registerUser(string $msisdn, string $name, string $password, string $access_level = 'pro');
    public function loginUser(string $msisdn, string $password);
    public function findUser(int $id);
}
