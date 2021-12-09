<?php

namespace App\Services\Contracts;

interface IGroupService {
    public function createUserGroup(string $userId, string $groupTitle, ?string $description);
    public function getGroup(string $groupId);
    public function getOwnerUserGroups(string $userId): \Illuminate\Database\Eloquent\Collection|array;
}
