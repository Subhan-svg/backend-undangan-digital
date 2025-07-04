<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Admin: semua permission
        $admin = Role::firstOrCreate(['name' => 'Superadmin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::pluck('name')->toArray());

        // Editor: hanya permission edit data (tanpa hapus, tanpa setting)
        $editorPermissions = [
            'category-list', 'category-create', 'category-edit',
            'service-list', 'service-create', 'service-edit',
            'about-list', 'about-create', 'about-edit',
        ];
        $editor = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $editor->syncPermissions($editorPermissions);
    }
} 