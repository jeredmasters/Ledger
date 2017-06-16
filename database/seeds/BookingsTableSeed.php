<?php

use Illuminate\Database\Seeder;

class BookingsTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->insert([
            'name' => str_random(10),
            'from' => new DateTime('2017-06-14'),
            'to' => new DateTime('2017-06-18'),
            'main' => true,
            'flat' => true,
            'studio' => true,
            'user_id' => 0
        ]);
        DB::table('bookings')->insert([
            'name' => str_random(10),
            'from' => new DateTime('2017-06-19'),
            'to' => new DateTime('2017-06-21'),
            'main' => false,
            'flat' => false,
            'studio' => true,
            'user_id' => 0
        ]);
        DB::table('bookings')->insert([
            'name' => str_random(10),
            'from' => new DateTime('2017-06-20'),
            'to' => new DateTime('2017-06-25'),
            'main' => true,
            'flat' => false,
            'studio' => false,
            'user_id' => 0
        ]);
        DB::table('bookings')->insert([
            'name' => str_random(10),
            'from' => new DateTime('2017-06-4'),
            'to' => new DateTime('2017-06-9'),
            'main' => true,
            'flat' => true,
            'studio' => false,
            'user_id' => 0
        ]);
    }
}
