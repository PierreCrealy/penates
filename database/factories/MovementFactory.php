<?php

namespace Database\Factories;

use App\Models\Movement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MovementFactory extends Factory
{
    protected $model = Movement::class;

    public function definition(): array
    {
        return [
            'product_id' => $this->faker->randomNumber(),
            'storage_id' => $this->faker->randomNumber(),
            'quantity' => $this->faker->randomFloat(),
            'before' => $this->faker->randomFloat(),
            'after' => $this->faker->randomFloat(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
