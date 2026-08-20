<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 * @property Product[] $products
 * @property Movement[] $movements
 *
 * @mixin Eloquent
 */
class Storage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_storages', 'storage_id', 'product_id')
                    ->withPivot('quantity');
    }

    public function movements(): HasMany
    {
        return $this->hasMany(Movement::class);
    }

}
