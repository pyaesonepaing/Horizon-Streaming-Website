<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subscription_id')->nullable()
                ->constrained('subscriptions')
                ->nullOnDelete();

            $table->unsignedInteger('amount_cents');
            $table->string('currency', 3)->default('USD');

            $table->string('provider')->default('mock'); // mock|stripe|paypal
            $table->string('provider_reference')->nullable();

            $table->string('status')->default('paid'); // paid|failed|refunded
            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
            $table->index(['user_id', 'status', 'paid_at']);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};