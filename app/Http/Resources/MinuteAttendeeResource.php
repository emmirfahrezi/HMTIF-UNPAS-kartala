<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MinuteAttendeeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'minute_id'  => $this->minute_id,
            'name'       => $this->name,
            'nim'        => $this->nim,
            'jabatan'    => $this->jabatan,
            'keterangan' => $this->keterangan,
            'paraf'      => $this->paraf,
            'order'      => $this->order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
