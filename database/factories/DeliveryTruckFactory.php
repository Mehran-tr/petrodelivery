<?php

// database/factories/DeliveryTruckFactory.php

namespace Database\Factories;

use App\Models\DeliveryTruck;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryTruckFactory extends Factory {
    protected $model = DeliveryTruck::class;

    public function definition() {
        return [
            'license_plate' => strtoupper($this->faker->bothify('???-####')),
            'model' => $this->faker->randomElement(['Model A', 'Model B', 'Model C']),
            'driver_name' => $this->faker->name,
            'company_id' => Company::factory(), // Link to a Company model
        ];
    }
}
