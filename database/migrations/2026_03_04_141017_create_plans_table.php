<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');               // Premium Monthly
            $table->string('code')->unique();     // premium_monthly
            $table->unsignedInteger('price_cents');
            $table->string('currency', 3)->default('USD');
            $table->string('interval')->default('month');
            $table->unsignedInteger('interval_count')->default(1);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};