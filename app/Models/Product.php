<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property int $id
 * @property string $name
 * @property float $quantity
 * @property string $expired_at
 * @property string $created_at
 * @property string $updated_at
 * @property Movement[] $movements
 * @property ProductStorage[] $storages
 *
 * @mixin Eloquent
 */
class Product extends Model
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime:Y-m-d'
    ];

    public function movements(): HasMany
    {
        return $this->hasMany(Movement::class);
    }

    public function storages(): BelongsToMany
    {
        return $this->belongsToMany(Storage::class, 'product_storages', 'product_id', 'storage_id')
                    ->withPivot('quantity');
    }

    public function getQuantityAttribute()
    {
        return $this->storages->sum('pivot.quantity') ?? 0;
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
