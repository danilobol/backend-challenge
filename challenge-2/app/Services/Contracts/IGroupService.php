<?php

namespace App\Services\Contracts;

interface IGroupService {
    public function createUserGroup(string $userId, string $groupTitle, ?string $description);
    public function deleteUserGroup(string $userId, int $groupId);
}
