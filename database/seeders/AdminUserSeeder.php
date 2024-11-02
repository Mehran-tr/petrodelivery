<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder {
    public function run() {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Make sure to change this in production
            'role' => User::ROLE_ADMIN,              // Assign admin role
            'company_id' => null,                    // Set to null since admin doesn't belong to a specific company
        ]);
    }
}
