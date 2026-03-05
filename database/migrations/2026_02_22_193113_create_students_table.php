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
            $table->string('email')->unique();
            $table->string('username');
            $table->string('progress')->default('0'); // أضفنا قيمة افتراضية
            $table->string('level');
            $table->string('specialization')->default('General'); // أضفنا قيمة افتراضية
            $table->string('role')->default('student'); // أضفنا الحقل الناقص
            $table->string('status');
            $table->timestamp('enrollment_date')->nullable(); // أعدنا تفعيل الحقل وجعلناه يقبل قيم فارغة
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
