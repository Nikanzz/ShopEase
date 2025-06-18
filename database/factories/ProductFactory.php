<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;

    public function definition(): array
    {
        $sid = Seller::inRandomOrder()->first()?->id;
        while($sid == 1){
            $sid = Seller::inRandomOrder()->first()?->id;
        }
        $cid = Category::inRandomOrder()->first()?->id;
        while($cid == 1){
            $cid = Category::inRandomOrder()->first()?->id;
        }
        return [
            'seller_id' => $sid ?? Seller::factory()->create()->id, 
            'category_id' => $cid ?? Category::factory()->create()->id,
            'name' => $this->faker->words(3, true), 
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10000, 1000000),
            'stock' => $this->faker->numberBetween(0, 100),
            'min_stock' => $this->faker->numberBetween(1, 10),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }
}
