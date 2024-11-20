<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'gallery_id' => $this->gallery_id,
            'file' => $this->file,
            'judul' => $this->judul,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'gallery' => $this->whenLoaded('gallery')
        ];
    }
}
