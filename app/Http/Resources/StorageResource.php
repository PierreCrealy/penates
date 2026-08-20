<?php

namespace App\Http\Resources;

use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Storage */
class StorageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // Relations
            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
