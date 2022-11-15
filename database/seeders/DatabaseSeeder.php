<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\chat_user;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         \App\Models\Chat::factory(10)->create()->each(function ($chat) {
             $chat->users()->saveMany(\App\Models\User::factory(2)->create());
         });

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'username' => 'testuser',
             'email_verified_at' => now(),
             'is_admin' => true,
             'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
             'remember_token' => Str::random(10),
         ]);


    }
}
