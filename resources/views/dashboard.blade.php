<x-app-layout>

    <!-- Running Text Modern -->
    <div class="w-full bg-indigo-600 text-white py-2 overflow-hidden relative">
        <div class="animate-marquee whitespace-nowrap font-semibold text-sm">
            🎉 You're logged in! {{ Auth::user()->name }} • Selamat datang di sistem manajemen perpustakaan •
        </div>
    </div>

    <div class="py-6 sm:py-12 bg-root min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Welcome Message -->
            <div class="mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-fg mb-1">Dashboard Perpustakaan</h1>
                <p class="text-sm text-muted">Halo, <span class="font-medium">{{ Auth::user()->name }}</span> — ringkasan singkat aktivitas perpustakaan hari ini.</p>
            </div>

            

            <!-- Dashboard body: hero + stats + main content -->
            <div class="mb-6">
                <div class="bg-card border border-theme rounded-lg p-6 shadow-theme">
                    <h2 class="text-xl sm:text-2xl font-bold text-fg">Ringkasan</h2>
                        <p class="text-sm text-muted mt-1">Statistik singkat dan aktivitas terbaru.</p>

                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Total Buku - Ungu -->
                        <div class="bg-purple-500 border border-theme rounded-lg p-4">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 rounded-full bg-icon">
                                    <!-- book icon -->
                                    <svg class="h-5 w-5 icon-fill" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 20h9"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6a2 2 0 012-2h11a2 2 0 012 2v12a2 2 0 00-2 2H5a2 2 0 01-2-2V6z"/></svg>
                                </div>
                                <div>
                                    <div class="text-sm text-white">Total Buku</div>
                                    <div class="text-2xl font-bold text-white">{{ $stats['totalBooks'] }}</div>
                                </div>
                            </div>
                        </div>
                        <!-- Total Anggota - Hijau -->
                        <div class="bg-green-500 border border-theme rounded-lg p-4">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 rounded-full bg-icon">
                                    <!-- user icon -->
                                    <svg class="h-5 w-5 icon-fill" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14c-4.418 0-8 1.79-8 4v2h16v-2c0-2.21-3.582-4-8-4z"/></svg>
                                </div>
                                <div>
                                    <div class="text-sm text-white">Total Anggota</div>
                                    <div class="text-2xl font-bold text-white">{{ $stats['totalMembers'] }}</div>
                                </div>
                            </div>
                        </div>
                        <!-- Sedang Dipinjam - Kuning -->
                        <div class="bg-yellow-500 border border-theme rounded-lg p-4">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 rounded-full bg-icon">
                                    <!-- clock icon -->
                                    <svg class="h-5 w-5 icon-fill" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l2 2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <div class="text-sm text-white">Sedang Dipinjam</div>
                                    <div class="text-2xl font-bold text-white">{{ $stats['activeBorrows'] }}</div>
                                </div>
                            </div>
                        </div>
                        <!-- Terlambat - Merah -->
                        <div class="bg-red-500 border border-theme rounded-lg p-4">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 rounded-full bg-icon">
                                    <!-- alert icon -->
                                    <svg class="h-5 w-5 icon-fill" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v4"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 17h.01"/></svg>
                                </div>
                                <div>
                                    <div class="text-sm text-white">Terlambat</div>
                                    <div class="text-2xl font-bold text-white">{{ $stats['overdueBorrows'] }} <span class="text-sm text-white">({{ $stats['overdueRatio'] }}%)</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main column: Recent Activity (unified) with scroll -->
                <div class="lg:col-span-2 bg-card border border-theme rounded-lg p-4 sm:p-6 shadow-theme">
                    <h3 class="text-lg sm:text-xl font-bold text-fg mb-3">Aktivitas Terkini</h3>
                    <div class="space-y-2 sm:space-y-3 max-h-96 overflow-y-auto">
                        @if(isset($activities) && $activities->count())
                            @foreach($activities as $act)
                                <div class="flex items-center justify-between p-3 bg-card-2 rounded border border-theme text-sm">
                                    <div class="flex items-center space-x-3">
                                        <div class="p-2 bg-indigo-500 rounded-full text-white">
                                            <!-- small book icon -->
                                            <svg class="h-4 w-4 icon-fill" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 20h9"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6a2 2 0 012-2h11a2 2 0 012 2v12a2 2 0 00-2 2H5a2 2 0 01-2-2V6z"/></svg>
                                        </div>
                                        <div>
                                            <div class="font-medium text-fg">{!! $act->message !!}</div>
                                            <div class="text-xs text-muted">{{ $act->title }}</div>
                                        </div>
                                    </div>
                                    <div class="text-xs text-muted whitespace-nowrap ml-2">{{ \Illuminate\Support\Carbon::parse($act->date)->diffForHumans() }}</div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-gray-500 text-center py-3 text-sm">Tidak ada aktivitas terkini</p>
                        @endif
                    </div>
                </div>

                <!-- Sidebar widgets: Upcoming Due & Popular Books -->
                <div class="space-y-4">
                    @if(!isset($activities) || $activities->isEmpty())
                    <div class="bg-card border border-theme rounded-lg p-4 sm:p-6 shadow-theme">
                        <h3 class="text-md font-semibold text-fg mb-2">Upcoming Due (7 hari)</h3>
                        @if($upcomingDue->count())
                            <ul class="space-y-2 text-sm">
                                @foreach($upcomingDue as $due)
                                    <li class="flex justify-between items-start bg-card-2 rounded p-2 border border-theme">
                                        <div>
                                            <div class="font-medium text-fg">{{ \Illuminate\Support\Str::limit($due->book->title, 40) }}</div>
                                            <div class="text-xs text-muted">{{ $due->member->name }}</div>
                                        </div>
                                        <div class="text-xs text-muted">{{ $due->due_date->format('d M') }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-gray-500">Tidak ada peminjaman yang akan jatuh tempo dalam 7 hari.</p>
                        @endif
                    </div>
                    @endif

                    <div class="bg-card border border-theme rounded-lg p-4 sm:p-6 shadow-theme">
                        <h3 class="text-md font-semibold text-fg mb-2">Buku Populer</h3>
                        @if($popularBooks->count())
                            <ol class="list-decimal list-inside space-y-2 text-sm">
                                @foreach($popularBooks as $pb)
                                    <li class="flex justify-between items-center bg-transparent">
                                        <div class="truncate text-fg">{{ $pb->title }}</div>
                                        <div class="text-xs font-medium text-muted">{{ $pb->borrows_count }}</div>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <p class="text-sm text-gray-500">Belum ada data peminjaman untuk menentukan buku populer.</p>
                        @endif
                    </div>

                    <div class="bg-card border border-theme rounded-lg p-4 sm:p-6 shadow-theme">
                        <h3 class="text-md font-semibold text-fg mb-2">Kategori Utama</h3>
                        @if(isset($topCategories) && $topCategories->count())
                            <ul class="space-y-2 text-sm">
                                @foreach($topCategories as $cat)
                                    <li class="flex justify-between items-center p-2 bg-card-2 rounded border border-theme">
                                        <span class="font-medium text-fg">{{ $cat->name }}</span>
                                        <span class="text-xs bg-indigo-500 text-white px-2 py-1 rounded">{{ $cat->books_count }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-gray-500">Belum ada kategori.</p>
                        @endif
                    </div>
                </div>
            </div>

            

        </div>
    </div>

</x-app-layout>