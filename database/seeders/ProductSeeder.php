<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Modern Koltuk Takımı',
            'image' => 'koltuk-takimi.jpg',
            'price' => 4999.99,
            'product_details' => 'Rahat ve şık bir koltuk takımı, gri kumaş kaplama.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Product::create([
            'name' => 'Ahşap Yemek Masası',
            'image' => 'yemek-masasi.jpg',
            'price' => 2999.50,
            'product_details' => '6 kişilik doğal ahşap yemek masası.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
