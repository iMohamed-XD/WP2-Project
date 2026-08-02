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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('father_name');
            $table->string('last_name');
            $table->string('email');
            $table->date('birth_date');
            $table->string('national_id' ,  11 )->unique();
            $table->string('phone');
            $table->string('photo')->nullable();
            $table->integer('membership_duration');
            $table->foreignId('membership_type_id')->constrained('membership_types');
            $table->foreignId('member_status_id')->constrained('member_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
