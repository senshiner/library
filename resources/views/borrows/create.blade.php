<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Peminjaman Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Peminjaman Buku Baru</h2>
                    <p class="text-gray-600 dark:text-gray-400">Isi form untuk mencatat peminjaman buku</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <form action="{{ route('borrows.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Pilih Buku -->
                            <div>
                                <label for="book_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Buku *</label>
                                <select name="book_id" id="book_id" required
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    <option value="">Pilih Buku</option>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}" data-available="{{ $book->available }}">
                                            {{ $book->title }} - {{ $book->author }} (Tersedia: {{ $book->available }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('book_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pilih Anggota -->
                            <div>
                                <label for="member_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Anggota *</label>
                                <select name="member_id" id="member_id" required
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    <option value="">Pilih Anggota</option>
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}">
                                            {{ $member->name }} - {{ $member->email }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('member_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Pinjam -->
                            <div>
                                <label for="borrow_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Pinjam *</label>
                                <input type="date" name="borrow_date" id="borrow_date" required
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('borrow_date', date('Y-m-d')) }}">
                                @error('borrow_date')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Jatuh Tempo -->
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Jatuh Tempo *</label>
                                <input type="date" name="due_date" id="due_date" required
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}">
                                @error('due_date')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Default: 7 hari dari tanggal pinjam</p>
                            </div>

                            <!-- Catatan -->
                            <div>
                                <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catatan</label>
                                <textarea name="notes" id="notes" rows="3"
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('borrows.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 dark:bg-gray-600 dark:hover:bg-gray-700 dark:text-white px-4 py-2 rounded-md">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
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