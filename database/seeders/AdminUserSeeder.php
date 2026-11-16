<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@admin.org'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('password'),
            ]
        );

        $admin->assignRole(
            Role::findByName('super-admin')
        );
    }
}
