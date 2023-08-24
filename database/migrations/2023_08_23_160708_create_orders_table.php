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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->boolean("is_paid");
            $table->decimal("total_amount",8,2);
            $table->string("customer_name", 50);
            $table->string("customer_address", 100);
            $table->string("customer_tel", 20);
            $table->string("customer_email", 50);
            $table->string("customer_note", 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
