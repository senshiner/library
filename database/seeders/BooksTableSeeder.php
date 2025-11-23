<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    public function run(): void
    {
        if (Book::count() === 0) {
            $books = [
                [
                    'title' => 'Laskar Pelangi',
                    'author' => 'Andrea Hirata',
                    'isbn' => '9789793062791',
                    'description' => 'Kisah persahabatan anak-anak di Belitung',
                    'quantity' => 5,
                    'available' => 5,
                    'published_year' => 2005,
                    'publisher' => 'Bentang Pustaka',
                    'category_id' => 1
                ],
                [
                    'title' => 'Bumi Manusia',
                    'author' => 'Pramoedya Ananta Toer',
                    'isbn' => '9789799731231',
                    'description' => 'Novel sejarah tentang masa kolonial',
                    'quantity' => 3,
                    'available' => 3,
                    'published_year' => 1980,
                    'publisher' => 'Hasta Mitra',
                    'category_id' => 1
                ],
                [
                    'title' => 'Filosofi Teras',
                    'author' => 'Henry Manampiring',
                    'isbn' => '9786024248106',
                    'description' => 'Filsafat Stoa untuk kehidupan modern',
                    'quantity' => 4,
                    'available' => 4,
                    'published_year' => 2018,
                    'publisher' => 'Kompas',
                    'category_id' => 2
                ],
                [
                    'title' => 'Sapiens',
                    'author' => 'Yuval Noah Harari',
                    'isbn' => '9780099590089',
                    'description' => 'Riwayat singkat umat manusia',
                    'quantity' => 2,
                    'available' => 2,
                    'published_year' => 2014,
                    'publisher' => 'Harvill Secker',
                    'category_id' => 4
                ],
            ];

            foreach ($books as $book) {
                Book::create($book);
            }
        }
    }
}
