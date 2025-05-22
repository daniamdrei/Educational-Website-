<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use \Spatie\Permission\Models\Permission;
use \Spatie\Permission\Models\Role;

class PermissionAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guard_name = 'admin';

        $dataRoles = [
            [
                'name' => 'Super Admin',
                'guard_name' => $guard_name,
            ],
        ];

        $data = [
            ['name' => 'manage_roles', 'guard_name' => $guard_name,],
            ['name' => 'add_admins', 'guard_name' => $guard_name,],
            ['name' => 'show_admins', 'guard_name' => $guard_name,],
        ];

        $admin = Admin::query()->where('email', 'admin@admin.com')->first();
        if (!$admin) {
            $admin = Admin::query()->updateOrCreate([
                'email' => 'admin@admin.com'
            ], [
                'name' => 'Admin',
                'password' => \Illuminate\Support\Facades\Hash::make(123456)
            ]);
        }
        foreach ($dataRoles as $item) {
            $role = Role::query()->updateOrCreate(['name' => $item['name']], $item);
        }
        
        $admin->syncRoles([$role['id']]);

        foreach ($data as $item) {
            $permission = Permission::query()->updateOrCreate(['name' => $item['name']], $item);
            $role->givePermissionTo($permission);
        }

    }
}
