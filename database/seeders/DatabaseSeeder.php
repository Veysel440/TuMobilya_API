<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            MenuSeeder::class,
            SettingSeeder::class,
            ContactSeeder::class,
            SliderSeeder::class,
            BlogPostSeeder::class,
            AnnouncementSeeder::class,
            PersonalAccessTokenSeeder::class,
        ]);
    }
}
