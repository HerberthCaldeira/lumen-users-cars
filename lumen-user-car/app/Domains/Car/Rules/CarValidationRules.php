<?php

namespace App\Domains\Car\Rules;

class CarValidationRules
{

    public function create(){
        return [
            'model' => 'required|unique:cars'
        ];
    }

}
