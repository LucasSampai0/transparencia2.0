<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Usuário 2',
            'email' => 'sandro.oliveira@arkus.com.br',
            'password' => 'password',
            'is_admin' => true
        ]);
    }
}
