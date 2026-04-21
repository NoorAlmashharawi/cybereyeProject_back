<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instructor;
use App\Models\User1;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Schema;

class InstructorSeeder extends Seeder
{
    public function run()
    {
        // جلب دور المدرب
        $instructorRole = Role::where('name', 'instructor')->where('guard_name', 'instructor')->first();
        
        if(!$instructorRole) {
            $instructorRole = Role::create([
                'name' => 'instructor',
                'guard_name' => 'instructor'
            ]);
        }

        // صلاحيات المدرب
        $instructorPermissions = [
            'create-quiz', 'index-quiz', 'edit-quiz', 'delete-quiz',
            'create-question', 'index-question', 'edit-question', 'delete-question',
            'create-material', 'index-material', 'edit-material', 'delete-material',
            'create-video', 'index-video', 'edit-video', 'delete-video',
            'create-course', 'index-course', 'edit-course', 'delete-course',
            'create-category', 'index-category', 'edit-category', 'delete-category',
        ];

        foreach ($instructorPermissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm, 'guard_name' => 'instructor']
            );
        }

        $instructorRole->syncPermissions($instructorPermissions);

        
            // 1. إنشاء Instructor أولاً
            $instructor = Instructor::create([
                'specialization'   => 'Web Development',
                'experience_years' => 5,
                'bio'              => 'مدرب متخصص في تطوير الويب ولغة PHP ولارافيل',
                'rating'           => 4.5,
                'enrollment_date'  => now(),
            ]);

            // 2. إنشاء User1 مرتبط بالمدرب
            $user1 = User1::create([
                'username'   => 'instructor_demo2',
                'email'      => 'instructo62r@cybereye.com',
                'password'   => Hash::make('12345678'),
                'role'       => 'instructor',
                'guard_name' => 'instructor',
                'actor_type' => 'App\Models\Instructor',
                'actor_id'   => $instructor->id,
            ]);

             // 3. تحديث actor_id في user1
        $user1->actor_id = $instructor->id;
        $user1->save();

        // 4. تعيين دور الطالب للمستخدم
        $user1->assignRole($instructorRole);

        echo "تم إنشاء طالب تجريبي:\n";
        echo "   Username: student_demo\n";
        echo "   Password: 12345678\n";
        echo "   Email: student@cybereye.com\n";

    
     
    }
}