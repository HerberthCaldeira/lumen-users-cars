<?php

namespace App\Domains\Car\Services;

use App\Domains\Car\Repositorys\CarRepository;

class CarService
{
    public function create(Array $car){
        return app(CarRepository::class)->create($car);
    }

    public function getCar(string $carId){
        return app(CarRepository::class)->getCar($carId);
    }

    public function getCars(){
        return app(CarRepository::class)->getCars();
    }
    public function edit(array $data, string $carId){
        return app(CarRepository::class)->edit($data, $carId);
    }
    public function delete(string $carId){
        return app(CarRepository::class)->delete($carId);
    }



}
