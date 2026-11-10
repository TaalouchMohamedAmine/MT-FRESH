<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->unique();
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('phone', 40);
            $table->string('fulfillment_type', 16);
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->string('status', 24)->default('new')->index();
            $table->string('payment_method', 32)->default('cash_on_delivery');
            $table->string('locale', 5)->default('fr');
            $table->char('currency', 3)->default('TND');
            $table->decimal('subtotal', 10, 3);
            $table->decimal('delivery_fee', 10, 3)->default(0);
            $table->decimal('total', 10, 3);
            $table->timestamps();
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
