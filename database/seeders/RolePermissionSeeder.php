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
            'donations.receipt',
            'donation-categories.manage',
            'finance.view',
            'finance.manage',
            'events.manage',
            'seva.manage',
            'reports.view',
            'settings.manage',
            'donors.view',
            'donors.create',
            'donors.edit',
            'donors.delete',
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
            'donations.receipt',
            'finance.view',
            'finance.manage',
            'reports.view',
            'donors.view',
            'donors.create',
        ]);

        Role::findByName('president')->syncPermissions([
            'dashboard.view',
            'members.view',
            'donations.view',
            'donations.receipt',
            'finance.view',
            'events.manage',
            'seva.manage',
            'reports.view',
            'donors.view',
        ]);

        Role::findByName('secretary')->givePermissionTo([
            'dashboard.view',
            'members.view',
            'members.create',
            'members.edit',
            'donations.view',
            'donations.create',
            'donations.receipt',
            'donation-categories.manage',
            'reports.view',
            'donors.view',
            'donors.create',
            'donors.edit',
        ]);
    }
}
