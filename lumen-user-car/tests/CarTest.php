<?php

use Illuminate\Support\Arr;

class CarTest extends TestCase
{

    public function test_it_can_create_car(){
        //Arrange
        $car = \App\Models\Car::factory()->make();
        //Act
        $response = $this->call('POST', '/car', $car->toArray());
        //Assertions
        $this->assertEquals(201, $response->status());
        $this->seeInDatabase('cars', ['model' => $car['model']]);
    }

    public function test_it_can_require_model_field(){
        //Arrange
        $car = \App\Models\Car::factory()->make();
        //Act
        $response = $this->call('POST', '/car', Arr::except($car->toArray(),['model']) );
        //Assertions
        $this->assertEquals(422, $response->status());
        $this->seeJsonEquals([
            'model' => ["The model field is required."],
        ]);
    }

    public function test_it_can_validate_unique_model_field(){
        //Arrange
        $car = \App\Models\Car::factory()->create();
        //Act
        $response = $this->call('POST', '/car', $car->toArray());
        //Assertions
        $this->assertEquals(422, $response->status());
        $this->seeJsonEquals([
            'model' => ["The model has already been taken."],
        ]);
    }

    public function test_it_can_return_car_by_id(){
        //Arrange
        $car = \App\Models\Car::factory()->create();
        //Act
        $response = $this->call('GET', '/car/' . $car->id);
        //Assertions
        $this->assertEquals(201, $response->status());
    }

    public function test_it_can_return_all_cars(){
        //Arrange
        $newCars = \App\Models\Car::factory(5)->create();
        $cars = \App\Models\Car::all();
        $cars->load('users');
        //Act
        $response = $this->call('GET', '/cars' );

        //Assertions
        $this->assertEquals(201, $response->status());
        $this->seeJsonEquals([
            'data' => collect($cars)->map( function ($car) {
                return new \App\Domains\Car\Http\Resources\CarResource($car);
            }),
        ]);
    }

    public function test_it_can_update_a_car_by_id(){
        //Arrange
        $car = \App\Models\Car::factory()->create();
        $newDataCar = [
            'model' => "it was update-" . \Illuminate\Support\Str::random('4'),
        ];
        //Act
        $response = $this->call('PUT', '/car/' . $car->id, $newDataCar);
        //Assertions
        $this->assertEquals(201, $response->status());
        $this->seeInDatabase('cars', ['id' => $car->id, 'model' => $newDataCar['model']]);
    }

    public function test_it_can_delete_car_by_id(){
        //Arrange
        $car = \App\Models\Car::factory()->create();
        //Act
        $response = $this->call('DELETE', '/car/'. $car->id);
        $carDeleted = \App\Models\Car::withTrashed()->find($car->id);
        //Assertions
        $this->assertEquals(201, $response->status());
        $this->seeInDatabase('cars', ['model' => $car['model'], 'deleted_at' => $carDeleted['deleted_at'] ]);
    }

}
