<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            [
                'category' => '銀行振込',
            ],
            [
                'category' => 'カード決済',
            ],
            [
                'category' => '代引き',
            ]
        ]);
    }
}
