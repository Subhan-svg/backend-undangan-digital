<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Administrator',
            'password' => Hash::make('password123'),
        ]);

        // Superadmin user
        $superadmin = \App\Models\User::firstOrCreate([
            'email' => 'superadmin@example.com',
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('superadmin123'),
        ]);

        // Superadmin role
        $role = Role::firstOrCreate(['name' => 'superadmin'], ['guard_name' => 'web']);

        // Assign all permissions to superadmin role
        $permissions = Permission::pluck('name')->toArray();
        $role->syncPermissions($permissions);

        // Assign role and all permissions to user
        $superadmin->assignRole($role);
        $superadmin->syncPermissions($permissions);
    }
} 