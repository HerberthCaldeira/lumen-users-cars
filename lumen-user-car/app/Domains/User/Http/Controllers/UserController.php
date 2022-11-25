<?php

namespace App\Domains\User\Http\Controllers;

use App\Domains\User\Http\Resources\UserResource;
use App\Domains\User\Services\UserService;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Domains\User\Http\Rules\UserValidationRules;
use App\Domains\Car\Rules\CarValidationRules;
use Illuminate\Support\Arr;


class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request){
        $this->validate($request, app(UserValidationRules::class)->create() );
        $newUser = app(UserService::class)->create($request->post());

        return response()->json([
            'data' => new UserResource($newUser),
        ], 201);
    }

    /**
     * @param Request $request
     * @param string $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request, string $userId){

        return response()->json([
            'data' => new UserResource(app(UserService::class)->getUser($userId))
        ], 201);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function users(Request $request){
        $users = app(UserService::class)->getUsers();
        return response()->json([
            'data' => collect($users)->map( function ($user) {
                return new UserResource($user);
            })
        ], 201);
    }

    /**
     * @param Request $request
     * @param string $userId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(Request $request, string $userId) {

        $this->validate($request, app(UserValidationRules::class)->edit());
        app(UserService::class)->edit($request->all(), $userId);
        return response()->json([
            'data' => [
                'status' => 'success'
            ]
        ], 201);
    }

    /***
     * @param Request $request
     * @param string $userId
     * @param string $carId
     * @return \Illuminate\Http\JsonResponse
     */
    public function attachCar(Request $request, string $userId, string $carId) {

        app(UserService::class)->attachCar($userId, $carId);
        return response()->json([
            'data' => [
                'status' => 'success'
            ]
        ], 201);

    }

    /**
     * @param Request $request
     * @param string $userId
     * @param string $carId
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachCar(Request $request, string $userId, string $carId){

        app(UserService::class)->detachCar($userId, $carId);
        return response()->json([
            'data' => [
                'status' => 'success'
            ]
        ], 201);

    }

    /**
     * @param Request $request
     * @param string $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, string $userId){

        $deletedUser = app(UserService::class)->delete($userId);
        return response()->json([
            'data' => [
                'status' => 'success'
            ]
        ], 201);
    }

}
