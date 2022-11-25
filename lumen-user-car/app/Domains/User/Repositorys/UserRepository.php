<?php

namespace App\Domains\User\Repositorys;

use App\Models\Car;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserRepository
{
    public function create(Array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function getUser(string $userId){
        return User::with('cars')->findOrFail($userId);
    }
    public function getUsers(){
        return User::with('cars')->get();
    }

    public function edit(array $data, string $userId){
        $user = User::find($userId);
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        return $user->save();
    }

    public function attachCar(string $userId, string $carId){
        $user = User::findOrFail($userId);
        $car = Car::findOrFail($carId);
        return $user->cars()->attach($car);
    }

    public function detachCar(string $userId, string $carId){
        $user = User::findOrFail($userId);
        $car = Car::findOrFail($carId);
        return $user->cars()->detach($car);
    }

    public function delete(string $userId){
        $user = User::findOrFail($userId);
        return $user->delete();
    }



}
