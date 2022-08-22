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
                'name' =>'Admin',
                'email' =>'admin@admin.com',
                'password'=>Hash::make('password'),
                'phone'=>'03204650584',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
        ]);
    }
}
