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
            'nim'              => $this->nim,
            'subject'          => $this->subject,
            'message'          => $this->message,
            'tracking_code'    => $this->tracking_code,
            'status'           => $this->status,
            'created_at'       => $this->created_at,
        ];
    }
}
