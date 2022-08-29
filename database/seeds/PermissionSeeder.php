<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\AdminPermission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_array = [
            [
                'name' => 'manage_operators',
                'type' => 'parent',
                'order' => 1,
            ],
            [
                'name' => 'manage_members',
                'type' => 'parent',
                'order' => 2,
            ],
            [
                'name' => 'manage_elections',
                'type' => 'parent',
                'order' => 3,
            ],
            [
                'name' => 'manage_seats',
                'type' => 'parent',
                'order' => 4,
            ],
            [
                'name' => 'manage_inquires',
                'type' => 'parent',
                'order' => 5,
            ],
        ];

        foreach ($permission_array as $permission_arr) {
            Permission::updateOrCreate(['name' => $permission_arr['name']], $permission_arr);
        }

        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            AdminPermission::updateOrCreate(['admin_id' => 1, 'permission_id' => $permission->id], [
                'admin_id' => 1,
                'permission_id' => $permission->id
            ]);
        }
    }
}
