<?php

namespace App\Http\Resources;

use App\Models\Movement;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Movement */
class MovementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'storage_id' => $this->storage_id,
            'quantity' => $this->quantity,
            'before' => $this->before,
            'after' => $this->after,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // Relations
            'product' => ProductResource::collection($this->whenLoaded('product')),
            'storage' => StorageResource::collection($this->whenLoaded('storage')),
        ];
    }
}
