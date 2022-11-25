<?php

namespace App\Domains\Car\Repositorys;

use App\Models\Car;

class CarRepository
{
    public function create(Array $car){
        return Car::create($car);
    }

    public function getCars(){
        return Car::with('users')->get();
    }

    public function getCar(string $carId){
        return Car::with('users')->findOrFail($carId);
    }

    public function edit(array $data, string $carId){
        $car = Car::find($carId);
        $car->model = $data['model'];
        return $car->save();
    }
    public function delete(string $carId){
        $car = Car::findOrFail($carId);
        return $car->delete();
    }

}
