<?php

namespace App\Domains\User\Http\Resources;

use App\Domains\Car\Http\Resources\CarResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'cars' => CarResource::collection($this->whenLoaded('cars')),
            'created_at' => $this->created_at,
        ];
    }
}
