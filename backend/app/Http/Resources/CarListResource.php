<?php

namespace App\Http\Resources;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Car
 */
class CarListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'model' => "{$this->model?->brand} {$this->model?->model}",
            'comfort_category' => "{$this->model?->comfortCategory->name}",
            'driver' => $this->driver->name,
            'registration_number' => $this->registration_number
        ];
    }
}
