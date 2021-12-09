<?php

namespace App\Services\mLearn;


use App\Services\Contracts\ImLearnService;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class mLearnService implements ImLearnService
{
    private $serviceId = 'qualifica';
    protected $clientUrl;
    protected $clientToken;

    public function __construct()
    {
        $this->clientUrl = new Client(['base_uri' => config('projects_routes.projects.mLearn_url')]);
        $this->clientToken = config('projects_routes.projects.mLearn_token');

    }

    public function registerUserWithMLearn(string $msisdn, string $name, string $password, string $access_level = 'free'){
        $response = $this->clientUrl->post('/integrator/'.$this->serviceId.'/users', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->clientToken,
                'Content-Type' => 'application/json',
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function findUserWithMLearn(string $userId, string $msisdn){
        $response = $this->clientUrl->get('/integrator/'.$this->serviceId.'/users', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->clientToken,
                'form_params' => [
                    'external_id'       => $userId,
                    'msisdn'            => $msisdn,
                ],
                'Content-Type' => 'application/json',
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function editUserWithMLearn(string $userId, string $msisdn, string $name, string $password, string $access_level = 'free'){
        $response = $this->clientUrl->put('/integrator/'.$this->serviceId.'/users/'.$userId, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->clientToken,
                'body' => [
                    'msisdn'            => $msisdn,
                    'name'              => $name,
                    'access_level'      => $access_level,
                    'password'          => $password,
                ],
                'Content-Type' => 'application/json',
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function updateAccessLevelUserWithMLearn(string $userId){
        $response = $this->clientUrl->put('/integrator/'.$this->serviceId.'/users/'.$userId.'/upgrade', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->clientToken,
                'Content-Type' => 'application/json',
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function downgradeAccessLevelUserWithMLearn(string $userId){
        $response = $this->clientUrl->put('/integrator/'.$this->serviceId.'/users/'.$userId.'/downgrade', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->clientToken,
                'Content-Type' => 'application/json',
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function deleteUserWithMLearn(string $userId){
        $response = $this->clientUrl->delete('/integrator/'.$this->serviceId.'/users/'.$userId, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->clientToken,
                'Content-Type' => 'application/json',
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function addUserToGroupWithMLearn(string $userId, string $groupId, string $groupTitle){
        $response = $this->clientUrl->post('/users/'.$userId.'/groups', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->clientToken,
                'body' => [
                    'group_id'              => $groupId,
                    'title'                 => $groupTitle
                ],
                'Content-Type' => 'application/json',
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function getUserGroupWithMLearn(string $userId){
        $response = $this->clientUrl->get('/users/'.$userId.'/groups', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->clientToken,
                'Content-Type' => 'application/json',
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }

    public function deleteUserGroupWithMLearn(string $userId, string $groupId){
        $response = $this->clientUrl->delete('/users/'.$userId.'/groups/'.$groupId, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->clientToken,
                'Content-Type' => 'application/json',
            ]
        ]);

        return json_decode($response->getBody()->getContents());
    }
}