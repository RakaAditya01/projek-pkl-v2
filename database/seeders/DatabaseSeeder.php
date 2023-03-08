<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('12345678'),
            'pswrd' => Hash::make('12345678'),
            'expired_at' => now()->addMonths(9),
            'role' => 'admin',
            'nim' => '12345678'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'pswrd' => Hash::make('12345678'),
            'expired_at' => now()->addMonths(9),
            'role' => 'mahasiswa',
            'nim' => '09876543'
        ]);
    }
}
