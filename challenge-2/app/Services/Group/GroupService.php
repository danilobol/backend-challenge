<?php

namespace App\Services\Group;


use App\Models\Group;
use App\Repositories\Contracts\IGroupRepository;
use App\Services\Contracts\IGroupService;
use App\Services\Contracts\ImLearnService;

/**
 * Class UserRepository.
 */
class GroupService implements IGroupService
{
    protected $groupRepository;
    protected $mLearnService;

    public function __construct(
        IGroupRepository $groupRepository,
        ImLearnService $mLearnService
    )
    {
        $this->groupRepository = $groupRepository;
        $this->mLearnService = $mLearnService;
    }

    public function createUserGroup(string $userId, string $groupTitle, ?string $description){
        $group = $this->groupRepository->createUserGroup($userId, $groupTitle, $description);
        $this->mLearnService->addUserToGroupWithMLearn($userId, $group->id, $groupTitle);
        return $group;
    }

    public function getGroup(string $groupId){
        return $this->groupRepository->getGroup($groupId);
    }

    public function getOwnerUserGroups(string $userId): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->groupRepository->getOwnerUserGroups($userId);
    }
}
