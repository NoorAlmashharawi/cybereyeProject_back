<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->onDelete('cascade');

            $table->foreignId('course_id')
                ->constrained('courses')
                ->onDelete('cascade');

     
            $table->foreignId('instructor_id')
                ->nullable()
                ->constrained('instructors')
                ->onDelete('set null');

            $table->string('certificate_number')->unique();

         
            $table->timestamp('issued_at')->nullable();

            $table->enum('status', ['active', 'revoked'])
                ->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};