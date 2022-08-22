<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
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
        Permission::insert([
            ['name'=>'Manage Admin Users',
            'slug'=>'manage-admin-users',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
            ],
        ]);

        for ($i=1; $i <= 1 ; $i++) { 
            AdminPermission::insert([
                ['admin_id'=>'1',
                'permission_id'=>$i,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                ],
            ]);
        }
    }
}
