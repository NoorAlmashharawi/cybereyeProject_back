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
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // أو 'students' حسب جدول الطلاب لديك
            $table->foreignId('quizz_id')->constrained()->onDelete('cascade');
            $table->integer('score');               // الدرجة التي حصل عليها الطالب
            $table->integer('total_points');        // المجموع الكلي لدرجات الكويز
            $table->timestamp('submitted_at')->nullable();
            $table->unique(['student_id', 'quizz_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_results');
    }
};
