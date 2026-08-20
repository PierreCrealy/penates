<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_storages', function (Blueprint $table) {
            $table->id();
            $table->float('quantity');
            $table->foreignId('product_id');
            $table->foreignId('storage_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_storages');
    }
};
