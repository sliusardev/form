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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // ID компанії
            $table->string('provider'); // wayforpay, monobank, liqpay
            $table->string('payment_id')->unique(); // ID від провайдера
            $table->decimal('amount', 10, 2);
            $table->string('currency', 10)->default('UAH');
            $table->string('status')->default('pending'); // оновлено: enum в моделі
            $table->json('payload')->nullable(); // зберігаємо все що приходить
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
