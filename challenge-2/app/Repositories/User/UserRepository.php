<?php

namespace App\Repositories\User;


use App\Models\User;
use App\Repositories\Contracts\IUserRepository;

/**
 * Class UserRepository.
 */
class UserRepository implements IUserRepository
{
    public function createNewUser(string $msisdn, string $name, string $password, string $access_level = 'free'){
        return User::create([
            'msisdn'     => $msisdn,
            'name'     => $name,
            'access_level'     => $access_level,
            'password'  => bcrypt($password)
        ]);
    }
    public function findUser(int $id){
        return User::find($id);
    }
}
