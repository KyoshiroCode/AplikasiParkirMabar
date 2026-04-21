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
        Schema::create('financial_reports', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['daily', 'monthly']);
            $table->date('date')->nullable();     // untuk harian
            $table->string('month')->nullable();  // format: 2026-04

            $table->integer('total_transactions')->default(0);
            $table->decimal('total_income', 12, 2)->default(0);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_reports');
    }
};
