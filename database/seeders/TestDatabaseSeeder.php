<?php

// database/seeders/TestDatabaseSeeder.php

namespace Database\Seeders;

use App\Models\DeliveryTruck;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\User;
use App\Models\Client;
use App\Models\Location;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class TestDatabaseSeeder extends Seeder {
    public function run() {
        // Create a company
        $company = Company::factory()->create([
            'name' => 'Test Fuel Delivery Co.',
            'domain' => 'testfuel.example.com',
        ]);

        // Create users for the company (admin and regular user)
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'company_id' => $company->id,
        ]);

        $user = User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'company_id' => $company->id,
        ]);

        // Create clients for the company
        $client1 = Client::factory()->create([
            'name' => 'Client One',
            'address' => 'addss',
            'phone' => '123-456-7890',
            'company_id' => $company->id,
        ]);

        $client2 = Client::factory()->create([
            'name' => 'Client Two',
            'address' => 'addss',
            'phone' => '098-765-4321',
            'company_id' => $company->id,
        ]);

        // Create locations for the clients
        $location1 = Location::factory()->create([
            'client_id' => $client1->id,
            'address_line1' => '123 Main St',
            'city' => 'Springfield',
            'state' => 'IL',
            'zip_code' => '62701',
            'country' => 'USA',
        ]);

        $location2 = Location::factory()->create([
            'client_id' => $client2->id,
            'address_line1' => '456 Elm St',
            'city' => 'Springfield',
            'state' => 'IL',
            'zip_code' => '62702',
            'country' => 'USA',
        ]);

        DeliveryTruck::factory()->count(5)->create();

        // Create orders for each client
        Order::factory()->create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'client_id' => $client1->id,
            'location_id' => $location1->id,
            'fuel_amount' => 500,
            'delivery_address' => '123 Main St',
            'status' => 'pending',
        ]);

        Order::factory()->create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'client_id' => $client2->id,
            'location_id' => $location2->id,
            'fuel_amount' => 1000,
            'delivery_address' => '456 Elm St',
            'status' => 'completed',
        ]);
    }
}
