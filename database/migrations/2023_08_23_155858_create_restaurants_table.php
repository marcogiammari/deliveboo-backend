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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string("name", 100);
            $table->string("vat_number", 20);
            $table->string("note", 255)->nullable();
            $table->foreignId("user_id")->bigint();
            $table->string("city", 30);
            $table->string("street_name", 50);
            $table->string("street_number", 15);
            $table->string("zip_code", 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
