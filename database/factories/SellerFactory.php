<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Seller;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Seller::class;
    
    public function definition(): array
    {
        $id = User::inRandomOrder()->first()->id;
        while($id == 1){
            $id = User::inRandomOrder()->first()->id;
        }
        return [
            'user_id' => $id ?? User::factory()->create()->id,
            'shopname' => fake()->unique()->company(),
        ];
    }
}
