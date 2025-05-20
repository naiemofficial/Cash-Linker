<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::create(['name' => 'administrator', 'permissions' => json_encode(['*'])]);
        UserRole::create(['name' => 'customer', 'permissions' => json_encode(['view_products', 'place_orders'])]);
    }
}
