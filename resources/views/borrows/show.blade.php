<x-app-layout>

    <div class="py-6 sm:py-12 bg-cyan-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">

                <!-- Title + Button -->
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Detail Peminjaman</h2>
                        <p class="text-gray-600 mt-2">Informasi lengkap peminjaman buku</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('borrows.index') }}"
                           class="bg-gray-300 hover:bg-gray-400 border border-black text-gray-900
                                  shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                  active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                                  transition-all px-4 py-2 rounded-md font-medium">
                            Kembali
                        </a>
                    </div>
                </div>

                <!-- Detail Container -->
                <div class="bg-white border border-black rounded-lg 
                            shadow-[6px_6px_0px_rgba(0,0,0,1)] overflow-hidden">

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Book Information -->
                            <div class="border border-black rounded-lg p-4 bg-gray-50">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Informasi Buku</h3>
                                <div class="space-y-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Judul</label>
                                        <p class="text-gray-900">{{ $borrow->book->title }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Pengarang</label>
                                        <p class="text-gray-900">{{ $borrow->book->author }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">ISBN</label>
                                        <p class="text-gray-900">{{ $borrow->book->isbn ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Member Information -->
                            <div class="border border-black rounded-lg p-4 bg-gray-50">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Informasi Anggota</h3>
                                <div class="space-y-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Nama</label>
                                        <p class="text-gray-900">{{ $borrow->member->name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                                        <p class="text-gray-900">{{ $borrow->member->email }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 mb-1">Telepon</label>
                                        <p class="text-gray-900">{{ $borrow->member->phone ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Borrow Information -->
                        <div class="border border-black rounded-lg p-4 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Informasi Peminjaman</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Pinjam</label>
                                    <p class="text-gray-900">{{ $borrow->borrow_date->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Jatuh Tempo</label>
                                    <p class="text-gray-900 {{ $borrow->due_date->isPast() && $borrow->status != 'returned' ? 'text-red-600 font-semibold' : '' }}">
                                        {{ $borrow->due_date->format('d M Y') }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Kembali</label>
                                    <p class="text-gray-900">
                                        {{ $borrow->return_date ? $borrow->return_date->format('d M Y') : 'Belum dikembalikan' }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
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
                                </div>
                            </div>

                            @if($borrow->notes)
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Catatan</label>
                                <p class="text-gray-700 bg-white border border-gray-300 p-3 rounded-md mt-1">{{ $borrow->notes }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        @if($borrow->status == 'borrowed')
                        <div class="mt-6 flex justify-end">
                            <form action="{{ route('borrows.return', $borrow) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        onclick="return confirm('Tandai buku sebagai dikembalikan?')"
                                        class="bg-green-300 hover:bg-green-400 border border-black text-gray-900
                                               shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                               active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                                               transition-all px-4 py-2 rounded-md font-medium">
                                    Tandai Dikembalikan
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>