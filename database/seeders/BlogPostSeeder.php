<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogPost;

class BlogPostSeeder extends Seeder
{
    public function run()
    {
        BlogPost::create([
            'title' => 'Mobilya Seçiminde 5 İpucu',
            'content' => 'Eviniz için doğru mobilyayı seçerken dikkat etmeniz gerekenler...',
            'image' => 'blog1.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        BlogPost::create([
            'title' => 'Minimalist Dekorasyon Trendleri',
            'content' => 'Az ama öz: Minimalist dekorasyonun püf noktaları.',
            'image' => 'blog2.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
