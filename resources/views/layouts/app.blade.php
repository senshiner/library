<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-book text-2xl"></i>
                    <h1 class="text-2xl font-bold">Sistem Perpustakaan</h1>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('library.dashboard') }}" class="hover:bg-blue-700 px-3 py-2 rounded">Dashboard</a>
                    <a href="{{ route('books.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded">Buku</a>
                    <a href="{{ route('members.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded">Anggota</a>
                    <a href="{{ route('borrows.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded">Peminjaman</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Sistem Perpustakaan. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
