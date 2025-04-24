<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::create([
            'title' => 'Ana Sayfa',
            'url' => '/',
            'page_description' => 'TuMobilya ana sayfası',
            'page_title' => 'Hoş Geldiniz',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Menu::create([
            'title' => 'Ürünler',
            'url' => '/products',
            'page_description' => 'Tüm mobilya ürünlerimiz',
            'page_title' => 'Ürünlerimiz',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
