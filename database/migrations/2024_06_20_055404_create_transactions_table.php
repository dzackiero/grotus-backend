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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->string("name");
            $table->string("address");
            $table->string("phone");
            $table->enum("payment_method", enumValues(\App\Enums\PaymentMethod::cases()))->nullable();
            $table->enum("delivery_method", enumValues(\App\Enums\DeliveryMethod::cases()))->nullable();
            $table->enum("status", enumValues(\App\Enums\TransactionStatus::cases()))->default(\App\Enums\TransactionStatus::WAITING_PAYMENT);
            $table->dateTime("paid_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
