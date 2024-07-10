<?php

namespace Database\Factories;

use App\Models\Mean;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MeanAttachment>
 */
class MeanAttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,
            'file' => $this->faker->image('storage/app/public/attachments/', 50, 50, null, false),
            'mean_id' => Mean::factory(),
        ];
    }
}
