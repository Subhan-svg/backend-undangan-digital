<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Role
            'role-list', 'role-create', 'role-edit', 'role-delete',
            // Permission
            'permission-list', 'permission-create', 'permission-edit', 'permission-delete',
            // User
            'user-list', 'user-create', 'user-edit', 'user-delete',
            // Category
            'category-list', 'category-create', 'category-edit', 'category-delete',
            // Service
            'service-list', 'service-create', 'service-edit', 'service-delete',
            // About
            'about-list', 'about-create', 'about-edit',
            // Setting
            'setting-list', 'setting-edit',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
    }
} 