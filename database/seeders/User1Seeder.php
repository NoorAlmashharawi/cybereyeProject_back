<?php

namespace Database\Seeders;

use App\Models\User1;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class User1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User1::factory()->count(20)->create();
    }
}
