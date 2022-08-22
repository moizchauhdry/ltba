<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            [
                'name' => 'LTBA ADMIN',
                'email' => 'admin@ltba.com',
                'password' => Hash::make('1234567890'),
                'phone' => '03204650584',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
