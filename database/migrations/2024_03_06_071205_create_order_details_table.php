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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id("detail_ID");
            $table->foreignId("menu_ID")->references("menu_ID")->on("menu_details");
            $table->foreignId("order_ID")->references("detail_ID")->on("order_details");
            $table->enum("status",["prepared","cooking","finished"]);
            $table->float("total_price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
