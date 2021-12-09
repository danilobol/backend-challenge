<?php

namespace App\Repositories\Contracts;

interface IGroupRepository {
    public function createUserGroup(string $userId, string $groupTitle, ?string $description);
    public function getGroup(string $groupId);
}
