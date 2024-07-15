<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Mean;
use App\Models\PublicSession;
use App\Models\Spending;
use App\Models\SpendingMean;
use App\Models\SpendingSupplier;
use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpendingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::all()->each(function ($client) {
            Spending::factory(3)->create(['client_id' => $client->id]);
        });
    }
}
