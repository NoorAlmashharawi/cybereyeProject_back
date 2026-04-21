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
        $instructorRole = Role::where('name', 'مدرب')->where('guard_name', 'instructor')->first();
        
        if(!$instructorRole) {
            $instructorRole = Role::create([
                'name' => 'مدرب',
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

        // إنشاء الصلاحيات إذا لم تكن موجودة
        foreach ($instructorPermissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm, 'guard_name' => 'instructor'],
                ['name' => $perm, 'guard_name' => 'instructor']
            );
        }

        // تعيين الصلاحيات لدور المدرب
        $instructorRole->syncPermissions($instructorPermissions);

        // ========== إنشاء مدرب تجريبي ==========
        
        // التحقق من عدم وجود مدرب بنفس البريد
        $existingUser = User1::where('email', 'instructor@cybereye.com')->first();
        
        if (!$existingUser) {
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
                'username'   => 'instructor_demo',
                'email'      => 'instructor@cybereye.com',
                'password'   => Hash::make('12345678'),
                'role'       => 'instructor',
                'guard_name' => 'instructor',
                'actor_type' => 'App\Models\Instructor',
                'actor_id'   => $instructor->id,
            ]);


            // 3. تعيين دور المدرب للمستخدم
            $user1->assignRole($instructorRole);

            echo "========================================\n";
            echo "تم إنشاء مدرب تجريبي بنجاح!\n";
            echo "========================================\n";
            echo "البريد الإلكتروني: instructor@cybereye.com\n";
            echo " كلمة المرور: 12345678\n";
            echo " اسم المستخدم: instructor_demo\n";
            echo " التخصص: Web Development\n";
            echo " الصلاحيات: " . $instructorRole->permissions->count() . " صلاحية\n";
            echo "========================================\n";
        } else {
            echo " المدرب موجود بالفعل!\n";
            echo " البريد: instructor@cybereye.com\n";
            echo "كلمة المرور: 12345678\n";
        }
    }
}