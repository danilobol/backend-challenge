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
    public function findUser(string $id){
        return User::find($id);
    }

    public function showAllUsers(){
        return User::all();
    }

    public function updateAccessLevelUser(string $userId, string $access_level){
        $user = $this->findUser($userId);
        $user?->update([
            'access_level' => $access_level
        ]);
        return $user;
    }
}
