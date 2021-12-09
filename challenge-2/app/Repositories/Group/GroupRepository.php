<?php

namespace App\Repositories\Group;


use App\Models\Group;
use App\Repositories\Contracts\IGroupRepository;

/**
 * Class UserRepository.
 */
class GroupRepository implements IGroupRepository
{
    public function createUserGroup(string $userId, string $groupTitle, ?string $description){
        return Group::create([
            'owner_id'      => $userId,
            'title'         => $groupTitle,
            'description'   => $description
        ]);
    }

    public function getGroup(int $groupId){
        return Group::query()->where('id','=', $groupId)->first();
    }

    public function getOwnerUserGroups(string $userId): \Illuminate\Database\Eloquent\Collection|array
    {
        return Group::query()->where('owner_id', '=', $userId)->get();
    }
}
