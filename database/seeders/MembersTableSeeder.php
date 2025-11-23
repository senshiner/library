<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    public function run(): void
    {
        if (Member::count() === 0) {
            $members = [
                [
                    'name' => 'Ahmad Santoso',
                    'email' => 'ahmad.santoso@email.com',
                    'phone' => '081234567890',
                    'address' => 'Jl. Merdeka No. 123, Jakarta',
                    'join_date' => '2023-01-15',
                    'status' => 'active',
                ],
                [
                    'name' => 'Siti Rahayu',
                    'email' => 'siti.rahayu@email.com', 
                    'phone' => '081298765432',
                    'address' => 'Jl. Sudirman No. 45, Bandung',
                    'join_date' => '2023-03-20',
                    'status' => 'active',
                ],
                [
                    'name' => 'Budi Pratama',
                    'email' => 'budi.pratama@email.com',
                    'phone' => '081112223344',
                    'address' => 'Jl. Gatot Subroto No. 67, Surabaya',
                    'join_date' => '2022-11-10',
                    'status' => 'inactive',
                ],
            ];

            foreach ($members as $member) {
                Member::create($member);
            }
        }
    }
}
