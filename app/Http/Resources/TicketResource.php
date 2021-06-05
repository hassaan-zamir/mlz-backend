<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use app\Http\Resources\LocationResource;

class TicketResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'model' => $this->model,
            'unit_no' => $this->unit_no,
            'license' => $this->license,
            'phone' => $this->phone,
            'location' => new LocationResource($this->location()),
            'created_at' => $this->created_at,
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
