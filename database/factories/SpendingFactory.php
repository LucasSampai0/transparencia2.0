<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Client;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spending>
 */
class SpendingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'total' => $this->faker->randomFloat(2, 0, 999999),
            'category_id' => Category::factory(),
            'client_id' => Client::factory(),
            'supplier_id' => Supplier::factory(),
            //random between spending_supplier and spending_mean
            'type' => $this->faker->randomElement(['spending_supplier', 'spending_mean'])

        ];
    }
}
