# Library Management System

Aplikasi manajemen perpustakaan berbasis Laravel dengan fitur authentication untuk mengelola peminjaman buku, anggota, dan inventaris.

## 📋 Requirements

-   **PHP 8.2+** (disarankan PHP 8.2)
-   **Composer** (PHP package manager)
-   **MySQL 8.0+** (atau MariaDB)
-   **Node.js 18+** & **NPM** (untuk assets frontend)

## 🚀 Quick Start

### 1. Clone Repository

```bash
git clone https://github.com/senshiner/library.git
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
```

### 4. Setup Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Konfigurasi Database

#### A. Buat Database di MySQL

```sql
CREATE DATABASE library_db;
```

#### B. Edit File .env

Buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 6. Setup Database

```bash
# Jalankan migrations dan seeder
php artisan migrate --seed
```

### 7. Build Frontend Assets (Optional)

```bash
# Untuk development
npm run dev

# Atau untuk production
npm run build
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

## 🔧 Common Commands

### Reset Database

```bash
php artisan migrate:fresh --seed
```

### Create New Migration

```bash
php artisan make:migration create_table_name
```

### Run Seeder Only

```bash
php artisan db:seed
```

### Authentication (Laravel Breeze)

```bash
# Publish authentication views (sudah dilakukan)
php artisan breeze:install
```

## 🐛 Troubleshooting

### Error: "Class not found"

```bash
composer dump-autoload
```

### Error: "No application encryption key"

```bash
php artisan key:generate
```

### Error: "Foreign key constraint fails"

```bash
php artisan db:seed
```

### Error: "Authentication views not working"

```bash
php artisan optimize:clear
php artisan view:clear
```

## 🗂️ Project Structure

```
app/
├── Http/Controllers/     # Controllers untuk books, members, borrows
├── Models/              # Eloquent models
└── Providers/
resources/
├── views/              # Blade templates
│   ├── books/          # Halaman buku
│   ├── members/        # Halaman anggota
│   ├── borrows/        # Halaman peminjaman
│   └── layouts/        # Layout components
└── js/                 # JavaScript files
```
