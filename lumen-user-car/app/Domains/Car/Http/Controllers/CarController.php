<?php

namespace App\Domains\Car\Http\Controllers;

use App\Domains\Car\Http\Resources\CarResource;
use App\Domains\Car\Services\CarService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Car\Rules\CarValidationRules;

class CarController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request){

        $this->validate($request, app(CarValidationRules::class)->create() );

        $newCar = app(CarService::class)->create($request->post());

        return response()->json([
            'data' => new CarResource($newCar),
        ], 201);
    }

    /**
     * @param Request $request
     * @param string $carId
     * @return \Illuminate\Http\JsonResponse
     */
    public function car(Request $request, string $carId){
        return response()->json([
            'data' => new CarResource(app(CarService::class)->getCar($carId))
        ], 201);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cars(Request $request){
        $cars = app(CarService::class)->getCars();

        return response()->json([
            'data' => collect($cars)->map( function ($car) {
                return new CarResource($car);
            })
        ], 201);
    }

    /**
     * @param Request $request
     * @param string $carId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(Request $request, string $carId) {

        $this->validate($request, app(CarValidationRules::class)->create() );
        app(CarService::class)->edit($request->all(), $carId);
        return response()->json([
            'data' => [
                'status' => 'success'
            ]
        ], 201);
    }

    /**
     * @param Request $request
     * @param string $carId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, string $carId) {

        $deletedCar = app(CarService::class)->delete($carId);
        return response()->json([
            'data' => [
                'status' => 'success'
            ]
        ], 201);
    }

}
