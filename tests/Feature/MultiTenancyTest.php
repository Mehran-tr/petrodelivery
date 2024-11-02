<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use App\Models\Client;
use Laravel\Sanctum\Sanctum;

class MultiTenancyTest extends TestCase {
    use RefreshDatabase;

    public function test_user_cannot_access_clients_of_other_companies() {
        $companyA = Company::factory()->create();
        $companyB = Company::factory()->create();

        $userA = User::factory()->create(['company_id' => $companyA->id]);
        $clientB = Client::factory()->create(['company_id' => $companyB->id]);

        Sanctum::actingAs($userA);

        $response = $this->getJson("/api/clients/{$clientB->id}");

        $response->assertStatus(403);
    }
}
