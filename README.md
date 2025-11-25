# 📚 Library Management System

Sistem manajemen perpustakaan modern berbasis **Laravel 11** dengan fitur manajemen peminjaman buku yang lengkap.

## 📋 Requirements

-   **OS**: Windows 10+ atau Linux/macOS
-   **PHP**: 8.2+ (disarankan PHP 8.3)
-   **Composer**: Latest version
-   **MySQL**: 8.0+ (atau MariaDB)
-   **Node.js**: 18+ dengan NPM
-   **Git**: Untuk clone repository

---

## 🚀 Installation Guide (Windows)

### Step 1: Prerequisites Installation

#### A. Install PHP (Jika belum ada)

1. Download PHP dari [php.net](https://www.php.net/downloads.php) atau gunakan **XAMPP/Laragon**
2. **Recommended: Gunakan Laragon** (all-in-one solution):
    - Download dari [laragon.org](https://laragon.org/)
    - Install dan buka Laragon
    - PHP dan MySQL sudah included

#### B. Install Composer

1. Download dari [getcomposer.org](https://getcomposer.org/download/)
2. Jalankan installer dan ikuti petunjuk
3. Verify: Buka Command Prompt/PowerShell
    ```bash
    composer --version
    ```

#### C. Install Node.js & NPM

1. Download dari [nodejs.org](https://nodejs.org/)
2. Download versi LTS (Long Term Support)
3. Jalankan installer
4. Verify:
    ```bash
    node --version
    npm --version
    ```

#### D. (OPSIONAL) Install Git

1. Download dari [git-scm.com](https://git-scm.com/)
2. Jalankan installer dengan default settings
3. Verify:
    ```bash
    git --version
    ```

---

### Step 2: Clone Repository/Download Zip

Buka **Command Prompt** atau **PowerShell**, navigasi ke folder tempat ingin menyimpan project:

```bash
# Navigasi ke folder (contoh: Documents)
cd Documents

# Clone repository
git clone https://github.com/senshiner/library.git

# Masuk ke folder project
cd library-main
```

---

### Step 3: Install PHP Dependencies

```bash
composer install
```

> ⏳ Proses ini memakan waktu beberapa menit. Tunggu sampai selesai.

---

### Step 4: Install Frontend Dependencies

```bash
npm install
```

> ⏳ Ini juga memakan waktu. Silakan tunggu...

---

### Step 5: Setup Environment Configuration

#### A. Copy Environment File

```bash
# Windows Command Prompt
copy .env.example .env

# Atau di PowerShell
Copy-Item .env.example -Destination .env
```

#### B. Generate Application Key

```bash
php artisan key:generate
```

Pastikan output menunjukkan: ✅ `Application key set successfully`

---

### Step 6: Setup Database

#### A. Create Database di MySQL

**Option 1: Menggunakan phpMyAdmin (jika menggunakan XAMPP/Laragon)**

1. Buka browser → `http://localhost/phpmyadmin`
2. Login (default username: `root`, password: kosong)
3. Klik "New" untuk membuat database baru
4. Nama database: `library_db`
5. Klik "Create"

**Option 2: Menggunakan Command Line**

```bash
mysql -u root -p
```

```sql
CREATE DATABASE library_db;
EXIT;
```

#### B. Configure Database di File `.env`

Buka file `.env` (di root project) menggunakan text editor (Notepad++, VS Code, dll):

Cari dan ubah baris berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_db
DB_USERNAME=root
DB_PASSWORD=
```

Jika MySQL Anda menggunakan password, ubah baris `DB_PASSWORD` sesuai password Anda.

---

### Step 7: Run Database Migrations & Seeder

Seeding akan membuat tabel dan mengisi data dummy untuk testing:

```bash
php artisan migrate --seed
```

Jika sukses, Anda akan melihat output:

```
✓ Migration table created successfully
✓ Migrating: 2024_01_01_000000_create_users_table
✓ Migrating: 2024_01_01_000001_create_cache_table
... (lebih banyak migrations)
✓ Seeding: UserSeeder
✓ Seeding: CategorySeeder
✓ Seeding: BooksTableSeeder
... (lebih banyak seeders)
```

---

### Step 8: Build Frontend Assets

```bash
# Mode Development (dengan live reload)
npm run dev

# Mode Production (untuk deployment)
npm run build
```

Biarkan terminal ini tetap terbuka (jika menggunakan `npm run dev`).

---

### Step 9: Run Development Server

**Buka terminal baru** (jangan tutup terminal yang menjalankan `npm run dev`):

```bash
php artisan serve
```

Output akan menunjukkan:

```
Laravel development server started: http://127.0.0.1:8000
```

---

### Step 10: Access Application

Buka browser Anda dan navigasi ke:

```
http://localhost:8000
```

✅ **Aplikasi sudah siap digunakan!**

---

## 🛠️ Common Commands

### Development

```bash
# Start development server
php artisan serve

# Watch frontend changes (di terminal lain)
npm run dev
```

### Database

```bash
# Reset database (WARNING: menghapus semua data!)
php artisan migrate:fresh --seed

# Jalankan seeder saja
php artisan db:seed

# Buat migration baru
php artisan make:migration create_table_name
```

### Cache & Optimization

```bash
# Clear application cache
php artisan cache:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Optimize autoloader
composer dump-autoload
```

### Debugging

```bash
# Tinker REPL untuk testing queries
php artisan tinker

# Contoh: lihat semua users
> \App\Models\User::all()
```

---

## 🐛 Troubleshooting

### Error: "No application encryption key has been specified"

**Solution**:

```bash
php artisan key:generate
```

### Error: "Class not found" atau "Autoload issues"

**Solution**:

```bash
composer dump-autoload
```

### Error: "SQLSTATE[HY000]: General error: 1030 Got error..."

**Solution**:

-   Pastikan MySQL running
-   Jalankan migrations: `php artisan migrate`

### Error: "Route [profile.edit] not defined"

**Solution**:

```bash
php artisan route:clear
php artisan config:clear
```

### Error: "npm: command not found" (Windows)

**Solution**:

-   Pastikan Node.js sudah diinstall
-   Restart Command Prompt/PowerShell
-   Verify: `node --version`

### Port 8000 sudah digunakan

**Solution**:

```bash
# Gunakan port berbeda
php artisan serve --port=8001
```

### Database migration error

**Solution**:

```bash
# Reset database sepenuhnya
php artisan migrate:fresh --seed
```

---

## 🔒 Security Notes

-   ⚠️ **NEVER commit `.env` file** ke repository (sudah di `.gitignore`)
-   🔐 Ubah `APP_KEY` jika merasa terekspos
-   🛡️ Gunakan password yang kuat untuk database production
-   📝 Log file tersimpan di `storage/logs/`

---

## 📦 Dependencies

### PHP (Composer)

-   **laravel/framework**: Web framework
-   **laravel/breeze**: Authentication scaffold
-   **laravel/tinker**: Interactive shell
-   **pestphp/pest**: Testing framework

### Frontend (NPM)

-   **tailwindcss**: Utility-first CSS framework
-   **alpinejs**: Lightweight JavaScript framework
-   **vite**: Modern bundler

---

## 🤝 Contributing

Untuk berkontribusi:

1. Fork repository
2. Create branch: `git checkout -b feature/NamaFitur`
3. Commit changes: `git commit -m 'Tambah fitur XYZ'`
4. Push ke branch: `git push origin feature/NamaFitur`
5. Submit Pull Request

---

## 📄 License

Proyek ini menggunakan **MIT License**. Bebas digunakan untuk keperluan komersial maupun pribadi.

---

**Last Updated**: November 25, 2025
**Laravel Version**: 11.0+
**PHP Version**: 8.2+
