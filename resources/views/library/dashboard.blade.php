@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800">Dashboard Perpustakaan</h2>
    <p class="text-gray-600">Selamat datang di sistem manajemen perpustakaan</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-book text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalBooks ?? 0 }}</h3>
                <p class="text-gray-600">Total Buku</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-users text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalMembers ?? 0 }}</h3>
                <p class="text-gray-600">Total Anggota</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-exchange-alt text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-bold text-gray-800">{{ $activeBorrows ?? 0 }}</h3>
                <p class="text-gray-600">Sedang Dipinjam</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600">
                <i class="fas fa-exclamation-triangle text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-2xl font-bold text-gray-800">{{ $overdueBorrows ?? 0 }}</h3>
                <p class="text-gray-600">Terlambat</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-xl font-bold text-gray-800 mb-4">Quick Actions</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('books.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-4 rounded-lg text-center transition duration-200">
            <i class="fas fa-plus mr-2"></i>Tambah Buku
        </a>
        <a href="{{ route('members.create') }}" class="bg-green-500 hover:bg-green-600 text-white py-3 px-4 rounded-lg text-center transition duration-200">
            <i class="fas fa-user-plus mr-2"></i>Tambah Anggota
        </a>
        <a href="{{ route('borrows.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-3 px-4 rounded-lg text-center transition duration-200">
            <i class="fas fa-hand-holding mr-2"></i>Peminjaman Baru
        </a>
        <a href="{{ route('books.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-3 px-4 rounded-lg text-center transition duration-200">
            <i class="fas fa-list mr-2"></i>Lihat Semua Buku
        </a>
    </div>
</div>
@endsection
