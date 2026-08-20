<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $product_id
 * @property int $storage_id
 * @property float $quantity
 * @property float $before
 * @property float $after
 * @property string $created_at
 * @property string $updated_at
 * @property Product $product
 * @property Storage $storage
 *
 * @mixin Eloquent
 */
class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'storage_id',
        'quantity',
        'before',
        'after',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function storage(): BelongsTo
    {
        return $this->belongsTo(Storage::class);
    }
}
