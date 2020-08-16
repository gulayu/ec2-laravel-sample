<?php

use Illuminate\Database\Seeder;

class FeePlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fee_plans')->insert([
            'type' => 'weekdayStudent',
            'first_2h_fee' => 500,
            'extension_1h_fee' => 250,
            'max_fee' => 1000,
        ]);
        DB::table('fee_plans')->insert([
            'type' => 'weekdayNormal',
            'first_2h_fee' => 500,
            'extension_1h_fee' => 250,
            'max_fee' => 1000,
        ]);
        DB::table('fee_plans')->insert([
            'type' => 'weekendStudent',
            'first_2h_fee' => 1000,
            'extension_1h_fee' => 200,
            'max_fee' => 1500,
        ]);
        DB::table('fee_plans')->insert([
            'type' => 'weekendNormal',
            'first_2h_fee' => 1000,
            'extension_1h_fee' => 250,
            'max_fee' => 2000,
        ]);
    }
}
