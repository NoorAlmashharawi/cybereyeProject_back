<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user1s', function (Blueprint $table) {
            $table->string('guard_name')->default('admin')->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('user1s', function (Blueprint $table) {
            $table->dropColumn('guard_name');
        });
    }
};