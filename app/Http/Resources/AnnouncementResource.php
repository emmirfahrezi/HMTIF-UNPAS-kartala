<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'title'        => $this->title,
            'slug'         => $this->slug,
            'excerpt'      => $this->excerpt,
            'body'         => $this->body,
            'thumbnail'    => $this->thumbnail,
            'published_at' => $this->published_at,
            'category'     => new AnnouncementCategoryResource($this->whenLoaded('category')),
            'created_at'   => $this->created_at,
        ];
    }
}
