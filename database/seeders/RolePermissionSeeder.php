<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'dashboard.view',
            'members.view',
            'members.create',
            'members.edit',
            'members.delete',
            'donations.view',
            'donations.create',
            'donations.verify',
            'finance.view',
            'finance.manage',
            'events.manage',
            'seva.manage',
            'reports.view',
            'settings.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $roles = [
            'super-admin',
            'president',
            'secretary',
            'treasurer',
            'puja-coordinator',
            'seva-coordinator',
            'gita-teacher',
            'volunteer',
            'member',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);
        }

        Role::findByName('super-admin')
            ->syncPermissions(
                Permission::where('guard_name', 'web')->get()
            );

        Role::findByName('treasurer')->syncPermissions([
            'dashboard.view',
            'donations.view',
            'donations.create',
            'donations.verify',
            'finance.view',
            'finance.manage',
            'reports.view',
        ]);

        Role::findByName('president')->syncPermissions([
            'dashboard.view',
            'members.view',
            'donations.view',
            'finance.view',
            'events.manage',
            'seva.manage',
            'reports.view',
        ]);
    }
}
