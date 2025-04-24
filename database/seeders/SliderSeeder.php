<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slider;

class SliderSeeder extends Seeder
{
    public function run()
    {
        Slider::create([
            'title' => 'Yeni Koleksiyon',
            'description' => '2025 mobilya koleksiyonumuzu keşfedin!',
            'image' => 'slider1.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Slider::create([
            'title' => 'İndirim Fırsatları',
            'description' => 'Seçili ürünlerde %30 indirim!',
            'image' => 'slider2.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
