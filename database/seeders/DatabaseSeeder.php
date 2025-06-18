<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Seller; 
use App\Models\Product;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Missing Person',
            'username' => 'Missing Person',
            'balance' => 0,
            'email' => 'missing@person.wo',
            'password' => Hash::make('missing'),
        ]);
        Seller::create([
            'id' => 1,
            'shopname' => 'Deleted Seller',
            'user_id' => 1,
        ]);
        Category::create([
            'id' => 1,
            'name' => 'Missing Category'
        ]);
        Product::create([
            'id' => 1,
            'name' => 'Deleted Product',
            'seller_id' => 1,
            'category_id' => 1,
            'price' => 1,
            'stock' => 0,
            'min_stock' => 0,
        ]);
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            SellerSeeder::class,
            ProductSeeder::class,
        ]);

    }
}
