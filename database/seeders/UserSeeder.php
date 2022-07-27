<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'test1',
                'email' => 'test1@test.com',
                'password' => Hash::make('password123'),
                'role' => 1,
                'post_number' => 2569001,
                'address' => '愛知県高橋市東区江古田町村山3-3-9',
                'created_at' => '2021/01/02 11:11:11'
            ],
            [
                'name' => 'test2',
                'email' => 'test2@test.com',
                'password' => Hash::make('password123'),
                'role' => 2,
                'post_number' => 8168613,
                'address' => '群馬県杉山市西区廣川町伊藤7-6-1',
                'created_at' => '2021/01/03 11:11:11'
            ],
            [
                'name' => 'test3',
                'email' => 'test3@test.com',
                'password' => Hash::make('password123'),
                'role' => 2,
                'post_number' => 5425593,
                'address' => '三重県青山市北区加藤町中村2-4-7 ハイツ山本107号',
                'created_at' => '2021/01/04 11:11:11'
            ],
            [
                'name' => 'test4',
                'email' => 'test4@test.com',
                'password' => Hash::make('password123'),
                'role' => 2,
                'post_number' => 7881698,
                'address' => '香川県井高市西区原田町坂本8-2-2 コーポ近藤109号',
                'created_at' => '2021/01/05 11:11:11'
            ],
            [
                'name' => 'test5',
                'email' => 'test5@test.com',
                'password' => Hash::make('password123'),
                'role' => 2,
                'post_number' => 4941407,
                'address' => '茨城県鈴木市東区木村町西之園9-7-6',
                'created_at' => '2021/01/06 11:11:11'
            ],
            [
                'name' => 'test6',
                'email' => 'test6@test.com',
                'password' => Hash::make('password123'),
                'role' => 2,
                'post_number' => 7127191,
                'address' => '広島県原田市南区山岸町宮沢8-4-6 コーポ山本108号',
                'created_at' => '2021/01/07 11:11:11'
            ]
        ]);
    }
}
