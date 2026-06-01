<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('provider');
            $table->string('payer_name')->nullable()->after('payment_method');
            $table->string('payer_phone')->nullable()->after('payer_name');
            $table->string('transaction_reference')->nullable()->after('payer_phone');
            $table->string('receipt_path')->nullable()->after('transaction_reference');
            $table->text('notes')->nullable()->after('receipt_path');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'payer_name',
                'payer_phone',
                'transaction_reference',
                'receipt_path',
                'notes',
            ]);
        });
    }
};