<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublicSession>
 */
class PublicSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->text(300),
            'date' => $this->faker->date,
            'time' => $this->faker->time,
            'client_id' => Client::factory(),
            'attachment' => $this->faker->image('storage/app/public/attachments/', 50, 50, null, false),
        ];
    }
}
