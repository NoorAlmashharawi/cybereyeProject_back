<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User1;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StudentSeeder extends Seeder
{
    public function run()
    {
        // جلب دور الطالب
        $studentRole = Role::where('name', 'طالب')->first();
        
        if(!$studentRole) {
            $studentRole = Role::create([
                'name' => 'طالب',
                'guard_name' => 'student'
            ]);
        }

        // صلاحيات الطالب
        $studentPermissions = [
            'index-course', 'index-video', 'index-material', 'index-quiz',
            'index-certificate', 'view-student-dashboard', 'view-certificates',
        ];

        foreach ($studentPermissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm, 'guard_name' => 'student']
            );
        }

        $studentRole->syncPermissions($studentPermissions);

        // ========== إنشاء طالب تجريبي ==========
        
        // 1. إنشاء User1 أولاً
        $user1 = User1::create([
            'username'   => 'student_demo',
            'email'      => 'student@cybereye.com',
            'password'   => Hash::make('12345678'),
            'role'       => 'student',
            'guard_name' => 'student',
            'actor_type' => 'App\Models\Student',
            'actor_id'   => 0, // مؤقت
        ]);

        // 2. إنشاء Student مرتبط بـ user1
        $student = Student::create([
            'level'          => 'beginner',
            'specialization' => 'General',
            'status'         => 'active',
            'progress'       => '0',
            'user_id'        => $user1->id,
            'enrollment_date'=> now(),
        ]);

        // 3. تحديث actor_id في user1
        $user1->actor_id = $student->id;
        $user1->save();

        // 4. تعيين دور الطالب للمستخدم
        $user1->assignRole($studentRole);

        echo "تم إنشاء طالب تجريبي:\n";
        echo "   Username: student_demo\n";
        echo "   Password: 12345678\n";
        echo "   Email: student@cybereye.com\n";
    }
}