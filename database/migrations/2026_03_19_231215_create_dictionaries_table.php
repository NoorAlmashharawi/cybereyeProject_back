<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dictionary_entries', function (Blueprint $table) {
            $table->id();
            $table->string('term');          
            $table->text('definition');     
            $table->string('category')->nullable(); 
            $table->string('example')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dictionary_entries');
    }
};