<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestRoleUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Test Treasurer',
                'email' => 'treasurer@test.com',
                'role' => 'treasurer',
            ],
            [
                'name' => 'Test Secretary',
                'email' => 'secretary@test.com',
                'role' => 'secretary',
            ],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('Test@12345'),
                ]
            );

            $user->syncRoles([$data['role']]);
        }
    }
}
