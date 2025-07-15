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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('billing_plan_id')->constrained();
            $table->bigInteger('company_id')->nullable(); // For multi-company support
            $table->string('status');
            $table->timestamp('starts_at');
            $table->timestamp('current_period_ends_at'); // For subscription period
            $table->timestamp('expires_at')->nullable(); // For cancelled subscriptions
            $table->string('liqpay_order_id')->nullable();
            $table->boolean('auto_renew')->default(true); // For subscription renewals
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
