<?php

namespace App\Services\UserGroup;

use App\Models\UserGroup;
use App\Repositories\Contracts\IUserGroupRepository;
use App\Services\Contracts\IUserGroupService;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserRepository.
 */
class UserGroupService implements IUserGroupService
{

    protected $userGroupRepository;

    public function __construct(IUserGroupRepository $userGroupRepository)
    {
        $this->userGroupRepository = $userGroupRepository;
    }

    public function addUserToGroup(string $userId, string $groupId){
        $this->checkIfExistUserInGroup($userId, $groupId);
        return $this->userGroupRepository->addUserToGroup($userId, $groupId);
    }
    public function removeUserToGroup(string $userId, string $groupId):void{
        $this->userGroupRepository->removeUserToGroup($userId, $groupId);
    }
    public function getGroupsOfUser(string $userId): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->userGroupRepository->getGroupsOfUser($userId);
    }

    private function checkIfExistUserInGroup(string $userId, string $groupId){
        $group = $this->userGroupRepository->checkIfExistUserInGroup($userId, $groupId);
        if ($group)
            throw new \InvalidArgumentException('User already participates in this group!');
    }
}
