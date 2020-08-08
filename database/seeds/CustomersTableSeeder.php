<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('customers')->insert([
                'number'       => rand(1,100),
                'enter_time'   => Carbon::now(),
                // 'exit_time' => '',
                'day_info'     => rand(1,2),
                'member_info'  => rand(1,2),
                'use_drinkbar' => rand(1,2),
                'under_jrhigh' => rand(1,2),
                // 'fee'       => '',
                // 'memo'      => '',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ]);
        }
    }
}
