<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'date' => $this->date->format('Y-m-d'),
            'is_published' => $this->is_published,
            'car_number' => $this->car_number,
            'link' => $this->link,
            'seats' => $this->seats,
            'remaining_seats' => $this->seats - $this->registrations_count,
            'route' => new RouteResource($this->whenLoaded('route')->load('stops')),
        ];
    }
}
