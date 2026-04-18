<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //ROLES
          Role::create(['name' => 'super admin', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
          Role::create(['name' => 'admin', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
          Role::create(['name' => ' مدرب', 'guard_name' => 'author', 'created_at' => now(), 'updated_at' => now()]);
          Role::create(['name' => 'طالب ', 'guard_name' => 'student', 'created_at' => now(), 'updated_at' => now()]);
   
          // permission for Admin
          Permission::create(['name' => 'create-admin', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-admin', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'delete-admin', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);

          Permission::create(['name' => 'create-student', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-student', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'delete-student', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);

          Permission::create(['name' => 'create-instuctor', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-instuctor', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'delete-instuctor', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);

        
          Permission::create(['name' => 'index-quiz', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-question', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-material', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-video', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-course', 'guard_name' => 'admin', 'created_at' => now(), 'updated_at' => now()]);




          // permission for student
          Permission::create(['name' => 'index-quiz', 'guard_name' => 'student', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-question', 'guard_name' => 'student', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-material', 'guard_name' => 'student', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-video', 'guard_name' => 'student', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-course', 'guard_name' => 'student', 'created_at' => now(), 'updated_at' => now()]);


          // permission for instuctor

          Permission::create(['name' => 'create-quiz', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-quiz', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'delete-quiz', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);

          Permission::create(['name' => 'create-question', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-question', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'delete-question', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);
    
          Permission::create(['name' => 'create-material', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-material', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'delete-material', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);


          Permission::create(['name' => 'create-video', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-video', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'delete-video', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);

          Permission::create(['name' => 'create-course', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'index-course', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);
          Permission::create(['name' => 'delete-course', 'guard_name' => 'instuctor', 'created_at' => now(), 'updated_at' => now()]);





    }
}
