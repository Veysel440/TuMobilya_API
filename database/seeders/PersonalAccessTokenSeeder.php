<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

class PersonalAccessTokenSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('email', 'admin@tumobilya.com')->first();
        if ($user) {
            PersonalAccessToken::create([
                'tokenable_type' => User::class,
                'tokenable_id' => $user->id,
                'name' => 'auth_token',
                'token' => hash('sha256', 'example-token'),
                'abilities' => ['*'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
