<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Client;
use App\Models\SpendingMean;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpendingMean>
 */
class SpendingMeanFactory extends SpendingFactory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = SpendingMean::class;

    public function definition(): array
    {
        return array_merge(parent::definition(), [
            'type' => 'spending_mean',
        ]);
    }
}
