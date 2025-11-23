@extends('layouts.app')

@section('title', 'Detail Buku - ' . $book->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Buku</h2>
            <p class="text-gray-600">Informasi lengkap tentang buku</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('books.edit', $book) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('books.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="md:flex">
            <!-- Book Cover Placeholder -->
            <div class="md:w-1/3 bg-gray-200 flex items-center justify-center p-8">
                <div class="text-center">
                    <i class="fas fa-book text-6xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500">Cover Buku</p>
                </div>
            </div>
            
            <!-- Book Details -->
            <div class="md:w-2/3 p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $book->title }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Pengarang</label>
                        <p class="text-lg text-gray-800">{{ $book->author }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Kategori</label>
                        <p class="text-lg text-gray-800">{{ $book->category->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">ISBN</label>
                        <p class="text-lg text-gray-800">{{ $book->isbn ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Penerbit</label>
                        <p class="text-lg text-gray-800">{{ $book->publisher ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tahun Terbit</label>
                        <p class="text-lg text-gray-800">{{ $book->published_year ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Stok Total</label>
                        <p class="text-lg text-gray-800">{{ $book->quantity }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tersedia</label>
                        <p class="text-lg font-semibold {{ $book->available > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $book->available }}
                        </p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Status</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $book->available > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $book->available > 0 ? 'Tersedia' : 'Habis' }}
                        </span>
                    </div>
                </div>

                <!-- Description -->
                @if($book->description)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-600 mb-2">Deskripsi</label>
                    <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $book->description }}</p>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <div class="text-sm text-gray-500">
                        Ditambahkan: {{ $book->created_at->format('d M Y') }}
                    </div>
                    <div class="flex space-x-2">
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg" 
                                    onclick="return confirm('Hapus buku {{ $book->title }}?')">
                                <i class="fas fa-trash mr-2"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
