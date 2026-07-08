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
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('fathername');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('gender');
            $table->foreignId('sports_type_id')->constrained('sports_types')->onDelete('restrict');
            $table->string('birthplace')->nullable();
            $table->date('birthdate');
            $table->integer('years_of_experience');
            $table->string('SSN')->unique();
            $table->string('email')->unique()->nullable();
            $table->date('hiring_date');
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('certification', ['level_1', 'level_2', 'level_3', 'level_4'])->default('level_1');
            $table->foreignId('trainer_status_id')->constrained('trainer_statuses')->onDelete('restrict');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
