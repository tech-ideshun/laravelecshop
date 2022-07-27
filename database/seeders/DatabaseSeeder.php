<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use App\Models\Contact;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call([
        // ]);
        // Product::factory(100)->create();
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            StockSeeder::class,
            PaymentSeeder::class,
            // OrderSeeder::class,
        ]);
        // Contact::factory(40)->create();
        // Order::factory(20)->create();
    }
}
