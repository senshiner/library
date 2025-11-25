<x-app-layout>

    <div class="py-6 sm:py-12 bg-cyan-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Title + Button -->
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                    Daftar Buku
                </h2>

                @if(auth()->user()->isAdmin())
                <a href="{{ route('books.create') }}"
                   class="bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900
                          shadow-[3px_3px_0px_rgba(0,0,0,1)]
                          active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                          transition-all px-4 py-2 rounded-md font-medium inline-flex items-center gap-2">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Buku
                </a>
                @endif
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="bg-green-200 border border-black shadow-[3px_3px_0px_rgba(0,0,0,1)]
                            px-4 py-3 rounded mb-4 text-gray-900 font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table Container -->
            <div class="bg-white border border-black rounded-lg 
                        shadow-[6px_6px_0px_rgba(0,0,0,1)] overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm sm:text-base">
                        <thead class="bg-gray-100 border-b border-black">
                            <tr>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Judul</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Pengarang</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Kategori</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Stok</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Tersedia</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($books as $book)
                            <tr class="border-b border-black">
                                <td class="px-6 py-4">{{ $book->title }}</td>
                                <td class="px-6 py-4">{{ $book->author }}</td>
                                <td class="px-6 py-4">{{ $book->category->name }}</td>
                                <td class="px-6 py-4">{{ $book->quantity }}</td>
                                <td class="px-6 py-4">{{ $book->available }}</td>

                                <td class="px-6 py-4 flex gap-2">

                                    <!-- Lihat -->
                                    <a href="{{ route('books.show', $book) }}"
                                       class="bg-blue-300 hover:bg-blue-400 border border-black 
                                              px-3 py-1 rounded shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                              active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                                              transition-all text-sm font-medium">
                                        👁️ Lihat
                                    </a>

                                    @if(auth()->user()->isAdmin())
                                    <!-- Edit -->
                                    <a href="{{ route('books.edit', $book) }}"
                                       class="bg-yellow-300 hover:bg-yellow-400 border border-black 
                                              px-3 py-1 rounded shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                              active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                                              transition-all text-sm font-medium">
                                        ✏️ Edit
                                    </a>

                                    <!-- Hapus -->
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Hapus buku ini?')"
                                                class="bg-red-300 hover:bg-red-400 border border-black 
                                                       px-3 py-1 rounded shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                                       active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                                                       transition-all text-sm font-medium">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                    @endif

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-600">
                                    Tidak ada data buku.
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
