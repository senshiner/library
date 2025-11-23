@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-bold text-gray-800">Data Peminjaman Buku</h2>
    <a href="{{ route('borrows.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
        <i class="fas fa-hand-holding mr-2"></i>Peminjaman Baru
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jatuh Tempo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($borrows as $borrow)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">{{ $borrow->book->title }}</div>
                    <div class="text-sm text-gray-500">by {{ $borrow->book->author }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $borrow->member->name }}</div>
                    <div class="text-sm text-gray-500">{{ $borrow->member->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $borrow->borrow_date->format('d M Y') }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 {{ $borrow->due_date->isPast() && $borrow->status != 'returned' ? 'text-red-600 font-semibold' : '' }}">
                        {{ $borrow->due_date->format('d M Y') }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
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
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('borrows.show', $borrow) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                        <i class="fas fa-eye"></i>
                    </a>
                    @if($borrow->status == 'borrowed')
                    <form action="{{ route('borrows.update', $borrow) }}" method="POST" class="inline mr-2">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="return_date" value="{{ now()->format('Y-m-d') }}">
                        <input type="hidden" name="status" value="returned">
                        <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Tandai buku sebagai dikembalikan?')">
                            <i class="fas fa-check"></i>
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                    Tidak ada data peminjaman.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
