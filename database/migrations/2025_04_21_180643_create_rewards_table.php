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
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('required_level')->default(1);
            $table->enum('type', ['badge', 'voucher', 'mentorship', 'custom'])->default('custom');
            $table->unsignedBigInteger('entity_id')->nullable(); // opcional
            $table->timestamps();

            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
