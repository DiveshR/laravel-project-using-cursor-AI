<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        // Create 50 random clients
        Client::factory(50)->create();

        // Create a test client
        Client::factory()->create([
            'name' => 'Test Client',
            'client_code' => 'CL-TEST001',
            'organisation_name' => 'Test Organization',
            'email' => 'testclient@example.com',
            'status' => 'active',
        ]);
    }
} 