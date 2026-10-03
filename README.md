# Perpustakaan

Sistem manajemen perpustakaan berbasis Laravel 11 — kelola katalog buku, anggota, dan peminjaman dalam satu dasbor.

![Perpustakaan](docs/banner.webp)

## Fitur

- **Katalog buku** — CRUD buku lengkap dengan kategori, stok, dan pencarian judul/pengarang
- **Peminjaman** — catat pinjam/kembali dan lacak status (dipinjam, terlambat, dikembalikan)
- **Anggota** — manajemen data anggota perpustakaan
- **Dasbor** — ringkasan statistik: total buku, anggota, peminjaman aktif
- **Autentikasi** — login/register berbasis Laravel Breeze
- **UI neo-brutalist** — Tailwind + Alpine.js, responsif untuk desktop dan HP

## Teknologi

- Laravel 11, PHP 8.2+
- MySQL / MariaDB
- Tailwind CSS, Alpine.js, Vite
- Pest (testing)

## Menjalankan

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

# sesuaikan DB_* di .env, lalu:
php artisan migrate --seed

npm run dev        # terminal 1
php artisan serve  # terminal 2 → http://localhost:8000
```

Untuk produksi: `npm run build` sebelum `php artisan serve`.

## Perintah Berguna

```bash
php artisan migrate:fresh --seed   # reset database + data contoh
php artisan test                   # jalankan test suite
```

## Lisensi

MIT
