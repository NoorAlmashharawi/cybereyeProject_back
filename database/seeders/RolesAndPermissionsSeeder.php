<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User1;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // إعادة تعيين ذاكرة التخزين المؤقت
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // إنشاء الصلاحيات
        $permissions = [
            'view videos',
            'create videos',
            'edit videos',
            'delete videos',
            'view certificates',
            'create certificates',
            'view students',
            'manage users',
            'view dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // إنشاء الأدوار
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $instructorRole = Role::firstOrCreate(['name' => 'instructor']);
        $studentRole = Role::firstOrCreate(['name' => 'student']);

        // إعطاء الصلاحيات للمدير
        $adminRole->syncPermissions(Permission::all());

        // إعطاء الصلاحيات للمدرب
        $instructorRole->syncPermissions([
            'view videos',
            'create videos',
            'edit videos',
            'delete videos',
            'view certificates',
            'view dashboard',
        ]);

        // إعطاء الصلاحيات للطالب
        $studentRole->syncPermissions([
            'view videos',
            'view certificates',
        ]);

        // إعطاء دور المدير لأول مستخدم (اختياري)
        $adminUser = User1::where('email', 'admin@example.com')->first();
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }
        
        $this->command->info(' Roles and permissions seeded successfully!');
        $this->command->info('Created roles: admin, instructor, student');
        $this->command->info('Created permissions: ' . implode(', ', $permissions));
    }
}