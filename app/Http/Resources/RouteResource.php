<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'starts_at' => $this->starts_at->format('H:i'),
            'stops' => StopResource::collection(
                $this->whenLoaded('stops', function () {
                    return $this->stops->sortBy('pivot.arrives_at')->values();
                })
            ),
        ];
    }
}
