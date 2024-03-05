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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('enrollment');
            $table->string('course');
            $table->integer('semester');
            $table->string('mobile');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('status')->default('active');
            $table->string('personal_email');
            $table->decimal('cgpa');
            $table->integer('backlogs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
