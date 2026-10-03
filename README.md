# Perpustakaan — Demo

Versi demo frontend-only dari aplikasi Perpustakaan. Tanpa server, tanpa
database, tanpa login — seluruh data (buku, anggota, peminjaman) tersimpan
di localStorage browser masing-masing pengunjung.

## Coba

Buka `index.html` langsung di browser, atau:

```bash
npx serve .
```

## Catatan

- Data contoh bawaan sama dengan seeder Laravel (termasuk 1 peminjaman
  terlambat untuk demo).
- Tombol **Reset Demo** di navbar mengembalikan data ke awal.
- Dokumentasi aplikasi Laravel lengkap ada di branch `main`.
