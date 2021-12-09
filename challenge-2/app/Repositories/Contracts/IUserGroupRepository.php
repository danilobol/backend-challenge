<?php

namespace App\Repositories\Contracts;

interface IUserGroupRepository {
    public function addUserToGroup(string $userId, string $groupId);
    public function removeUserToGroup(string $userId, string $groupId):void;
    public function getGroupsOfUser(string $userId);
    public function checkIfExistUserInGroup(string $userId, string $groupId);
}
