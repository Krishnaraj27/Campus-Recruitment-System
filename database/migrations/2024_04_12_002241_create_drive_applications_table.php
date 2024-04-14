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
        Schema::create('drive_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drive_id')->references('id')->on('placement_drives')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('student_id')->references('id')->on('students')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('student_resume');
            $table->string('status')->default('applied');
            $table->string('feedback')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drive_applications');
    }
};
