<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('price_details', function (Blueprint $table) {
            $table->id("price_ID");
            $table->foreignId("dish_ID")->references("dish_ID")->on("dish_details");
            $table->decimal("overhead_price",8 ,2)->nullable();
            $table->decimal("labor_price",8 ,2)->nullable();
            $table->decimal("margin_price",8 ,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_details');
    }
};
