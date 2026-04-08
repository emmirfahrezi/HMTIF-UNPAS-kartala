<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AspirationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'subject'          => $this->subject,
            'message'          => $this->message,
            'tracking_code'    => $this->tracking_code,
            'status'           => $this->status,
            'is_spotlight'     => $this->is_spotlight,
            'spotlighted_week' => $this->spotlighted_week,
            'created_at'       => $this->created_at,
        ];
    }
}
