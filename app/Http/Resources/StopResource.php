<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StopResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $arrives_at = $this->pivot->arrives_at ? Carbon::parse($this->pivot->arrives_at)->format('H:i') : "";
        return [
            'id' => $this->id,
            'name' => $this->name,
            'link' => $this->link,
            'arrives_at' => $arrives_at,
            'position' => $this->pivot->position
        ];
    }
}
