<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Product */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'quantity' => $this->quantity,
            'expired_at' => $this->expired_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'movements_count' => $this->movements_count,

            // Relations
            'movements' => MovementResource::collection($this->whenLoaded('movements')),
            'storages' => StorageResource::collection($this->whenLoaded('storages')),
        ];
    }
}
