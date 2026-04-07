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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();

            $table->string('specialization')->nullable();
            $table->integer('experience_years')->nullable();
            $table->text('bio')->nullable();
            $table->decimal('rating',2,1)->default(0)->nullable();
            $table->date('enrollment_date')->nullable();
            //  $table->foreignId('user1_id');
            // $table->foreign('user1_id')->on('user1s')->references('id')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
