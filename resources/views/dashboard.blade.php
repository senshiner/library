<x-app-layout>

    <!-- Running Text Modern -->
    <div class="w-full bg-indigo-600 text-white py-2 overflow-hidden relative">
        <div class="animate-marquee whitespace-nowrap font-semibold text-sm">
            🎉 You're logged in! {{ Auth::user()->name }} • Selamat datang di sistem manajemen perpustakaan •
        </div>
    </div>

    <div class="py-6 sm:py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Welcome Message -->
            <div class="mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-1">Dashboard Perpustakaan</h1>
                <p class="text-sm text-gray-600">Halo, <span class="font-medium">{{ Auth::user()->name }}</span> — ringkasan singkat aktivitas perpustakaan hari ini.</p>
            </div>

            

            <!-- Dashboard body: hero + stats + main content -->
            <div class="mb-6">
                <div class="bg-white border border-black rounded-lg p-6 shadow-[6px_6px_0px_rgba(0,0,0,1)]">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Ringkasan</h2>
                        <p class="text-sm text-gray-600 mt-1">Statistik singkat dan aktivitas terbaru.</p>

                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Total Buku - Ungu -->
                        <div class="bg-purple-500 border border-black rounded-lg p-4">
                            <div class="text-sm text-black">Total Buku</div>
                            <div class="text-2xl font-bold text-black">{{ $stats['totalBooks'] }}</div>
                        </div>
                        <!-- Total Anggota - Hijau -->
                        <div class="bg-green-500 border border-black rounded-lg p-4">
                            <div class="text-sm text-black">Total Anggota</div>
                            <div class="text-2xl font-bold text-black">{{ $stats['totalMembers'] }}</div>
                        </div>
                        <!-- Sedang Dipinjam - Kuning -->
                        <div class="bg-yellow-500 border border-black rounded-lg p-4">
                            <div class="text-sm text-black">Sedang Dipinjam</div>
                            <div class="text-2xl font-bold text-black">{{ $stats['activeBorrows'] }}</div>
                        </div>
                        <!-- Terlambat - Merah -->
                        <div class="bg-red-500 border border-black rounded-lg p-4">
                            <div class="text-sm text-black">Terlambat</div>
                            <div class="text-2xl font-bold text-black">{{ $stats['overdueBorrows'] }} <span class="text-sm text-black">({{ $stats['overdueRatio'] }}%)</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main column: Recent Activity (unified) with scroll -->
                <div class="lg:col-span-2 bg-white border border-black rounded-lg p-4 sm:p-6 shadow-[4px_4px_0px_rgba(0,0,0,1)]">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3">Aktivitas Terkini</h3>
                    <div class="space-y-2 sm:space-y-3 max-h-96 overflow-y-auto">
                        @if(isset($activities) && $activities->count())
                            @foreach($activities as $act)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded border text-sm">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-indigo-500 rounded-full"></div>
                                        <div>
                                            <div class="font-medium">{!! $act->message !!}</div>
                                            <div class="text-xs text-gray-600">{{ $act->title }}</div>
                                        </div>
                                    </div>
                                    <div class="text-xs text-gray-500 whitespace-nowrap ml-2">{{ \Illuminate\Support\Carbon::parse($act->date)->diffForHumans() }}</div>
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
                    <div class="bg-white border border-black rounded-lg p-4 sm:p-6 shadow-[4px_4px_0px_rgba(0,0,0,1)]">
                        <h3 class="text-md font-semibold text-gray-900 mb-2">Upcoming Due (7 hari)</h3>
                        @if($upcomingDue->count())
                            <ul class="space-y-2 text-sm">
                                @foreach($upcomingDue as $due)
                                    <li class="flex justify-between items-start">
                                        <div>
                                            <div class="font-medium">{{ \Illuminate\Support\Str::limit($due->book->title, 40) }}</div>
                                            <div class="text-xs text-gray-600">{{ $due->member->name }}</div>
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $due->due_date->format('d M') }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-gray-500">Tidak ada peminjaman yang akan jatuh tempo dalam 7 hari.</p>
                        @endif
                    </div>
                    @endif

                    <div class="bg-white border border-black rounded-lg p-4 sm:p-6 shadow-[4px_4px_0px_rgba(0,0,0,1)]">
                        <h3 class="text-md font-semibold text-gray-900 mb-2">Buku Populer</h3>
                        @if($popularBooks->count())
                            <ol class="list-decimal list-inside space-y-2 text-sm text-gray-700">
                                @foreach($popularBooks as $pb)
                                    <li class="flex justify-between items-center">
                                        <div class="truncate">{{ $pb->title }}</div>
                                        <div class="text-xs font-medium text-gray-600">{{ $pb->borrows_count }}</div>
                                    </li>
                                @endforeach
                            </ol>
                        @else
                            <p class="text-sm text-gray-500">Belum ada data peminjaman untuk menentukan buku populer.</p>
                        @endif
                    </div>

                    <div class="bg-white border border-black rounded-lg p-4 sm:p-6 shadow-[4px_4px_0px_rgba(0,0,0,1)]">
                        <h3 class="text-md font-semibold text-gray-900 mb-2">Kategori Utama</h3>
                        @if(isset($topCategories) && $topCategories->count())
                            <ul class="space-y-2 text-sm">
                                @foreach($topCategories as $cat)
                                    <li class="flex justify-between items-center p-2 bg-gray-50 rounded border">
                                        <span class="font-medium">{{ $cat->name }}</span>
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