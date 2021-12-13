<?php

namespace App\Services\User;


use App\Repositories\Contracts\IUserRepository;
use App\Services\Contracts\ImLearnService;
use App\Services\Contracts\IUserRoleService;
use App\Services\Contracts\IUserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserService implements IUserService
{
    protected $userRepository;
    protected $userRoleService;
    protected $mLearnService;

    public function __construct(
        IUserRepository $userRepository,
        IUserRoleService $userRoleService,
        ImLearnService $mLearnService
    )
    {
        $this->userRepository = $userRepository;
        $this->userRoleService = $userRoleService;
        $this->mLearnService = $mLearnService;
    }

    public function registerUser(string $msisdn, string $name, string $password, string $access_level = 'pro'){
        $validator = Validator::make(
            ['msisdn' => $msisdn],
            [
                'msisdn' => 'required|phone|unique:users,msisdn',
            ],
        );

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        $user = $this->userRepository->createNewUser($msisdn, $name, $password, $access_level);
        $this->mLearnService->registerUserWithMLearn($user->id, $msisdn, $name, $password, $access_level);
        $this->userRoleService->createUserRole($user->id, 2, $user->id);

        if (!$token = auth()->attempt(['msisdn' => $msisdn, 'password' => $password])){
            throw new \InvalidArgumentException('Unauthorized user, invalid data!');
        }
        $token = $this->createNewToken($token);
        return response()->json([
            'token' => $token,
            'status' => 'success',
            'message' => 'User created',
        ], 201);
    }

    public function loginUser(string $msisdn, string $password){

        if ($token = auth()->attempt(['msisdn' => $msisdn, 'password' => $password])) {

            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
            ]);
        } else {
            throw new \InvalidArgumentException('Unauthorized user!');
        }
    }

    private function createNewToken(string $token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    public function findUser(string $id){
        return $this->userRepository->findUser($id);
    }

    public function showAllUsers(){
        return $this->userRepository->showAllUsers();
    }

    public function upgradeUser(string $userId){
        $userMLearn = $this->mLearnService->updateAccessLevelUserWithMLearn($userId);
        return  $this->userRepository->updateAccessLevelUser($userId, $userMLearn->data["access_level"]);
    }

    public function downgradeUser(string $userId){
        $userMLearn = $this->mLearnService->downgradeAccessLevelUserWithMLearn($userId);
        return  $this->userRepository->updateAccessLevelUser($userId, $userMLearn->data["access_level"]);
    }


}
