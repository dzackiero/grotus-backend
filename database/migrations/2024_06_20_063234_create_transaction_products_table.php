<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("transaction_id")->constrained()->cascadeOnDelete();
            $table->foreignId("product_id");
            $table->foreignId("rating_id")->nullable();
            
            /* Duplicate of the product */
            $table->string("name");
            $table->double("price");
            $table->unsignedInteger("amount");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_products');
    }
};
