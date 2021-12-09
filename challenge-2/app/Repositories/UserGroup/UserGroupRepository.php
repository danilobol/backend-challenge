<?php

namespace App\Repositories\UserGroup;


use App\Models\Group;
use App\Models\User;
use App\Models\UserGroup;
use App\Repositories\Contracts\IUserGroupRepository;

/**
 * Class UserRepository.
 */
class UserGroupRepository implements IUserGroupRepository
{
    public function addUserToGroup(string $userId, string $groupId){
        return UserGroup::create([
            'user_id'       => $userId,
            'group_id'      => $groupId
        ]);
    }
    public function removeUserToGroup(string $userId, string $groupId):void{
        $userGroup = UserGroup::query()
            ->where('user_id','=', $userId)
            ->where('group_id','=', $groupId)->first();
        $userGroup?->delete();
    }
    public function getGroupsOfUser(string $userId): \Illuminate\Database\Eloquent\Collection|array
    {
        return UserGroup::query()->where('user_id', '=', $userId)
            ->with('groups')
            ->get();
    }

    public function checkIfExistUserInGroup(string $userId, string $groupId)
    {
        return UserGroup::query()
            ->where('user_id','=', $userId)
            ->where('group_id','=', $groupId)->first();
    }
}
