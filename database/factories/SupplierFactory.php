<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'cnpj' => $this->faker->numerify('##.###.###/####-##'),
            'category_id' => Category::factory(),
            'client_id' => Client::factory(),
        ];
    }
}
