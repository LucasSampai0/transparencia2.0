<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Client;
use App\Models\Mean;
use App\Models\MeanAttachment;
use App\Models\PublicSession;
use App\Models\Spending;
use App\Models\Supplier;
use App\Models\SupplierAttachment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Lucas | Arkus',
            'email' => 'lucas.bueno@arkus.com.br',
            'password' => '@Rkus142536',
            'is_admin' => true
        ]);

        Client::factory(1)->create();

        Category::factory(5)->create();

        $clients = Client::all();

        $clients->each(function ($client) {
            PublicSession::factory(15)->create(['client_id' => $client->id]);
            $means = Mean::factory(15)->create(['client_id' => $client->id]);
            $suppliers = Supplier::factory(15)->create(['client_id' => $client->id]);
            Spending::factory(15)->create(['client_id' => $client->id, 'type' => 'spending_mean']);
            Spending::factory(15)->create(['client_id' => $client->id, 'type' => 'spending_supplier']);

            $means->each(function ($mean) {
                MeanAttachment::factory(15)->create(['mean_id' => $mean->id]);
            });

            $suppliers->each(function ($supplier) {
                SupplierAttachment::factory(15)->create(['supplier_id' => $supplier->id]);
            });
        });


    }
}
