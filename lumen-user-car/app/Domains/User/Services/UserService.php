<?php

namespace App\Domains\User\Services;

use App\Domains\User\Repositorys\UserRepository;
use App\Models\User;
class UserService
{
    public function create(Array $user){
        return app(UserRepository::class)->create($user);
    }

    public function getUser(string $userId){
        return app(UserRepository::class)->getUser($userId);
    }

    public function getUsers(){
        return app(UserRepository::class)->getUsers();
    }

    public function edit(array $data, string $userId){
        return app(UserRepository::class)->edit($data, $userId);
    }

    public function attachCar(string $userId, string $carId){
        return app(UserRepository::class)->attachCar($userId, $carId);
    }

    public function detachCar(string $userId, string $carId){
        return app(UserRepository::class)->detachCar($userId, $carId);
    }

    public function delete(string $userId){
        return app(UserRepository::class)->delete($userId);
    }


}
