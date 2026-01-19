<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        $permissions = [
            // Users
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Roles & permissions
            'manage roles',
            'manage permissions',

            // Products
            'view products',
            'create products',
            'edit products',
            'delete products',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user  = Role::firstOrCreate(['name' => 'user']);

        // Assign all permissions to admin
        $admin->syncPermissions($permissions);

        // User role gets limited permissions
        $user->syncPermissions([
            'view products',
        ]);
    }
}
