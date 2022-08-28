<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_array = [
            [
                'name' => 'LTBA ADMIN',
                'email' => 'admin@ltba.com',
                'password' => Hash::make('1234567890'),
                'phone' => '03204650584',
                'status' => TRUE,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($admin_array as $admin) {
            Admin::updateOrCreate(['email' => $admin['email']], $admin);
        }
    }
}
