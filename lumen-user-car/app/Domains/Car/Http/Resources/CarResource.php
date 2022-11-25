<?php

namespace App\Domains\Car\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'model'      => $this->model,
            'created_at' => $this->created_at,
        ];
    }
}

