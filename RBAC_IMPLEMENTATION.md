# Role-Based Access Control (RBAC) Implementation Guide

## Overview

Project ini sudah diimplementasikan dengan sistem role-based access control yang membedakan antara **Admin** dan **Member**.

---

## Roles & Permissions

### Admin Role

-   ✅ Full access ke semua fitur (Dashboard, Books, Members, Borrows)
-   ✅ Dapat membuat, edit, hapus kategori buku
-   ✅ Dapat membuat, edit, hapus data buku
-   ✅ Dapat mengelola data anggota
-   ✅ Dapat mengelola semua peminjaman (create, view, return)

### Member Role

-   ✅ Akses ke Dashboard (read-only)
-   ✅ Dapat melihat katalog buku (index & show)
-   ✅ Dapat membuat peminjaman buku (create borrow)
-   ❌ Tidak bisa mengelola data (edit/delete/create kategori & buku)
-   ❌ Tidak bisa melihat data anggota lain
-   ❌ Tidak bisa mengelola peminjaman (hanya create own)

---

## Test Credentials

Saat seeding, sudah dibuat 3 user otomatis untuk testing:

### Admin Account

```
Email: admin@library.local
Password: password
Role: Admin
```

### Member Account 1

```
Email: john@library.local
Password: password
Role: Member
```

### Member Account 2

```
Email: jane@library.local
Password: password
Role: Member
```

---

## Implementation Details

### 1. Database Changes

-   **Tabel users**: Ditambahkan kolom `role` (enum: 'admin', 'member', default: 'member')
-   **Migration file**: `database/migrations/2025_11_25_000000_add_role_to_users_table.php`

### 2. User Model (`app/Models/User.php`)

```php
// Helper methods untuk cek role
$user->isAdmin()   // return true jika admin
$user->isMember()  // return true jika member
```

### 3. Middleware (`app/Http/Middleware/CheckRole.php`)

-   Middleware `role` digunakan untuk protect routes
-   Syntax: `->middleware('role:admin')` atau `->middleware('role:member')`
-   Auto redirect ke login jika belum auth, abort 403 jika role tidak sesuai

### 4. Routes Protection (`routes/web.php`)

```php
// Admin routes - membutuhkan role 'admin'
Route::middleware(['auth', 'verified', 'role:admin'])->group(...);

// Member routes - membutuhkan role 'member'
Route::middleware(['auth', 'verified', 'role:member'])->group(...);
```

### 5. Navigation (`resources/views/layouts/navigation.blade.php`)

-   Navbar secara otomatis show/hide menu items berdasarkan role user yang login
-   Admin: Melihat "Books", "Members", "Borrowing"
-   Member: Melihat "Catalog", "Borrow Book"
-   Indikator role ditampilkan di dropdown user (👤 Admin atau 📚 Member)

### 6. Gates (`app/Providers/AppServiceProvider.php`)

```php
Gate::define('admin-only', ...)  // untuk authorization check
Gate::define('member-only', ...)
```

---

## Testing Guide

### Setup (jalankan sekali)

```bash
# 1. Install dependencies (jika belum)
composer install
npm install

# 2. Setup .env jika belum
cp .env.example .env
php artisan key:generate

# 3. Jalankan migration
php artisan migrate

# 4. Seed test data (admin + members)
php artisan db:seed --class=UserSeeder
```

### Running the App

```bash
# Terminal 1: Jalankan Laravel server
php artisan serve

# Terminal 2: Jalankan frontend dev server (opsional, jika perlu asset rebuild)
npm run dev
```

### Test Admin Access

1. Buka browser: `http://localhost:8000`
2. Login dengan:
    - Email: `admin@library.local`
    - Password: `password`
3. Verifikasi:
    - ✅ Dashboard tersedia
    - ✅ Menu "Books", "Members", "Borrowing" terlihat di navbar
    - ✅ Bisa akses semua halaman (create/edit/delete)
    - ✅ User dropdown menampilkan "👤 Admin"

### Test Member Access

1. Logout (atau buka incognito)
2. Login dengan:
    - Email: `john@library.local`
    - Password: `password`
3. Verifikasi:
    - ✅ Dashboard tersedia
    - ✅ Navbar hanya menampilkan "Catalog" dan "Borrow Book"
    - ✅ Tidak bisa akses `/books/create`, `/members`, `/categories`
    - ✅ Hanya bisa view buku (index & show)
    - ✅ Hanya bisa create peminjaman (borrow)
    - ✅ User dropdown menampilkan "📚 Member"
4. Coba akses admin-only route:
    - Buka: `http://localhost:8000/members`
    - Hasil: ❌ 403 Forbidden (Unauthorized access message)

### Test Forbidden Access

1. Sebagai member, coba akses:
    - `/books/create` → 403 Forbidden
    - `/members` → 403 Forbidden
    - `/borrows` → 403 Forbidden (hanya bisa `/borrows/create` dan `POST`)

---

## Advanced: Add New Admin User

Jika ingin menambah user admin baru via command:

```bash
php artisan tinker
```

Kemudian di tinker shell:

```php
App\Models\User::create([
    'name' => 'New Admin',
    'email' => 'newadmin@library.local',
    'password' => Hash::make('password'),
    'role' => 'admin',
]);
exit;
```

---

## Advanced: Change User Role

Untuk mengubah role user yang sudah ada:

```bash
php artisan tinker
```

Di tinker shell:

```php
$user = App\Models\User::where('email', 'john@library.local')->first();
$user->role = 'admin';  // ubah dari 'member' ke 'admin'
$user->save();
exit;
```

---

## Security Notes

1. **Route Protection**: Semua admin routes dilindungi middleware `role:admin`
2. **Middleware Chain**: `['auth', 'verified', 'role:admin']` memastikan user sudah login & verified
3. **Navigation Conditional**: Menu items di navbar menggunakan `@if(auth()->user()->isAdmin())` untuk safety
4. **Default Role**: User baru default role 'member' (lebih aman)
5. **Gates**: Bisa digunakan di blade dengan `@can('admin-only')` atau di controller dengan `Gate::authorize('admin-only')`

---

## Troubleshooting

### "Unauthorized access" error saat login member

-   Pastikan kolom `role` di database sudah ada (migration sudah dijalankan)
-   Check: `php artisan migrate:status`

### Member bisa akses admin routes

-   Clear route cache: `php artisan route:clear`
-   Clear config cache: `php artisan config:clear`

### Seeder tidak membuat users

-   Pastikan UserSeeder ada di `database/seeders/UserSeeder.php`
-   Check DatabaseSeeder sudah memanggil `UserSeeder::class`
-   Jalankan: `php artisan db:seed`

---

## Next Steps (Optional Enhancements)

1. **UI Admin Panel**: Buat halaman untuk admin manage roles (promote/demote users)
2. **Audit Log**: Track siapa yang akses apa (untuk keamanan)
3. **Fine-grained Permissions**: Gunakan paket seperti `spatie/laravel-permission` untuk granular permissions
4. **Two-Factor Auth**: Tambah 2FA untuk admin accounts
5. **Role Seeding Options**: Buat interactive command untuk setup roles (bukan hardcoded)

---

**Last Updated**: 2025-11-25  
**Status**: ✅ Fully Implemented & Ready for Testing
