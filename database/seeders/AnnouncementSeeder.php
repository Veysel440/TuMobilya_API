<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        Announcement::create([
            'title' => 'Yeni Mağaza Açılışı',
            'description' => 'İstanbul’daki yeni mağazamızı ziyaret edin!',
            'image' => 'announcement1.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Announcement::create([
            'title' => 'Yıl Sonu Kampanyası',
            'description' => 'Tüm ürünlerde özel indirimler!',
            'image' => 'announcement2.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
