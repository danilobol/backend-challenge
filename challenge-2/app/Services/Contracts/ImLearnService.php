<?php

namespace App\Services\Contracts;

interface ImLearnService {
    public function registerUserWithMLearn(
        string $userId,
        string $msisdn,
        string $name,
        string $password,
        string $access_level = 'pro'
    );
    public function findUserWithMLearn(
        string $userId,
        string $msisdn
    );
    public function editUserWithMLearn(
        string $userId,
        string $msisdn,
        string $name,
        string $password,
        string $access_level = 'free'
    );
    public function updateAccessLevelUserWithMLearn(
        string $userId
    );
    public function downgradeAccessLevelUserWithMLearn(
        string $userId
    );
    public function deleteUserWithMLearn(
        string $userId
    );
    public function addUserToGroupWithMLearn(
        string $userId,
        string $groupId,
        string $groupTitle
    );
    public function getUserGroupWithMLearn(
        string $userId
    );
    public function deleteUserGroupWithMLearn(
        string $userId,
        string $groupId
    );
}
