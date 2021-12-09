<?php

namespace App\Services\Group;


use App\Models\Group;
use App\Repositories\Contracts\IGroupRepository;
use App\Services\Contracts\IGroupService;

/**
 * Class UserRepository.
 */
class GroupService implements IGroupService
{
    protected $groupRepository;
    public function __construct(IGroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function createUserGroup(string $userId, string $groupTitle, ?string $description){
        return $this->groupRepository->createUserGroup($userId, $groupTitle, $description);
    }

    public function getGroup(string $groupId){
        return $this->groupRepository->getGroup($groupId);
    }

    public function getOwnerUserGroups(string $userId): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->groupRepository->getOwnerUserGroups($userId);
    }
}
