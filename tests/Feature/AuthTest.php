<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase {
    use RefreshDatabase;

    protected function setUp(): void {
        parent::setUp();
        $this->seed(\Database\Seeders\TestDatabaseSeeder::class); // Seed test data
    }

    public function test_user_can_login() {
        $user = User::where('email', 'admin@example.com')->first();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password' // Assuming 'password' is set in the seeder
        ]);

        $response->assertStatus(200)->assertJsonStructure([
            'access_token', 'token_type'
        ]);
    }

    public function test_user_cannot_login_with_invalid_credentials() {
        $response = $this->postJson('/api/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'invalidpassword'
        ]);

        $response->assertStatus(401)->assertJson([
            'message' => 'Invalid login credentials'
        ]);
    }


    public function test_user_can_logout() {
        $user = User::where('email', 'admin@example.com')->first();
        $token = $user->createToken('test_token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/logout');

        $response->assertStatus(200)->assertJson([
            'message' => 'Logged out successfully'
        ]);
    }
}
