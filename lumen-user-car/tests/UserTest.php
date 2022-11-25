<?php

use Illuminate\Support\Arr;

class UserTest extends TestCase
{
    public function getUserDate(){
        $user = \App\Models\User::factory()->make();
        return  Arr::add($user->toArray(), 'password' , '123456');
    }
    /**
     * @return void
     */
    public function test_it_can_create_user(){
        //Arrange
        $user = $this->getUserDate();
        //Act
        $response = $this->call('POST', '/user', $user);
        //Assertions
        $this->assertEquals(201, $response->status());
        $this->seeInDatabase('users', ['email' => $user['email']]);
    }

    public function test_it_check_require_name_field(){
        //Arrange
        $user = $this->getUserDate();
        //Act
        $response = $this->call('POST', '/user', Arr::except($user, ['name']) );
        //Assertions
        $this->assertEquals(422, $response->status());
        $this->seeJsonEquals([
            'name' => ["The name field is required."],
        ]);
    }

    public function test_it_check_require_email_field(){
        //Arrange
        $user = $this->getUserDate();
        //Act
        $response = $this->call('POST', '/user', Arr::except($user,['email']) );
        //Assertions
        $this->assertEquals(422, $response->status());
        $this->seeJsonEquals([
            'email' => ["The email field is required."],
        ]);
    }

    public function test_it_check_validate_email_field(){
        //Arrange
        $user =  $user = array_merge($this->getUserDate(), ['email' => 'not valid']);
        //Act
        $response = $this->call('POST', '/user', $user);
        //Assertions
        $this->assertEquals(422, $response->status());
        $this->seeJsonEquals([
            'email' => ["The email must be a valid email address."],
        ]);
    }

    public function test_it_check_validate_unique_email_field(){
        //Arrange
        $user = \App\Models\User::factory()->create();
        //Act
        $response = $this->call('POST', '/user', array_merge($user->toArray(), ['password' => '123456']));
        //Assertions
        $this->assertEquals(422, $response->status());
        $this->seeJsonEquals([
            'email' => ["The email has already been taken."],
        ]);
    }

    public function test_it_can_return_a_user_by_id(){
        //Arrange
        $user = \App\Models\User::factory()->create();
        //Act
        $response = $this->call('GET', '/user/' . $user->id);
        //Assertions
        $this->assertEquals(201, $response->status());
    }

    public function test_it_can_return_a_user_by_id_with_cars(){
        //Arrange
        $user = \App\Models\User::factory()->create();
        $newcar = \App\Models\Car::factory()->create();
        $user->cars()->attach($newcar);

        //Act
        $response = $this->call('GET', '/user/' . $user->id);
        //Assertions
        $this->assertEquals(201, $response->status());
        $this->seeJsonEquals([
            'data' =>( new \App\Domains\User\Http\Resources\UserResource($user->load('cars'))),
        ]);

    }

    public function test_it_can_return_all_users_with_cars(){
        //Arrange
        $user = \App\Models\User::factory()->create();
        $car = \App\Models\Car::factory()->create();
        $user->cars()->attach($car);

        $users = \App\Models\User::all();
        $users->load('cars');
        //Act
        $response = $this->call('GET', '/users');
        //Assertions
        $this->assertEquals(201, $response->status());
        $this->seeJsonEquals([
            'data' => collect($users)->map( function ($user) {
                return new \App\Domains\User\Http\Resources\UserResource($user);
            }),
        ]);
    }

    public function test_it_check_for_user_not_found(){
        //Arrange
        $user = $this->getUserDate();
        //Act
        $response = $this->call('GET', '/user/'. 9999);
        //Assertions
        $this->assertEquals(404, $response->status());
        $this->seeJsonEquals([
            'status' => 'failed',
            'message' => 'Model not found'
        ]);
    }

    public function test_it_can_delete_user_by_id(){
        //Arrange
        $user = \App\Models\User::factory()->create();
        //Act
        $response = $this->call('DELETE', '/user/'. $user->id);
        $userDeleted = \App\Models\User::withTrashed()->find($user->id);
        //Assertions
        $this->assertEquals(201, $response->status());
        $this->seeInDatabase('users', ['email' => $user['email'], 'deleted_at' => $userDeleted['deleted_at'] ]);
    }

    public function test_it_can_change_mail_and_password(){
        //Arrange
        $user = \App\Models\User::factory()->create();
        //Act
        $response = $this->call('PUT', '/user/'. $user->id, [
            'email'    => 'new@email',
            'password' => 'senha1239@'
        ]);

        $this->assertEquals(201, $response->status());
    }

    public function test_it_can_user_attach_car(){
        //Arrange
        $user = $user = \App\Models\User::factory()->create();
        $car = \App\Models\Car::factory()->create();
        //Act
        $response = $this->call(
            'POST',
            '/user/'. $user->id . '/car/' .  $car->id
       );

        $this->assertEquals(201, $response->status());
        $this->seeInDatabase('car_user', [
            'user_id' => $user->id,
            'car_id'  => $car->id
        ]);

    }

    public function test_it_can_user_detach_car(){
        //Arrange
        $user = $user = \App\Models\User::factory()->create();
        $car = \App\Models\Car::factory()->create();

        //Act
        $response = $this->call(
            'DELETE',
            '/user/'. $user->id . '/car/' .  $car->id
        );

        $this->assertEquals(201, $response->status());
        $this->notSeeInDatabase('car_user', [
         'user_id' => $user->id,
         'car_id'  => $car->id
        ]);

    }


}
