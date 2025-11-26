<x-app-layout>

    <div class="py-6 sm:py-12 bg-cyan-50 dark:bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">

                <!-- Title + Buttons -->
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Detail Buku</h2>
                        <p class="text-gray-600 mt-2">Informasi lengkap tentang buku</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('books.edit', $book) }}"
                           class="bg-yellow-300 hover:bg-yellow-400 border border-black text-gray-900
                                  shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                  active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                                  transition-all px-4 py-2 rounded-md font-medium">
                            Edit
                        </a>
                        <a href="{{ route('books.index') }}"
                           class="bg-gray-300 hover:bg-gray-400 border border-black text-gray-900
                                  shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                  active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                                  transition-all px-4 py-2 rounded-md font-medium">
                            Kembali
                        </a>
                    </div>
                </div>

                <!-- Book Detail Container -->
                <div class="bg-white border border-black rounded-lg 
                            shadow-[6px_6px_0px_rgba(0,0,0,1)] overflow-hidden">

                    <div class="md:flex">
                        <!-- Book Cover Placeholder -->
                        <div class="md:w-1/3 bg-gray-100 dark:bg-slate-800 border-r border-black dark:border-white/5 flex items-center justify-center p-8">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-500 dark:text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <p class="text-gray-600 dark:text-gray-300">Cover Buku</p>
                            </div>
                        </div>
                        
                        <!-- Book Details -->
                        <div class="md:w-2/3 p-6">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $book->title }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Pengarang</label>
                                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $book->author }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Kategori</label>
                                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $book->category->name }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">ISBN</label>
                                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $book->isbn ?? '-' }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Penerbit</label>
                                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $book->publisher ?? '-' }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Tahun Terbit</label>
                                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $book->published_year ?? '-' }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Stok Total</label>
                                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $book->quantity }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Tersedia</label>
                                    <p class="text-lg font-semibold {{ $book->available > 0 ? 'text-green-600' : 'text-red-600' }} text-gray-900 dark:text-gray-100">
                                        {{ $book->available }}
                                    </p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                              {{ $book->available > 0 ? 'bg-green-200 text-green-900 border border-green-900' : 'bg-red-200 text-red-900 border border-red-900' }}">
                                        {{ $book->available > 0 ? 'Tersedia' : 'Habis' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Description -->
                            @if($book->description)
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Deskripsi</label>
                                <p class="text-gray-700 dark:text-gray-200 bg-gray-50 dark:bg-slate-900 border border-gray-300 dark:border-white/5 p-4 rounded-md">{{ $book->description }}</p>
                            </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center pt-4 border-t border-gray-300">
                                <div class="text-sm text-gray-600 dark:text-gray-300">
                                    Ditambahkan: {{ $book->created_at->format('d M Y') }}
                                </div>
                                <div class="flex gap-2">
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Hapus buku {{ $book->title }}?')"
                                                class="bg-red-300 hover:bg-red-400 dark:bg-red-600 dark:hover:bg-red-700 border border-black text-gray-900 dark:text-white
                                                       shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                                       active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                                                       transition-all px-4 py-2 rounded-md font-medium">
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