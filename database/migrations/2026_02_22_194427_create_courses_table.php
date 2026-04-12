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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->string('short_description');
            $table->integer('no_hours');
            $table->string('level');
            $table->decimal('rating', 8, 2)->default(0); // هيك إذا ما بعثتي قيمة، الداتابيز بتحط 0 وما بتعلق
            $table->timestamps();
            $table->enum('status', ['active', 'draft'])->default('active');
            $table->string('course_image')->nullable();
           //$table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('instructor_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
