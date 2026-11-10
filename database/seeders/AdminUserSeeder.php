<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@eventplanner.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin@12345'),
                'role' => 'admin',
                'phone' => null,
                'profile_image' => null,
            ]
        );
    }
}
