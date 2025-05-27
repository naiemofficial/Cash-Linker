<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create([
            'logo'          => url('/assets/images/logo/bKash-logo.png'),
            'name'          => 'bKash',
            'type'          => 'mfs',
            'category'      => 'merchant',
            'account_no'    => '01700000000',
            'account_name'  => 'Money Commerce',
        ]);

        PaymentMethod::create([
            'logo'          => url('/assets/images/logo/Nagad-logo.png'),
            'name'          => 'Nagad',
            'type'          => 'mfs',
            'category'      => 'personal',
            'account_no'    => '01300000000',
            'account_name'  => 'Anonymous',
        ]);
    }
}
