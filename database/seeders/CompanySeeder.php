<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CompanySeeder extends Seeder {
    public function run() {
        Company::create(['name' => 'Fuel Company A', 'domain' => 'companyA.example.com']);
        Company::create(['name' => 'Fuel Company B', 'domain' => 'companyB.example.com']);
    }
}
