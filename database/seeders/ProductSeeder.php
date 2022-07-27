<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => '半袖Tシャツ',
                'info' => '綿100%で仕上げた着心地のいいTシャツです。',
                'price' => 3650,
                'is_selling' => 1,
                'category_id' => 1,
                'image1' => 'test_1.jpg',
                'image2' => 'test_2.jpg',
                'image3' => 'test_3.jpg',
                'image4' => 'test_4.jpg',
                'created_at' => '2022-04-06 00:00:00',
            ],
            [
                'name' => 'ハーフパンツ',
                'info' => '綿100%で仕上げた着心地のいいハーフパンツです。',
                'price' => 3850,
                'is_selling' => 1,
                'category_id' => 2,
                'image1' => 'test_1.jpg',
                'image2' => 'test_2.jpg',
                'image3' => 'test_3.jpg',
                'image4' => 'test_4.jpg',
                'created_at' => '2022-04-06 00:00:00',
            ]
        ]);
        
    }
}
