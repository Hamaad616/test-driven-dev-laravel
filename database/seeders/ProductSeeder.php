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
            'code' => 'PS3',
            'name' => 'Pesticide Spray',
            'price' => number_format(8, 2)
        ]);

        Product::create([
            'code' => 'PC1',
            'name' => 'Pesticide Chemical',
            'price' => number_format(12, 2)
        ]);
    }
}
