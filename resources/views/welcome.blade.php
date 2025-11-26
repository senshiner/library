<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Library Management System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
        <!-- Tailwind CSS -->
        @vite('resources/css/app.css')

        @vite('resources/css/app.css')
    </head>
    <body class="antialiased bg-root text-fg">
        <!-- Main Content -->
        <div class="min-h-screen bg-root py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Header -->
                <div class="text-center mb-12">
                    <div class="flex justify-center mb-6">
                        <x-application-logo class="w-16 h-16 icon-fill" />
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-bold text-fg mb-3">
                        📚 Library Management System
                    </h1>
                    <p class="text-lg text-muted max-w-2xl mx-auto">
                        Sistem manajemen perpustakaan terpadu untuk mengelola koleksi buku, anggota, dan peminjaman
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-12">
                    
                    <!-- Feature 1: Books -->
                    <div class="bg-card border border-theme rounded-lg p-6 shadow-theme transition-all">
                        <div class="p-3 bg-purple-300 border border-black rounded-md mb-4 w-fit">
                            <svg class="w-6 h-6 icon-fill" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-fg mb-2">Manajemen Buku</h3>
                        <p class="text-sm text-muted">Kelola koleksi buku dengan kategori, pengarang, dan stok yang terorganisir</p>
                    </div>

                    <!-- Feature 2: Members -->
                    <div class="bg-card border border-theme rounded-lg p-6 shadow-theme transition-all">
                        <div class="p-3 bg-green-500 border border-black rounded-md mb-4 w-fit">
                            <svg class="w-6 h-6 icon-fill" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-fg mb-2">Manajemen Anggota</h3>
                        <p class="text-sm text-muted">Kelola data anggota perpustakaan dan status keanggotaan mereka</p>
                    </div>

                    <!-- Feature 3: Borrowing -->
                    <div class="bg-card border border-theme rounded-lg p-6 shadow-theme transition-all">
                        <div class="p-3 bg-blue-300 border border-black rounded-md mb-4 w-fit">
                            <svg class="w-6 h-6 icon-fill" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-fg mb-2">Manajemen Peminjaman</h3>
                        <p class="text-sm text-muted">Catat peminjaman dan pengembalian buku dengan tracking tanggal jatuh tempo</p>
                    </div>

                    <!-- Feature 4: Dashboard -->
                    <div class="bg-card border border-theme rounded-lg p-6 shadow-theme transition-all">
                        <div class="p-3 bg-yellow-300 border border-black rounded-md mb-4 w-fit">
                            <svg class="w-6 h-6 icon-fill" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-fg mb-2">Dashboard Statistik</h3>
                        <p class="text-sm text-muted">Lihat ringkasan statistik dan laporan terkini tentang perpustakaan Anda</p>
                    </div>

                </div>

                <!-- CTA Section -->
                <div class="bg-gradient-to-r from-purple-300 to-blue-300 dark:from-purple-700 dark:to-blue-700 border-4 border-theme rounded-lg p-8 sm:p-12 shadow-theme text-center">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        Siap Mengelola Perpustakaan Anda?
                    </h2>
                    <p class="text-fg mb-8 text-lg">
                        Masuk atau daftar sekarang untuk memulai menggunakan sistem manajemen perpustakaan
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @if (Route::has('login'))
                                     <a href="{{ route('login') }}" 
                                         class="bg-cyan-400 hover:bg-cyan-500 border-2 border-theme text-fg font-bold py-3 px-8 rounded-lg shadow-theme active:translate-x-[2px] active:translate-y-[2px] active:shadow-none transition-all inline-block">
                                🔐 Masuk
                            </a>
                        @endif

                        @if (Route::has('register'))
                                     <a href="{{ route('register') }}" 
                                         class="bg-green-400 hover:bg-green-500 border-2 border-theme text-fg font-bold py-3 px-8 rounded-lg shadow-theme active:translate-x-[2px] active:translate-y-[2px] active:shadow-none transition-all inline-block">
                                ✍️ Daftar
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
