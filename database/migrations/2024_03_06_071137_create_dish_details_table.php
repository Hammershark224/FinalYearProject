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
        Schema::create('dish_details', function (Blueprint $table) {
            $table->id("dish_ID");
            $table->string("dish_name");
            $table->string("dish_description");
            $table->decimal('dish_cost', 8, 2);
            $table->boolean("dish_status");
            $table->string("dish_photo")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dish_details');
    }
};
