<x-app-layout>

    <div class="py-6 sm:py-12 bg-cyan-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">

                <!-- Title -->
                <div class="mb-6">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Peminjaman Buku Baru</h2>
                    <p class="text-gray-600 mt-2">Isi form untuk mencatat peminjaman buku</p>
                </div>

                <!-- Form Container -->
                <div class="bg-white border border-black rounded-lg 
                            shadow-[6px_6px_0px_rgba(0,0,0,1)] p-6">

                    <form action="{{ route('borrows.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Pilih Buku -->
                            <div>
                                <label for="book_id" class="block text-sm font-medium text-gray-900 mb-2">Pilih Buku *</label>
                                <select name="book_id" id="book_id" required
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white text-gray-900">
                                    <option value="">Pilih Buku</option>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}" data-available="{{ $book->available }}">
                                            {{ $book->title }} - {{ $book->author }} (Tersedia: {{ $book->available }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('book_id')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pilih Anggota -->
                            <div>
                                <label for="member_id" class="block text-sm font-medium text-gray-900 mb-2">Pilih Anggota *</label>
                                <select name="member_id" id="member_id" required
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white text-gray-900">
                                    <option value="">Pilih Anggota</option>
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}">
                                            {{ $member->name }} - {{ $member->email }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('member_id')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Pinjam -->
                            <div>
                                <label for="borrow_date" class="block text-sm font-medium text-gray-900 mb-2">Tanggal Pinjam *</label>
                                <input type="date" name="borrow_date" id="borrow_date" required
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white text-gray-900"
                                    value="{{ old('borrow_date', date('Y-m-d')) }}">
                                @error('borrow_date')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Jatuh Tempo -->
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-900 mb-2">Tanggal Jatuh Tempo *</label>
                                <input type="date" name="due_date" id="due_date" required
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white text-gray-900"
                                    value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}">
                                @error('due_date')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-600">Default: 7 hari dari tanggal pinjam</p>
                            </div>

                            <!-- Catatan -->
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-900 mb-2">Catatan</label>
                                <textarea name="notes" id="notes" rows="3"
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white text-gray-900">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('borrows.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 border border-black text-gray-900
                                      shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                      active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                                      transition-all px-4 py-2 rounded-md font-medium">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900
                                           shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                                           transition-all px-4 py-2 rounded-md font-medium">
                                Simpan Peminjaman
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
    // Auto-set due date when borrow date changes
    document.getElementById('borrow_date').addEventListener('change', function() {
        const borrowDate = new Date(this.value);
        const dueDate = new Date(borrowDate);
        dueDate.setDate(dueDate.getDate() + 7); // Default 7 days
        
        document.getElementById('due_date').value = dueDate.toISOString().split('T')[0];
    });
    </script>

</x-app-layout>