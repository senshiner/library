<x-app-layout>

    <!-- Running Text Modern -->
    <div class="w-full bg-orange-200 text-black py-2 overflow-hidden relative">
        <div class="animate-marquee whitespace-nowrap font-semibold text-sm">
            🎉 You're logged in! {{ Auth::user()->name }} • Selamat datang di sistem manajemen perpustakaan •
        </div>
    </div>

    <div class="py-6 sm:py-12 bg-cyan-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Welcome Message -->
            <div class="mb-6 sm:mb-8">
                <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">
                    Dashboard Perpustakaan
                </h1>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 mb-6 sm:mb-8">

                <!-- Total Buku -->
                <div class="bg-white border border-black rounded-lg p-3 sm:p-6 shadow-[4px_4px_0px_rgba(0,0,0,1)] sm:shadow-[8px_8px_0px_rgba(0,0,0,1)]">
                    <div class="flex items-center">
                        <div class="p-2 sm:p-3 rounded-md bg-purple-300 border border-black" aria-hidden="true">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-2 sm:ml-4">
                            <h3 class="text-lg sm:text-3xl font-bold text-gray-900">{{ $stats['totalBooks'] }}</h3>
                            <p class="text-xs sm:text-sm text-gray-600 font-medium">Total Buku</p>
                        </div>
                    </div>
                </div>

                <!-- Total Anggota -->
                <div class="bg-white border border-black rounded-lg p-3 sm:p-6 shadow-[4px_4px_0px_rgba(0,0,0,1)] sm:shadow-[8px_8px_0px_rgba(0,0,0,1)]">
                    <div class="flex items-center">
                        <div class="p-2 sm:p-3 rounded-md bg-green-500 border border-black" aria-hidden="true">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-2 sm:ml-4">
                            <h3 class="text-lg sm:text-3xl font-bold text-gray-900">{{ $stats['totalMembers'] }}</h3>
                            <p class="text-xs sm:text-sm text-gray-600 font-medium">Total Anggota</p>
                        </div>
                    </div>
                </div>

                <!-- Sedang Dipinjam -->
                <div class="bg-white border border-black rounded-lg p-3 sm:p-6 shadow-[4px_4px_0px_rgba(0,0,0,1)] sm:shadow-[8px_8px_0px_rgba(0,0,0,1)]">
                    <div class="flex items-center">
                        <div class="p-2 sm:p-3 rounded-md bg-yellow-500 border border-black" aria-hidden="true">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-2 sm:ml-4">
                            <h3 class="text-lg sm:text-3xl font-bold text-gray-900">{{ $stats['activeBorrows'] }}</h3>
                            <p class="text-xs sm:text-sm text-gray-600 font-medium">Sedang Dipinjam</p>
                        </div>
                    </div>
                </div>

                <!-- Terlambat -->
                <div class="bg-white border border-black rounded-lg p-3 sm:p-6 shadow-[4px_4px_0px_rgba(0,0,0,1)] sm:shadow-[8px_8px_0px_rgba(0,0,0,1)]">
                    <div class="flex items-center">
                        <div class="p-2 sm:p-3 rounded-md bg-red-500 border border-black" aria-hidden="true">
                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-2 sm:ml-4">
                            <h3 class="text-lg sm:text-3xl font-bold text-gray-900">{{ $stats['overdueBorrows'] }}</h3>
                            <p class="text-xs sm:text-sm text-gray-600 font-medium">Terlambat</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Quick Actions -->
            <div class="bg-white border border-black rounded-lg shadow-[4px_4px_0px_rgba(0,0,0,1)] sm:shadow-[8px_8px_0px_rgba(0,0,0,1)] mb-6 sm:mb-8">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">Quick Actions</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

                        @if(auth()->user()->isAdmin())
                        <!-- Tambah Buku (Admin Only) -->
                        <a href="{{ route('books.create') }}"
                           class="bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900 shadow-[3px_3px_0px_rgba(0,0,0,1)] sm:shadow-[6px_6px_0px_rgba(0,0,0,1)]
                           py-2 sm:py-3 px-3 sm:px-4 rounded-md text-center active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                           transition-all inline-flex items-center justify-center gap-1 sm:gap-2 font-medium hover:scale-105 text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Buku
                        </a>

                        <!-- Tambah Anggota (Admin Only) -->
                        <a href="{{ route('members.create') }}"
                           class="bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900 shadow-[3px_3px_0px_rgba(0,0,0,1)] sm:shadow-[6px_6px_0px_rgba(0,0,0,1)]
                           py-2 sm:py-3 px-3 sm:px-4 rounded-md text-center active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                           transition-all inline-flex items-center justify-center gap-1 sm:gap-2 font-medium hover:scale-105 text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Anggota
                        </a>
                        @endif

                        @if(auth()->user()->isMember())
                        <!-- Peminjaman Baru (Member Only) -->
                        <a href="{{ route('borrows.create') }}"
                           class="bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900 shadow-[3px_3px_0px_rgba(0,0,0,1)] sm:shadow-[6px_6px_0px_rgba(0,0,0,1)]
                           py-2 sm:py-3 px-3 sm:px-4 rounded-md text-center active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                           transition-all inline-flex items-center justify-center gap-1 sm:gap-2 font-medium hover:scale-105 text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7h12m0 0l-4-4m4 4l-4 4" />
                            </svg>
                            Peminjaman Baru
                        </a>
                        @endif

                        <!-- Lihat Semua Buku -->
                        <a href="{{ route('books.index') }}"
                           class="bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900 shadow-[3px_3px_0px_rgba(0,0,0,1)] sm:shadow-[6px_6px_0px_rgba(0,0,0,1)]
                           py-2 sm:py-3 px-3 sm:px-4 rounded-md text-center active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                           transition-all inline-flex items-center justify-center gap-1 sm:gap-2 font-medium hover:scale-105 text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 4h18M3 10h18M3 16h18" />
                            </svg>
                            Lihat Semua Buku
                        </a>

                        @if(auth()->user()->isMember())
                        <!-- Edit Profil (Member Only) -->
                        <a href="{{ route('profile.edit') }}"
                           class="bg-green-400 hover:bg-green-500 border border-black text-gray-900 shadow-[3px_3px_0px_rgba(0,0,0,1)] sm:shadow-[6px_6px_0px_rgba(0,0,0,1)]
                           py-2 sm:py-3 px-3 sm:px-4 rounded-md text-center active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                           transition-all inline-flex items-center justify-center gap-1 sm:gap-2 font-medium hover:scale-105 text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Profil
                        </a>
                        @endif

                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="bg-white border border-black rounded-lg shadow-[4px_4px_0px_rgba(0,0,0,1)] sm:shadow-[8px_8px_0px_rgba(0,0,0,1)]">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">Aktivitas Terkini</h3>
                    <div class="space-y-2 sm:space-y-3">
                        @if($recentBorrows->count() > 0)
                            @foreach($recentBorrows as $borrow)
                                <div class="flex items-center justify-between p-2 sm:p-3 bg-gray-50 rounded border text-xs sm:text-sm">
                                    <div class="flex items-center space-x-2 sm:space-x-3">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                        <span>
                                            <strong>{{ $borrow->member->name }}</strong> meminjam buku 
                                            <strong>"{{ $borrow->book->title }}"</strong>
                                        </span>
                                    </div>
                                    <span class="text-xs text-gray-500 whitespace-nowrap ml-2">
                                        {{ $borrow->borrow_date->diffForHumans() }}
                                    </span>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-500 text-center py-3 sm:py-4 text-sm sm:text-base">Tidak ada aktivitas peminjaman terkini</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>