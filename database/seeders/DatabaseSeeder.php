<?php

namespace Database\Seeders;

use App\Models\Movement;
use App\Models\Product;
use App\Models\ProductStorage;
use App\Models\Storage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Storage::factory(5)->create();
        Product::factory(25)->create();
        ProductStorage::factory(50)->create();

        Movement::factory(100)->create();
    }
}
