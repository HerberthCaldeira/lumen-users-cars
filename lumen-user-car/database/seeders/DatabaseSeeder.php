<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $users = \App\Models\User::factory(10)->create();
        $cars = \App\Models\Car::factory(10)->create();

        // Populate the pivot table
        $users->each(function ($user) use ($cars) {
            $user->cars()->attach(
                $cars->random(rand(1, 10))->pluck('id')->toArray()
            );
        });
    }
}
