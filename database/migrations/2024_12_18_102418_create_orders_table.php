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
            $table->string('contact_person', length: 255);
            $table->string('customer_email', length: 255);
            $table->string('customer_phone', length: 255);
            $table->string('company', length: 255);
            $table->string('delivery_location', length: 255);
            $table->text('message');
            $table->json('items');
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
