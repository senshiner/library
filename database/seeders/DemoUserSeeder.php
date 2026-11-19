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
            ['email' => 'demo@example.com'],
            [
                'name' => 'Demo Admin',
                'password' => Hash::make('password123'),
                // Dashboard memakai middleware 'verified', jadi akun demo
                // harus terverifikasi agar bisa langsung masuk.
                'email_verified_at' => now(),
            ]
        );
    }
}
