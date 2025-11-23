<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Perpustakaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="mb-8">
                <p class="text-gray-600 dark:text-gray-400 text-lg">Selamat datang di sistem manajemen perpustakaan</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                @php
                                    $totalBooks = \App\Models\Book::count();
                                @endphp
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalBooks }}</h3>
                                <p class="text-gray-600 dark:text-gray-400">Total Buku</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                @php
                                    $totalMembers = \App\Models\Member::where('status', 'active')->count();
                                @endphp
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalMembers }}</h3>
                                <p class="text-gray-600 dark:text-gray-400">Total Anggota</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                @php
                                    $activeBorrows = \App\Models\Borrow::where('status', 'borrowed')->count();
                                @endphp
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $activeBorrows }}</h3>
                                <p class="text-gray-600 dark:text-gray-400">Sedang Dipinjam</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                @php
                                    $overdueBorrows = \App\Models\Borrow::where('status', 'borrowed')
                                        ->where('due_date', '<', now())
                                        ->count();
                                @endphp
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $overdueBorrows }}</h3>
                                <p class="text-gray-600 dark:text-gray-400">Terlambat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('books.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-4 rounded-lg text-center transition duration-200">
                            Tambah Buku
                        </a>
                        <a href="{{ route('members.create') }}" class="bg-green-500 hover:bg-green-600 text-white py-3 px-4 rounded-lg text-center transition duration-200">
                            Tambah Anggota
                        </a>
                        <a href="{{ route('borrows.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-3 px-4 rounded-lg text-center transition duration-200">
                            Peminjaman Baru
                        </a>
                        <a href="{{ route('books.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-3 px-4 rounded-lg text-center transition duration-200">
                            Lihat Semua Buku
                        </a>
                    </div>
                </div>
            </div>

            <!-- Welcome Message for Logged In User -->
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-lg">You're logged in! <span class="font-semibold">{{ Auth::user()->name }}</span></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>