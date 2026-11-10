<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_settings', function (Blueprint $table) {
            $table->id();
            $table->json('business_name');
            $table->string('phone', 40)->nullable();
            $table->string('whatsapp_number', 40)->nullable();
            $table->json('opening_hours')->nullable();
            $table->decimal('delivery_fee', 10, 3)->default(0);
            $table->char('currency', 3)->default('TND');
            $table->json('location')->nullable();
            $table->json('reviews')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_settings');
    }
};
