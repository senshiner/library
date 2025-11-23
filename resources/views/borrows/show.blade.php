<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Detail Peminjaman</h2>
                        <p class="text-gray-600 dark:text-gray-400">Informasi lengkap peminjaman buku</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('borrows.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                            Kembali
                        </a>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Book Information -->
                            <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Informasi Buku</h3>
                                <div class="space-y-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Judul</label>
                                        <p class="text-gray-800 dark:text-white">{{ $borrow->book->title }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Pengarang</label>
                                        <p class="text-gray-800 dark:text-white">{{ $borrow->book->author }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">ISBN</label>
                                        <p class="text-gray-800 dark:text-white">{{ $borrow->book->isbn ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Member Information -->
                            <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Informasi Anggota</h3>
                                <div class="space-y-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Nama</label>
                                        <p class="text-gray-800 dark:text-white">{{ $borrow->member->name }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Email</label>
                                        <p class="text-gray-800 dark:text-white">{{ $borrow->member->email }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Telepon</label>
                                        <p class="text-gray-800 dark:text-white">{{ $borrow->member->phone ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Borrow Information -->
                        <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Informasi Peminjaman</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Tanggal Pinjam</label>
                                    <p class="text-gray-800 dark:text-white">{{ $borrow->borrow_date->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Jatuh Tempo</label>
                                    <p class="text-gray-800 dark:text-white {{ $borrow->due_date->isPast() && $borrow->status != 'returned' ? 'text-red-600 dark:text-red-400 font-semibold' : '' }}">
                                        {{ $borrow->due_date->format('d M Y') }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Tanggal Kembali</label>
                                    <p class="text-gray-800 dark:text-white">
                                        {{ $borrow->return_date ? $borrow->return_date->format('d M Y') : 'Belum dikembalikan' }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Status</label>
                                    @if($borrow->status == 'borrowed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                            Dipinjam
                                        </span>
                                    @elseif($borrow->status == 'returned')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            Dikembalikan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                            Terlambat
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if($borrow->notes)
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Catatan</label>
                                <p class="text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 p-3 rounded-lg mt-1">{{ $borrow->notes }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        @if($borrow->status == 'borrowed')
                        <div class="mt-6 flex justify-end">
                            <form action="{{ route('borrows.return', $borrow) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg" 
                                        onclick="return confirm('Tandai buku sebagai dikembalikan?')">
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