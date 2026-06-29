<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'position'  => $this->position,
            'photo'     => $this->photo,
            'bio'       => $this->bio,
            'instagram' => $this->instagram,
            'linkedin'  => $this->linkedin,
            'order'     => $this->order,
            'is_active' => $this->is_active,
            'is_bph'    => $this->is_bph,
            'division'  => new DivisionResource($this->whenLoaded('division')),
        ];
    }
}
