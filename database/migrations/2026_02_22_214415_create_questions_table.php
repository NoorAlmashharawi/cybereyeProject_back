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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();

            $table->string('title');                   // نص السؤال
            $table->enum('type', ['mc', 'tf']);        // mc = اختيار من متعدد، tf = صح/خطأ
            $table->json('options')->nullable();       // الخيارات (مصفوفة) فقط لـ mc
            $table->string('correct_answer');          // الإجابة الصحيحة (نص)
            $table->integer('points')->default(1);     // درجة السؤال
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('quizz_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
