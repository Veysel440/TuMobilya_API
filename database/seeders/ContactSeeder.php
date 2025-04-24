<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        Contact::create([
            'first_name' => 'Ahmet',
            'last_name' => 'Yılmaz',
            'email' => 'ahmet.yilmaz@example.com',
            'message' => 'Koltuk takımı hakkında bilgi almak istiyorum.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Contact::create([
            'first_name' => 'Ayşe',
            'last_name' => 'Kaya',
            'email' => 'ayse.kaya@example.com',
            'message' => 'Yemek masası teslimat süresi nedir?',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
