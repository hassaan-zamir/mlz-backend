<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address
        ];
    }

    public function with($request) {
        return [
            'status' => true,
            'message' => 'Success',
            'version' => '1.0.0',
            'author' => 'Hassaan Zamir'
        ];
    }
    
}
