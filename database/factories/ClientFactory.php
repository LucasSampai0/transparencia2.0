<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'logo' => $this->faker->image('storage/app/public/logos/', 50, 50, null, false),
            'name' => $this->faker->name,
            'cnpj' => $this->faker->numerify('##.###.###/####-##'),
            'address' => $this->faker->address,
            'slug' => $this->faker->slug,
        ];
    }
}
