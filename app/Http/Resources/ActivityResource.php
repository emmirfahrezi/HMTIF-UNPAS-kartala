<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'title'            => $this->title,
            'slug'             => $this->slug,
            'description'      => $this->description,
            'body'             => $this->body,
            'thumbnail'        => $this->thumbnail,
            'start_date'       => $this->start_date,
            'end_date'         => $this->end_date,
            'location'         => $this->location,
            'registration_url' => $this->registration_url,
            'status'           => $this->status,
            'created_at'       => $this->created_at,
        ];
    }
}
