<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
                    'cover' => 'covers/real-01.jpg',
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
                    'cover' => 'covers/real-02.jpg',
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
                    'cover' => 'covers/real-03.jpg',
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
                    'cover' => 'covers/real-04.jpg',
                    'quantity' => 2,
                    'available' => 2,
                    'published_year' => 2014,
                    'publisher' => 'Harvill Secker',
                    'category_id' => 4
                ],
                [
                    'title' => 'Ronggeng Dukuh Paruk',
                    'author' => 'Ahmad Tohari',
                    'description' => 'Kisah Srintil, penari ronggeng di Dukuh Paruk',
                    'cover' => 'covers/real-05.jpg',
                    'quantity' => 4,
                    'available' => 4,
                    'published_year' => 1982,
                    'publisher' => 'Gramedia Pustaka Utama',
                    'category_id' => 1
                ],
                [
                    'title' => 'Cantik Itu Luka',
                    'author' => 'Eka Kurniawan',
                    'description' => 'Saga keluarga di kota fiktif Halimunda',
                    'cover' => 'covers/real-06.jpg',
                    'quantity' => 3,
                    'available' => 3,
                    'published_year' => 2002,
                    'publisher' => 'Gramedia Pustaka Utama',
                    'category_id' => 1
                ],
                [
                    'title' => 'Atomic Habits',
                    'author' => 'James Clear',
                    'description' => 'Cara mudah membangun kebiasaan baik',
                    'cover' => 'covers/real-07.jpg',
                    'quantity' => 6,
                    'available' => 6,
                    'published_year' => 2019,
                    'publisher' => 'Gramedia Pustaka Utama',
                    'category_id' => 2
                ],
                [
                    'title' => 'Laut Bercerita',
                    'author' => 'Leila S. Chudori',
                    'description' => 'Novel tentang aktivis yang hilang di era Orde Baru',
                    'cover' => 'covers/real-08.jpg',
                    'quantity' => 4,
                    'available' => 4,
                    'published_year' => 2017,
                    'publisher' => 'Kepustakaan Populer Gramedia',
                    'category_id' => 1
                ],
                [
                    'title' => 'Bumi',
                    'author' => 'Tere Liye',
                    'description' => 'Petualangan Raib dan kawan-kawan di dunia paralel',
                    'cover' => 'covers/real-09.jpg',
                    'quantity' => 5,
                    'available' => 5,
                    'published_year' => 2014,
                    'publisher' => 'Gramedia Pustaka Utama',
                    'category_id' => 1
                ],
                [
                    'title' => 'Clean Code',
                    'author' => 'Robert C. Martin',
                    'description' => 'Panduan menulis kode yang bersih dan mudah dirawat',
                    'cover' => 'covers/real-10.jpg',
                    'quantity' => 2,
                    'available' => 2,
                    'published_year' => 2008,
                    'publisher' => 'Pearson',
                    'category_id' => 3
                ],
            ];

            foreach ($books as $book) {
                // Cover asli tersimpan di public/covers/ (ikut repo).
                // Salin ke disk public agar Storage::url() bisa menemukannya.
                if (! empty($book['cover'])) {
                    $source = public_path($book['cover']);
                    if (! Storage::disk('public')->exists($book['cover']) && file_exists($source)) {
                        Storage::disk('public')->put($book['cover'], file_get_contents($source));
                    }
                }

                Book::create($book);
            }
        }
    }
}
