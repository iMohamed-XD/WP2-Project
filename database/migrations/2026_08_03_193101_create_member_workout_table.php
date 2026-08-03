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
        Schema::create('member_workout', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('workout_id')->constrained()->cascadeOnDelete();
            $table->foreignId('trainer_id')->nullable()->constrained('trainers')->nullOnDelete();
            $table->date('start_date');
            $table->timestamps();
            $table->unique(['member_id', 'workout_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_workout');
    }
};
