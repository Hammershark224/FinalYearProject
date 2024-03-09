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
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id("customer_ID");
            $table->foreignId("table_ID")->references("table_ID")->on("table_details");
            $table->enum("status",["order", "topup", "pay"]);
            $table->string("payment_proof");
            $table->string("payment_amount");
            $table->string("notes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_details');
    }
};
