<?php

namespace App\Repositories\Contracts;

interface IUserRepository {
    public function createNewUser(string $msisdn, string $name, string $password, string $access_level = 'free');
    public function findUser(int $id);
}
