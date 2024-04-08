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
        Schema::create('ingredient_details', function (Blueprint $table) {
            $table->id("ingredient_ID");
            $table->foreignId("supplier_ID")->references("supplier_ID")->on("supplier_details");
            $table->string("ingredient_name");
            $table->float("ingredient_price");
            $table->string("ingredient_weight");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredient_details');
    }
};
