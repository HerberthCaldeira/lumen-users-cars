<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/******/
//$router->post('/user', function(\Illuminate\Http\Request $re){
//    return $re->post();
//});

$router->post('/user', ['uses' => 'User\Http\Controllers\UserController@create']);
$router->get('/users', ['uses' => 'User\Http\Controllers\UserController@users']);
$router->get('/user/{userId}', ['uses' => 'User\Http\Controllers\UserController@user']);
$router->put('/user/{userId}', ['uses' => 'User\Http\Controllers\UserController@edit']);
$router->delete('/user/{userId}', ['uses' => 'User\Http\Controllers\UserController@delete']);

$router->post('/user/{userId}/car/{carId}', ['uses' => 'User\Http\Controllers\UserController@attachCar']);
$router->delete('/user/{userId}/car/{carId}', ['uses' => 'User\Http\Controllers\UserController@detachCar']);

$router->post('/car', ['uses' => 'Car\Http\Controllers\CarController@create']);
$router->get('/car/{carId}', ['uses' => 'Car\Http\Controllers\CarController@car']);
$router->get('/cars', ['uses' => 'Car\Http\Controllers\CarController@cars']);
$router->put('/car/{carId}', ['uses' => 'Car\Http\Controllers\CarController@edit']);
$router->delete('/car/{carId}', ['uses' => 'Car\Http\Controllers\CarController@delete']);


