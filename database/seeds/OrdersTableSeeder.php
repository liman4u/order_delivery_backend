<?php

use Illuminate\Database\Seeder;
use  Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'start_latitude' => '5.555700',
            'start_longitude' => '-0.196300',
            'end_latitude' => '6.687100',
            'end_longitude' => '-1.622000',
            'distance' => '20 km',
            'status' => 'UNASSIGN'
        ]);

        DB::table('orders')->insert([
            'start_latitude' => '6.555700',
            'start_longitude' => '-0.196300',
            'end_latitude' => '7.607100',
            'end_longitude' => '-0.622000',
            'distance' => '120 km',
            'status' => 'TAKEN'
        ]);

        DB::table('orders')->insert([
            'start_latitude' => '5.500700',
            'start_longitude' => '-0.100300',
            'end_latitude' => '8.687100',
            'end_longitude' => '-1.422000',
            'distance' => '60 km',
            'status' => 'UNASSIGN'
        ]);

        DB::table('orders')->insert([
            'start_latitude' => '5.555700',
            'start_longitude' => '-0.100300',
            'end_latitude' => '9.687100',
            'end_longitude' => '-1.600000',
            'distance' => '80 km',
            'status' => 'UNASSIGN'
        ]);

        DB::table('orders')->insert([
            'start_latitude' => '5.555700',
            'start_longitude' => '-0.196300',
            'end_latitude' => '5.687100',
            'end_longitude' => '-0.600000',
            'distance' => '150 km',
            'status' => 'UNASSIGN'
        ]);
    }
}
