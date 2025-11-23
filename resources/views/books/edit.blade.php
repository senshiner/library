<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Buku - ') . $book->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Buku</h2>
                    <p class="text-gray-600 dark:text-gray-400">Update informasi buku</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <form action="{{ route('books.update', $book) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Judul -->
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul Buku *</label>
                                <input type="text" name="title" id="title" required
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('title', $book->title) }}">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pengarang -->
                            <div class="md:col-span-2">
                                <label for="author" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pengarang *</label>
                                <input type="text" name="author" id="author" required
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('author', $book->author) }}">
                                @error('author')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori *</label>
                                <select name="category_id" id="category_id" required
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ISBN -->
                            <div>
                                <label for="isbn" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ISBN</label>
                                <input type="text" name="isbn" id="isbn"
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('isbn', $book->isbn) }}">
                                @error('isbn')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Quantity -->
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah *</label>
                                <input type="number" name="quantity" id="quantity" required min="1"
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('quantity', $book->quantity) }}">
                                @error('quantity')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Available -->
                            <div>
                                <label for="available" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tersedia *</label>
                                <input type="number" name="available" id="available" required min="0" max="{{ $book->quantity }}"
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('available', $book->available) }}">
                                @error('available')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimal: {{ $book->quantity }}</p>
                            </div>

                            <!-- Tahun Terbit -->
                            <div>
                                <label for="published_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tahun Terbit</label>
                                <input type="number" name="published_year" id="published_year" min="1900" max="{{ date('Y') }}"
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('published_year', $book->published_year) }}">
                                @error('published_year')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Penerbit -->
                            <div class="md:col-span-2">
                                <label for="publisher" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Penerbit</label>
                                <input type="text" name="publisher" id="publisher"
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('publisher', $book->publisher) }}">
                                @error('publisher')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                                <textarea name="description" id="description" rows="3"
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('description', $book->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('books.show', $book) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 dark:bg-gray-600 dark:hover:bg-gray-700 dark:text-white px-4 py-2 rounded-md">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                Update Buku
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>