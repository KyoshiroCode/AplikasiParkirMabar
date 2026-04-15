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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('time_in');
            $table->timestamp('time_out')->nullable();
            $table->foreignId('parking_rates_id')->constrained('parking_rates')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('duration_hour')->nullable(); 
            $table->integer('total_cost')->nullable();
            $table->enum('status', ['in', 'out'])->default('in');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('parking_areas_id')->constrained('parking_areas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
