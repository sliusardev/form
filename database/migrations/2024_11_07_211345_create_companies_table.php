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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index();
            $table->string('name')->nullable();
            $table->string('slug')->unique()->index()->nullable();
            $table->string('hash')->unique();
            $table->json('data')->nullable();
            $table->unsignedInteger('submission_limit')->default(50);
            $table->unsignedInteger('form_limit')->default(3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
