<?php

namespace Database\Seeders;


use App\Repositories\Contracts\IUserRepository;
use App\Services\Contracts\IMerchantService;
use App\Services\Contracts\IProfileService;
use App\Services\Contracts\IUserRoleService;
use Illuminate\Database\Seeder;

class UserAdminTableSeeder extends Seeder
{
    protected $userRepository;
    protected $userRoleService;

    public function __construct(
        IUserRepository $userRepository,
        IUserRoleService $userRoleService,
    ){
        $this->userRepository = $userRepository;
        $this->userRoleService = $userRoleService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userAdmin = $this->userRepository->createNewUser(
            'admin',
            'admin',
            'admin'
        );

        $this->userRoleService->createUserRole($userAdmin->id, 1, $userAdmin->id);
        $this->userRoleService->createUserRole($userAdmin->id, 2, $userAdmin->id);
    }
}
