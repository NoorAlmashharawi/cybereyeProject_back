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

            $table->string('progress')->default('0');
            $table->string('level');
            $table->string('specialization')->default('General');
            $table->string('role')->default('student');
            $table->string('status');

            $table->foreignId('user1_id')->constrained('user1s')->cascadeOnDelete();

            $table->timestamp('enrollment_date')->nullable();
            $table->softDeletes();
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
