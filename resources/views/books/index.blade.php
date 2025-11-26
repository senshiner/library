<x-app-layout>

    <div class="py-6 sm:py-12 bg-root min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Title + Button -->
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-2xl sm:text-3xl font-bold text-fg">
                    Daftar Buku
                </h2>
                <div class="flex items-center gap-3">
                    <form action="{{ route('books.index') }}" method="GET" class="flex items-center">
               <input type="search" name="q" value="{{ request('q') }}"
                   placeholder="Cari judul, pengarang, atau kategori..."
                   class="px-3 py-2 border border-theme rounded-l-md focus:outline-none bg-card" />
               <button type="submit" class="bg-card border border-theme px-3 py-2 rounded-r-md text-fg">
                            Cari
                        </button>
                    </form>

                          <a href="{{ route('books.create') }}"
                              class="bg-cyan-400 hover:bg-cyan-500 border border-theme text-fg
                                        shadow-theme
                                        active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                                        transition-all px-4 py-2 rounded-md font-medium inline-flex items-center gap-2">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Buku
                    </a>
                </div>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="bg-green-200 px-4 py-3 rounded mb-4 text-fg font-medium border border-theme shadow-theme">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table Container -->
            <div class="bg-card border border-theme rounded-lg shadow-theme overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm sm:text-base">
                        <thead class="bg-card-2 border-b border-theme">
                            <tr>
                                <th class="px-6 py-3 text-left font-bold text-fg border-r border-theme">Judul</th>
                                <th class="px-6 py-3 text-left font-bold text-fg border-r border-theme">Pengarang</th>
                                <th class="px-6 py-3 text-left font-bold text-fg border-r border-theme">Kategori</th>
                                <th class="px-6 py-3 text-left font-bold text-fg border-r border-theme">Stok</th>
                                <th class="px-6 py-3 text-left font-bold text-fg border-r border-theme">Tersedia</th>
                                <th class="px-6 py-3 text-left font-bold text-fg">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($books as $book)
                            <tr class="border-b border-theme">
                                <td class="px-6 py-4 text-fg">{{ $book->title }}</td>
                                <td class="px-6 py-4 text-fg">{{ $book->author }}</td>
                                <td class="px-6 py-4 text-fg">{{ $book->category->name }}</td>
                                <td class="px-6 py-4 text-fg">{{ $book->quantity }}</td>
                                <td class="px-6 py-4 text-fg">{{ $book->available }}</td>

                                <td class="px-6 py-4 flex gap-2">

                                    <!-- Lihat -->
                                                <a href="{{ route('books.show', $book) }}"
                                                    class="bg-blue-300 hover:bg-blue-400 dark:bg-blue-600 dark:hover:bg-blue-700 text-fg border border-theme 
                                                             px-3 py-1 rounded shadow-theme
                                                             active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                                                             transition-all text-sm font-medium">
                                        Lihat
                                    </a>

                                    <!-- Edit -->
                                                <a href="{{ route('books.edit', $book) }}"
                                                    class="bg-yellow-300 hover:bg-yellow-400 dark:bg-yellow-600 dark:hover:bg-yellow-700 border border-theme 
                                                             px-3 py-1 rounded shadow-theme
                                                             active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                                                             transition-all text-sm font-medium">
                                        Edit
                                    </a>

                                    <!-- Hapus -->
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Hapus buku ini?')"
                        class="bg-red-300 hover:bg-red-400 dark:bg-red-600 dark:hover:bg-red-700 border border-theme 
                               px-3 py-1 rounded shadow-theme
                               active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                               transition-all text-sm font-medium">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-600 dark:text-gray-300">
                                    Tidak ada data buku.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-4 py-3 bg-white border-t border-black flex items-center justify-end dark:bg-slate-800 dark:border-white/20">
                    {{ $books->links() }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
