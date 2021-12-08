<?php

namespace App\Repositories\Contracts;

interface IUserRepository {
    public function createNewUser(string $msisdn, string $name, string $password);
    public function findUser(int $id);
}
