<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Clear permission cache
    app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

    // Create permissions
    $permissions = [
        'view users',
        'create users',
        'edit users',
        'delete users',
        'manage roles',
        'manage permissions',
        'view products',
        'create products',
        'edit products',
        'delete products',
       
    'view categories',
    'create categories',
    'edit categories',
    'delete categories',
    ];

    foreach ($permissions as $permission) {
        \Spatie\Permission\Models\Permission::firstOrCreate([
            'name' => $permission,
            'guard_name' => 'web',
        ]);
    }

    // Create roles
    $adminRole = \Spatie\Permission\Models\Role::firstOrCreate([
        'name' => 'admin',
        'guard_name' => 'web',
    ]);

    $userRole = \Spatie\Permission\Models\Role::firstOrCreate([
        'name' => 'user',
        'guard_name' => 'web',
    ]);

    // Assign permissions
    $adminRole->syncPermissions($permissions);
    $userRole->syncPermissions(['view products']);
}

}
