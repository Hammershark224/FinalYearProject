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
        Schema::create('cost_details', function (Blueprint $table) {
            $table->id('cost_ID');
            $table->string('cost_type');
            $table->decimal('value', 8, 2)->nullable();
            // $table->decimal('overhead_cost', 8, 2)->nullable();
            // $table->decimal('labor_cost', 8, 2)->nullable();
            // $table->decimal('margin_cost', 8, 2)->nullable();
            // $table->decimal('packaging_cost', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cost_details');
    }
};
