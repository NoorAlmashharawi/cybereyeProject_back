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
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
             $table->foreignId('student_id')->constrained('user1s')->onDelete('cascade'); // أو students حسب جدول الطلاب لديك
            $table->foreignId('quizz_id')->constrained('quizzs')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->text('answer');                 // إجابة الطالب (نص)
            $table->boolean('is_correct');          // هل الإجابة صحيحة؟
            $table->integer('points_earned');       // النقاط التي حصل عليها
            $table->timestamp('submitted_at')->nullable();

            // منع تكرار إجابة نفس الطالب لنفس السؤال في نفس الكويز
            $table->unique(['student_id', 'quizz_id', 'question_id']);
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_answers');
    }
};
