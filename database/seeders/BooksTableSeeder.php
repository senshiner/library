<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    public function run(): void
    {
        if (Book::count() === 0) {
            $faker = Faker::create('id_ID');
            
            // Real book titles with fake data (author, publisher, quantity)
            $realBooks = [
                ['title' => 'Laskar Pelangi', 'category_id' => 1],
                ['title' => 'Bumi Manusia', 'category_id' => 1],
                ['title' => 'Filosofi Teras', 'category_id' => 2],
                ['title' => 'Sapiens', 'category_id' => 4],
                ['title' => 'Negeri 5 Menara', 'category_id' => 1],
                ['title' => 'Dilan 1990', 'category_id' => 1],
                ['title' => 'Matahari', 'category_id' => 1],
                ['title' => 'Hujan', 'category_id' => 1],
                ['title' => 'Pulang', 'category_id' => 1],
                ['title' => 'Rantau 1 Muara', 'category_id' => 1],
                ['title' => 'Atomic Habits', 'category_id' => 2],
                ['title' => 'Thinking Fast and Slow', 'category_id' => 2],
                ['title' => 'Educated', 'category_id' => 4],
                ['title' => 'Becoming', 'category_id' => 4],
                ['title' => 'The Book Thief', 'category_id' => 1],
                ['title' => 'All the Light We Cannot See', 'category_id' => 1],
                ['title' => 'The Midnight Library', 'category_id' => 1],
                ['title' => 'Verity', 'category_id' => 1],
                ['title' => 'It Ends with Us', 'category_id' => 1],
                ['title' => 'Circe', 'category_id' => 1],
                ['title' => 'Project Hail Mary', 'category_id' => 3],
                ['title' => 'Dune', 'category_id' => 3],
                ['title' => 'Foundation', 'category_id' => 3],
                ['title' => 'Neuromancer', 'category_id' => 3],
                ['title' => 'The Left Hand of Darkness', 'category_id' => 3],
                ['title' => 'Hyperion', 'category_id' => 3],
                ['title' => 'Guns, Germs, and Steel', 'category_id' => 4],
                ['title' => 'Grit', 'category_id' => 2],
                ['title' => 'Mindset', 'category_id' => 2],
                ['title' => 'Outliers', 'category_id' => 4],
                ['title' => 'A Brief History of Time', 'category_id' => 4],
                ['title' => 'Cosmos', 'category_id' => 4],
            ];

            $publishers = [
                'Gramedia', 'Bentang Pustaka', 'Kompas', 'Gajah Mada University Press',
                'Mizan', 'Falcon', 'Elex Media', 'Erlangga', 'Kepustakaan Populer Gramedia',
                'Penguin', 'HarperCollins', 'Simon & Schuster', 'Random House', 'Hachette',
            ];

            $categoryIds = Category::pluck('id')->toArray();

            foreach ($realBooks as $idx => $bookData) {
                Book::create([
                    'title' => $bookData['title'],
                    'author' => $faker->name(),
                    'isbn' => $faker->unique()->isbn13(false),
                    'description' => $faker->sentence(10),
                    'quantity' => $faker->numberBetween(2, 15),
                    'available' => $faker->numberBetween(0, 10),
                    'published_year' => $faker->year(),
                    'publisher' => $faker->randomElement($publishers),
                    'category_id' => $bookData['category_id'],
                ]);
            }
        }
    }
}
