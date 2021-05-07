<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
      return [
          'id' => $this->id,
          'name' => $this->name,
          'email' => $this->email,
          'type' => $this->type
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
