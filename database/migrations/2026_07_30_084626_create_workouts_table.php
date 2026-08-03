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
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('duration');
            $table->foreignId('sportstype_id')->constrained('sports_types')->onDelete('cascade');
            $table->foreignId('workoutlevel_id')->constrained('workout_levels')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->dateTime('start_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};
