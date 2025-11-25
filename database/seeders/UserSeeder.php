<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update admin user
        User::updateOrCreate(
            ['email' => 'admin@library.local'],
            [
                'name' => 'Admin Library',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create or update member user 1
        User::updateOrCreate(
            ['email' => 'john@library.local'],
            [
                'name' => 'John Member',
                'password' => Hash::make('password'),
                'role' => 'member',
            ]
        );

        // Create or update member user 2
        User::updateOrCreate(
            ['email' => 'jane@library.local'],
            [
                'name' => 'Jane Member',
                'password' => Hash::make('password'),
                'role' => 'member',
            ]
        );
    }
}
