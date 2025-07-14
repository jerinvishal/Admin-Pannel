<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Role permissions
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            // User permissions
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            // User report
            'user.report',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
