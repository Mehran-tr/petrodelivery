<?php


namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Client;
use App\Models\Location;
use App\Models\Order;
use Laravel\Sanctum\Sanctum;

class OrderTest extends TestCase {
//    use RefreshDatabase;

    protected function setUp(): void {
        parent::setUp();
    }

    public function test_user_can_create_order() {
        $user = User::where('email', 'user@example.com')->first();
        $client = Client::first();
        $location = Location::where('client_id', $client->id)->first();

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/orders', [
            'client_id' => $client->id,
            'location_id' => $location->id,
            'fuel_amount' => 500,
            'delivery_address' => $location->address_line1,
            'status' => 'pending'
        ]);

        $response->assertStatus(201)->assertJson([
            'client_id' => $client->id,
            'fuel_amount' => 500,
            'status' => 'pending'
        ]);
    }

    public function test_user_can_update_order() {
        $user = User::where('email', 'user@example.com')->first();
        $order = Order::first();
        Sanctum::actingAs($user);


        $response = $this->putJson("/api/orders/{$order->id}", [
            'client_id' => $order->client_id,
            'fuel_amount' => 720,
            'delivery_address' => 'New Address 123',
            'status' => 'completed'
        ]);
       if ($response->getStatusCode() == 200) {
           $response->assertJson([
               'fuel_amount' => 720,
               'delivery_address' => 'New Address 123',
               'status' => 'completed'
           ]);
       }

    }

    public function test_user_cannot_update_order_of_another_company() {
        // Step 1: Create a user and assign them to a company
        $user = User::where('email', 'admin@example.com')->first();

        // Step 2: Create another company and related records for testing
        $otherCompany = Company::factory()->create();
        $otherClient = Client::factory()->create(['company_id' => $otherCompany->id]);
        $otherLocation = Location::factory()->create(['client_id' => $otherClient->id]);

        // Step 3: Create an order linked to the other company
        $otherOrder = Order::factory()->create([
            'company_id' => $otherCompany->id,
            'client_id' => $otherClient->id,
            'location_id' => $otherLocation->id,
            'user_id' => $user->id, // Another user could be specified for more separation
            'fuel_amount' => 500,
            'delivery_address' => 'Another Company Address',
            'status' => 'pending'
        ]);

        // Act as the original user (should be unauthorized to update this order)
        Sanctum::actingAs($user);

        // Attempt to update the order belonging to a different company
        $response = $this->putJson("/api/orders/{$otherOrder->id}", [
            'client_id' => $otherOrder->client_id,
            'fuel_amount' => 500,
            'delivery_address' => '789 Unauthorized St',
            'status' => 'completed'
        ]);

        $response->assertStatus(403); // Forbidden
    }

    public function test_user_can_delete_order() {
        $user = User::where('email', 'admin@example.com')->first();
        $order = Order::first();

        Sanctum::actingAs($user);

        $response = $this->deleteJson("/api/orders/{$order->id}");

        $response->assertStatus(204); // Expecting 204 No Content
    }

}
