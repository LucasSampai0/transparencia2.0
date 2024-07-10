<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Client;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpendingSupplier>
 */
class SpendingSupplierFactory extends Factory
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
            'total' => $this->faker->randomFloat(2, 0, 1000),
            'category_id' => Category::all()->random()->id,
            'client_id' => Client::all()->random()->id,
            'supplier_id' => Supplier::all()->random()->id,
        ];
    }
}
