<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MinuteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'nomor'               => $this->nomor,
            'perihal'             => $this->perihal,
            'tanggal'             => $this->tanggal,
            'waktu_mulai'         => $this->waktu_mulai,
            'waktu_selesai'       => $this->waktu_selesai,
            'tempat'              => $this->tempat,
            'dipimpin_oleh'       => $this->dipimpin_oleh,
            'agenda'              => $this->agenda,
            'isi_rapat'           => $this->isi_rapat,
            'dokumentasi_file'    => $this->dokumentasi_file,
            'attendees'           => MinuteAttendeeResource::collection($this->whenLoaded('attendees')),
            'created_at'          => $this->created_at,
            'updated_at'          => $this->updated_at,
        ];
    }
}
