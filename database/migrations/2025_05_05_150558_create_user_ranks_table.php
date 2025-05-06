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
        Schema::create('user_ranks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->enum('period_type', ['day', 'month', 'year', 'all']);
            $table->unsignedInteger('total_points')->default(0);
            $table->unsignedInteger('rank')->default(0);
            $table->timestamps();

            $table->index(['period_type']);
            $table->unique(['user_id', 'period_type'], 'unique_user_period');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ranks');
    }
};
