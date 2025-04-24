<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run()
    {
        Setting::create([
            'phone' => '+90 555 123 45 67',
            'email' => 'info@tumobilya.com',
            'address' => 'Mobilya Sokak No:123, İstanbul, Türkiye',
            'short_address' => 'İstanbul, Türkiye',
            'facebook' => 'https://facebook.com/tumobilya',
            'twitter' => 'https://twitter.com/tumobilya',
            'instagram' => 'https://instagram.com/tumobilya',
            'youtube' => 'https://youtube.com/tumobilya',
            'general_title' => 'TuMobilya - Kaliteli Mobilyalar',
            'general_description' => 'Evlerinize şıklık ve konfor katan mobilya çözümleri.',
            'general_photo' => 'logo.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
