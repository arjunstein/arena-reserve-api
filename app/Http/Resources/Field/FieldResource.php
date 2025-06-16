<?php

namespace App\Http\Resources\Field;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'id'           => $this->id,
            'field_name'   => $this->field_name,
            'description'  => $this->description,
            'price_day'    => number_format($this->price_day, 0, ',', '.'),
            'price_night'  => number_format($this->price_night, 0, ',', '.'),
            'status'       => $this->status,
            'created_at'   => $this->created_at?->toDateTimeString(),
            'updated_at'   => $this->updated_at?->toDateTimeString(),
        ];
    }
}
