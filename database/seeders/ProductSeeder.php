<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name'      => '1 Taka Note',
            'value'     => '1',
            'category'  => 'regular',
            'type'      => 'note',
            'price'     => 1,
            'commission' => 50,
            'image'     => url('/assets/images/money/1-Taka-Note.jpg'),
        ]);


        Product::create([
            'name'      => '2 Taka Note',
            'value'     => '2',
            'category'  => 'regular',
            'type'      => 'bundle',
            'price'    => 200,
            'commission' => 150,
            'image'     => url('/assets/images/money/2-Taka-Note.jpg'),
        ]);


        Product::create([
            'name'      => '10 Taka Note',
            'value'     => '10',
            'category'  => 'regular',
            'type'      => 'bundle',
            'price'    => 1000,
            'commission' => 200,
            'image'     => url('/assets/images/money/10-Taka-Note.jpg'),
        ]);


        Product::create([
            'name'      => '20 Taka Note',
            'value'     => '20',
            'category'  => 'regular',
            'type'      => 'bundle',
            'price'    => 2000,
            'commission' => 200,
            'image'     => url('/assets/images/money/20-Taka-Note.jpg'),
        ]);


        Product::create([
            'name'      => '50 Taka Note',
            'value'     => '50',
            'category'  => 'regular',
            'type'      => 'bundle',
            'price'    => 5000,
            'commission' => 200,
            'image'     => url('/assets/images/money/50-Taka-Note.jpg'),
        ]);


        Product::create([
            'name'      => '100 Taka Note',
            'value'     => '100',
            'category'  => 'regular',
            'type'      => 'note',
            'price'    => 100,
            'commission' => 20,
            'image'     => url('/assets/images/money/100-Taka-Note.jpg'),
        ]);


        Product::create([
            'name'      => '500 Taka Note',
            'value'     => '500',
            'category'  => 'regular',
            'type'      => 'note',
            'price'    => 500,
            'commission' => 10,
            'image'     => url('/assets/images/money/500-Taka-Note.jpg'),
        ]);


        Product::create([
            'name'      => '1000 Taka Note',
            'value'     => '1000',
            'category'  => 'regular',
            'type'      => 'note',
            'price'    => 1000,
            'commission' => 5,
            'image'     => url('/assets/images/money/1000-Taka-Note.jpg'),
        ]);
    }
}
