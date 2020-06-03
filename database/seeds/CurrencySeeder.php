<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->truncate();

        DB::table('currencies')->insert([
            [
                'code' => 'BYN',
                'symbol' => 'Br',
                'is_main' => 1,
                'rate' => 1,
                'updated_at' => '2020-01-01 00:00:00',

            ],
            [
                'code' => 'USD',
                'symbol' => '$',
                'is_main' => 0,
                'rate' => 0,
                'updated_at' => '2020-01-01 00:00:00',
            ],
            [
                'code' => 'EUR',
                'symbol' => '€',
                'is_main' => 0,
                'rate' => 0,
                'updated_at' => '2020-01-01 00:00:00',
            ],
        ]);
    }
}
