<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
   public function run(): void
{
    $admin = \App\Models\User::firstOrCreate(
        ['email' => 'admin@example.com'],
        [
            'name' => 'Admin',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]
    );

    // Assign role AFTER it exists
    $admin->assignRole('admin');
}

}
