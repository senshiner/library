# Perpustakaan

Sistem manajemen perpustakaan (Laravel 11 + Blade) — kelola katalog buku,
anggota, dan peminjaman dalam satu dasbor ber-UI neo-brutalist.

Repo: `senshiner/library` — branch aktif: **`main`** (Laravel).
Branch **`demo`** berisi versi demo frontend-only (tanpa database).

## Struktur

```
library/
├── app/               # Controllers, Models, Requests
├── config/            # Konfigurasi (database membaca POSTGRES_URL)
├── database/          # Migration, seeder, factory
├── public/            # Entry point + build assets
├── resources/views/   # Blade templates (Tailwind + Alpine.js)
├── routes/            # web.php, auth.php
├── demo/              # (branch demo) aplikasi demo frontend-only
├── .env.example       # Template env → salin ke .env
└── vercel.json        # Deploy Laravel via vercel-php
```

## Prasyarat

- PHP 8.2+
- Composer
- Node.js 20+
- Database: MySQL / PostgreSQL / SQLite

## Setup

### 1. Clone

```bash
git clone https://github.com/senshiner/library.git
cd library
```

### 2. Install

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

### 3. Database

Isi kredensial database di `.env` (lihat tabel Environment di bawah),
lalu:

```bash
php artisan migrate --seed   # tabel + data contoh
```

### 4. Jalan

```bash
npm run dev          # terminal 1 — Vite
php artisan serve    # terminal 2 — http://localhost:8000
```

Untuk produksi: `npm run build` sebelum serve.

**Jangan commit file `.env` asli!** (sudah di `.gitignore`)

## Environment

**`.env`** (salin dari `.env.example`):

| Key | Wajib | Keterangan |
|---|---|---|
| `APP_KEY` | Ya | Diisi otomatis oleh `php artisan key:generate` |
| `DB_CONNECTION` | Ya | `mysql` / `pgsql` / `sqlite` |
| `DB_HOST` / `DB_PORT` | Ya (kecuali sqlite) | Host & port database |
| `DB_DATABASE` / `DB_USERNAME` / `DB_PASSWORD` | Ya (kecuali sqlite) | Kredensial database |
| `DB_URL` | Tidak | URL database penuh; alternatif dari field terpisah |
| `POSTGRES_URL` | Tidak | Otomatis dipakai bila deploy dengan Vercel Postgres |

> Deploy di Vercel + Vercel Postgres: cukup connect database via dashboard
> Storage — `POSTGRES_URL` terbaca otomatis, tanpa set env manual.

## Fitur

- **Katalog buku** — CRUD lengkap dengan kategori; pencarian judul/pengarang
  dan pagination (12/halaman).
- **Peminjaman** — catat pinjam/kembali; status Terlambat dihitung otomatis
  dari tanggal jatuh tempo (bukan set manual).
- **Anggota** — CRUD anggota dengan status aktif/nonaktif.
- **Dasbor** — statistik total buku, anggota, peminjaman aktif, dan yang
  terlambat, plus feed peminjaman terbaru.
- **Autentikasi** — login/register via Laravel Breeze.
- **UI neo-brutalist** — Tailwind + Alpine.js, responsif.

## Mode Demo (tanpa database, tanpa login)

Branch `demo` berisi versi demo 100% frontend yang:

- **Tanpa database** — seluruh data (buku, anggota, peminjaman) tersimpan
  di localStorage browser masing-masing pengunjung.
- **Tanpa login** — buka langsung masuk dasbor.
- **Data contoh bawaan** — buku, anggota, dan peminjaman yang sama dengan
  seeder Laravel (termasuk 1 peminjaman terlambat untuk demo).
- **Tombol Reset Demo** — kembalikan data ke awal kapan saja.

Coba lokal:

```bash
git clone -b demo https://github.com/senshiner/library.git
cd library/demo
npx serve .   # atau buka index.html langsung
```

### Deploy ke Vercel

- Branch **`main`** (Laravel): `vercel.json` di root memakai runtime
  `vercel-php@0.7.3`; butuh database via env (`POSTGRES_URL` dsb).
- Branch **`demo`** (statis): `vercel.json` me-rewrite `/` ke
  `/demo/index.html` — **tidak butuh backend, database, atau env apa pun**.

## Tech Stack

Laravel 11 · PHP 8.2 · Blade · Tailwind CSS · Alpine.js · Vite ·
MySQL / PostgreSQL / SQLite · Pest.

## License

MIT
