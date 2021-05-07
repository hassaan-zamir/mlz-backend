<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShiftResource extends JsonResource
{

    public function toArray($request)
    {
      return [
          'id' => $this->id,
          'location' => $this->location,
          'start_time' => $this->start_time,
          'end_time' => $this->end_time,
          'description' => $this->description,
          'notes' => $this->notes,
          'incidents' => $this->incidents,
          'checklist' => $this->checklist
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
