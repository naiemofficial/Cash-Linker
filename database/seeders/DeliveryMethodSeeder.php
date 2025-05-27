<?php

namespace Database\Seeders;

use App\Models\DeliveryMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryMethod::create([
            'name'  => 'Inside Dhaka',
            'cost'  => 60,
        ]);

        DeliveryMethod::create([
            'name'  => 'Outside Dhaka',
            'cost'  => 120,
        ]);
    }
}
