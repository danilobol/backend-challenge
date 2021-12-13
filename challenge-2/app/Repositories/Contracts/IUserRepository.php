<?php

namespace App\Repositories\Contracts;

interface IUserRepository {
    public function createNewUser(string $msisdn, string $name, string $password, string $access_level = 'free');
    public function findUser(string $id);
    public function updateAccessLevelUser(string $userId, string $access_level);
    public function showAllUsers();
}
