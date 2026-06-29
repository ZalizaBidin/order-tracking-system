<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'customer@demo.com'],
            [
                'name' => 'Demo Customer',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ]
        );

        User::updateOrCreate(
            ['email' => 'shopper@demo.com'],
            [
                'name' => 'Demo Personal Shopper',
                'password' => Hash::make('password123'),
                'role' => 'shopper',
            ]
        );
    }
}
