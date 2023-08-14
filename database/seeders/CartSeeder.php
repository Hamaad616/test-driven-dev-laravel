<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cart::create([
            'product_id' => 'PS3',
            'quantity' => 2
        ]);

        Cart::create([
            'product_id' => 'PC1',
            'quantity' => 1
        ]);
    }
}
