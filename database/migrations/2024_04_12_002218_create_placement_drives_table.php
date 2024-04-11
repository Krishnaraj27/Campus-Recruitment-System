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
        Schema::create('placement_drives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->references('id')->on('companies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->text('description');
            $table->dateTime('date');
            $table->string('attachment')->nullable();
            $table->dateTime('application_deadline');
            $table->string('mode');
            $table->float('min_cgpa',4,2,true)->nullable();
            $table->integer('max_backlogs',false,true)->nullable();
            $table->string('status')->default('upcoming');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placement_drives');
    }
};
