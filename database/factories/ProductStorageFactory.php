<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductStorage;
use App\Models\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductStorageFactory extends Factory
{
    protected $model = ProductStorage::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'product_id' => Product::factory(),
            'storage_id' => Storage::factory(),

            'quantity' => $this->faker->randomFloat(),
        ];
    }
}
