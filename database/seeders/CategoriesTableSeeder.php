<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiksi', 'description' => 'Buku fiksi dan novel'],
            ['name' => 'Non-Fiksi', 'description' => 'Buku non-fiksi dan referensi'],
            ['name' => 'Sains & Teknologi', 'description' => 'Buku sains, teknologi, dan komputer'],
            ['name' => 'Sejarah', 'description' => 'Buku sejarah dan biografi'],
            ['name' => 'Pendidikan', 'description' => 'Buku pendidikan dan pelajaran'],
            ['name' => 'Agama', 'description' => 'Buku agama dan spiritual'],
            ['name' => 'Anak-anak', 'description' => 'Buku cerita anak-anak'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
