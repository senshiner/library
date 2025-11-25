<x-app-layout>

    <div class="py-6 sm:py-12 bg-cyan-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Title + Button -->
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                    Data Peminjaman Buku
                </h2>

                <a href="{{ route('borrows.create') }}"
                   class="bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900
                          shadow-[3px_3px_0px_rgba(0,0,0,1)]
                          active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                          transition-all px-4 py-2 rounded-md font-medium inline-flex items-center gap-2">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4" />
                    </svg>
                    Peminjaman Baru
                </a>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="bg-green-200 border border-black shadow-[3px_3px_0px_rgba(0,0,0,1)]
                            px-4 py-3 rounded mb-4 text-gray-900 font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Alert -->
            @if(session('error'))
                <div class="bg-red-200 border border-black shadow-[3px_3px_0px_rgba(0,0,0,1)]
                            px-4 py-3 rounded mb-4 text-gray-900 font-medium">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Table Container -->
            <div class="bg-white border border-black rounded-lg 
                        shadow-[6px_6px_0px_rgba(0,0,0,1)] overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm sm:text-base">
                        <thead class="bg-gray-100 border-b border-black">
                            <tr>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Buku</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Anggota</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Tanggal Pinjam</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Jatuh Tempo</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Status</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($borrows as $borrow)
                            <tr class="border-b border-black">
                                <td class="px-6 py-4 border-r border-black">
                                    <div class="font-medium">{{ $borrow->book->title }}</div>
                                    <div class="text-sm text-gray-600">by {{ $borrow->book->author }}</div>
                                </td>
                                <td class="px-6 py-4 border-r border-black">
                                    <div class="font-medium">{{ $borrow->member->name }}</div>
                                    <div class="text-sm text-gray-600">{{ $borrow->member->email }}</div>
                                </td>
                                <td class="px-6 py-4 border-r border-black">{{ $borrow->borrow_date->format('d M Y') }}</td>
                                <td class="px-6 py-4 border-r border-black">
                                    <div class="{{ $borrow->due_date->isPast() && $borrow->status != 'returned' ? 'text-red-600 font-semibold' : '' }}">
                                        {{ $borrow->due_date->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 border-r border-black">
                                    @if($borrow->status == 'borrowed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-200 text-yellow-900 border border-yellow-900">
                                            Dipinjam
                                        </span>
                                    @elseif($borrow->status == 'returned')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-200 text-green-900 border border-green-900">
                                            Dikembalikan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-200 text-red-900 border border-red-900">
                                            Terlambat
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 flex gap-2">

                                    <!-- Lihat -->
                                    <a href="{{ route('borrows.show', $borrow) }}"
                                       class="bg-blue-300 hover:bg-blue-400 border border-black 
                                              px-3 py-1 rounded shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                              active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                                              transition-all text-sm font-medium">
                                        Lihat
                                    </a>

                                    @if($borrow->status == 'borrowed')
                                    <!-- Kembalikan -->
                                    <form action="{{ route('borrows.return', $borrow) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                                onclick="return confirm('Tandai buku sebagai dikembalikan?')"
                                                class="bg-green-300 hover:bg-green-400 border border-black 
                                                       px-3 py-1 rounded shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                                       active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                                                       transition-all text-sm font-medium">
                                            Kembalikan
                                        </button>
                                    </form>
                                    @endif

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-600">
                                    Tidak ada data peminjaman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>