<?php

// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    public function run() {
        User::create([
            'name' => 'Admin A',
            'email' => 'adminA@example.com',
            'password' => Hash::make('password123'),
            'company_id' => 1,
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Admin B',
            'email' => 'adminB@example.com',
            'password' => Hash::make('password123'),
            'company_id' => 2,
            'role' => 'admin'
        ]);
    }
}
