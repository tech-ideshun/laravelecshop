<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->insert([
            [
                'product_id' => 1,
                'type' => 1,
                'quantity' => 5,
                'created_at' => '2022/04/07 00:00:00'
            ],
            [
                'product_id' => 1,
                'type' => 2,
                'quantity' => -2,
                'created_at' => '2022/04/07 00:01:00'
            ],
            [
                'product_id' => 2,
                'type' => 1,
                'quantity' => 5,
                'created_at' => '2022/04/07 00:02:00'
            ],
            [
                'product_id' => 2,
                'type' => 2,
                'quantity' => -4,
                'created_at' => '2022/04/07 00:03:00'
            ]
        ]);
    }
}
