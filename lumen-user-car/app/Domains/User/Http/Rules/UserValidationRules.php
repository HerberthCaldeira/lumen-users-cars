<?php

namespace App\Domains\User\Http\Rules;

class UserValidationRules
{
    public function create() {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ];
    }

    public function edit() {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ];
    }

}
