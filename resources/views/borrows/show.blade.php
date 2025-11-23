@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Peminjaman</h2>
            <p class="text-gray-600">Informasi lengkap peminjaman buku</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('borrows.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Book Information -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Buku</h3>
                    <div class="space-y-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Judul</label>
                            <p class="text-gray-800">{{ $borrow->book->title }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Pengarang</label>
                            <p class="text-gray-800">{{ $borrow->book->author }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">ISBN</label>
                            <p class="text-gray-800">{{ $borrow->book->isbn ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Member Information -->
                <div class="border border-gray-200 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Anggota</h3>
                    <div class="space-y-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Nama</label>
                            <p class="text-gray-800">{{ $borrow->member->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Email</label>
                            <p class="text-gray-800">{{ $borrow->member->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Telepon</label>
                            <p class="text-gray-800">{{ $borrow->member->phone ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Borrow Information -->
            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Peminjaman</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tanggal Pinjam</label>
                        <p class="text-gray-800">{{ $borrow->borrow_date->format('d M Y') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Jatuh Tempo</label>
                        <p class="text-gray-800 {{ $borrow->due_date->isPast() && $borrow->status != 'returned' ? 'text-red-600 font-semibold' : '' }}">
                            {{ $borrow->due_date->format('d M Y') }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tanggal Kembali</label>
                        <p class="text-gray-800">
                            {{ $borrow->return_date ? $borrow->return_date->format('d M Y') : 'Belum dikembalikan' }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Status</label>
                        @if($borrow->status == 'borrowed')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Dipinjam
                            </span>
                        @elseif($borrow->status == 'returned')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Dikembalikan
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Terlambat
                            </span>
                        @endif
                    </div>
                </div>

                @if($borrow->notes)
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-600">Catatan</label>
                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg mt-1">{{ $borrow->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Action Buttons -->
            @if($borrow->status == 'borrowed')
            <div class="mt-6 flex justify-end">
                <form action="{{ route('borrows.update', $borrow) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="return_date" value="{{ now()->format('Y-m-d') }}">
                    <input type="hidden" name="status" value="returned">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg" 
                            onclick="return confirm('Tandai buku sebagai dikembalikan?')">
                        <i class="fas fa-check mr-2"></i>Tandai Dikembalikan
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
