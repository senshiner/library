<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Buku - ') . $book->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Detail Buku</h2>
                        <p class="text-gray-600 dark:text-gray-400">Informasi lengkap tentang buku</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('books.edit', $book) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                            Edit
                        </a>
                        <a href="{{ route('books.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                            Kembali
                        </a>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <div class="md:flex">
                        <!-- Book Cover Placeholder -->
                        <div class="md:w-1/3 bg-gray-200 dark:bg-gray-700 flex items-center justify-center p-8">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Cover Buku</p>
                            </div>
                        </div>
                        
                        <!-- Book Details -->
                        <div class="md:w-2/3 p-6">
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">{{ $book->title }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Pengarang</label>
                                    <p class="text-lg text-gray-800 dark:text-white">{{ $book->author }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Kategori</label>
                                    <p class="text-lg text-gray-800 dark:text-white">{{ $book->category->name }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">ISBN</label>
                                    <p class="text-lg text-gray-800 dark:text-white">{{ $book->isbn ?? '-' }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Penerbit</label>
                                    <p class="text-lg text-gray-800 dark:text-white">{{ $book->publisher ?? '-' }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Tahun Terbit</label>
                                    <p class="text-lg text-gray-800 dark:text-white">{{ $book->published_year ?? '-' }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Stok Total</label>
                                    <p class="text-lg text-gray-800 dark:text-white">{{ $book->quantity }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Tersedia</label>
                                    <p class="text-lg font-semibold {{ $book->available > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                        {{ $book->available }}
                                    </p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Status</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $book->available > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                        {{ $book->available > 0 ? 'Tersedia' : 'Habis' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Description -->
                            @if($book->description)
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Deskripsi</label>
                                <p class="text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">{{ $book->description }}</p>
                            </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-600">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    Ditambahkan: {{ $book->created_at->format('d M Y') }}
                                </div>
                                <div class="flex space-x-2">
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg" 
                                                onclick="return confirm('Hapus buku {{ $book->title }}?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>