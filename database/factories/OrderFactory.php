<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\User;
use App\Models\Company;
use App\Models\Client;
use App\Models\Location;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Order::class;

    public function definition() {
        return [
            'user_id' => User::factory(), // Automatically create a user if not provided
            'company_id' => Company::factory(), // Automatically create a company if not provided
            'client_id' => Client::factory(), // Automatically create a client if not provided
            'location_id' => Location::factory(), // Automatically create a location if not provided
            'fuel_amount' => $this->faker->randomFloat(2, 100, 1000), // Random fuel amount
            'delivery_address' => $this->faker->address,
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']),
        ];
    }
}
