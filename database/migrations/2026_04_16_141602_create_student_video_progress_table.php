<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_video_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('video_id')->constrained('videos')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->boolean('completed')->default(false);
            $table->integer('last_position')->default(0); // آخر موضع مشاهدة
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            $table->unique(['student_id', 'video_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_video_progress');
    }
};