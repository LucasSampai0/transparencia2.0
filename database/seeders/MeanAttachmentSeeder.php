<?php

namespace Database\Seeders;

use App\Models\Mean;
use App\Models\MeanAttachment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeanAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mean::class::all()->each(function ($mean) {
            MeanAttachment::factory(5)->create(['mean_id' => $mean->id]);
        });
    }
}
