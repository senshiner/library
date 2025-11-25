<x-app-layout>

    <div class="py-6 sm:py-12 bg-cyan-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">

                <!-- Title -->
                <div class="mb-6">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Tambah Buku Baru</h2>
                    <p class="text-gray-600 mt-2">Isi form berikut untuk menambah buku baru</p>
                </div>

                <!-- Form Container -->
                <div class="bg-white border border-black rounded-lg 
                            shadow-[6px_6px_0px_rgba(0,0,0,1)] p-6">

                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Judul -->
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-900 mb-2">Judul Buku *</label>
                                <input type="text" name="title" id="title" required
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white text-gray-900"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pengarang -->
                            <div class="md:col-span-2">
                                <label for="author" class="block text-sm font-medium text-gray-900 mb-2">Pengarang *</label>
                                <input type="text" name="author" id="author" required
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white text-gray-900"
                                    value="{{ old('author') }}">
                                @error('author')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-900 mb-2">Kategori *</label>
                                <select name="category_id" id="category_id" required
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white text-gray-900">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ISBN -->
                            <div>
                                <label for="isbn" class="block text-sm font-medium text-gray-900 mb-2">ISBN</label>
                                <input type="text" name="isbn" id="isbn"
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white text-gray-900"
                                    value="{{ old('isbn') }}">
                                @error('isbn')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Quantity -->
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-900 mb-2">Jumlah *</label>
                                <input type="number" name="quantity" id="quantity" required min="1"
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white text-gray-900"
                                    value="{{ old('quantity', 1) }}">
                                @error('quantity')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tahun Terbit -->
                            <div>
                                <label for="published_year" class="block text-sm font-medium text-gray-900 mb-2">Tahun Terbit</label>
                                <input type="number" name="published_year" id="published_year" min="1900" max="{{ date('Y') }}"
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white text-gray-900"
                                    value="{{ old('published_year') }}">
                                @error('published_year')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Penerbit -->
                            <div class="md:col-span-2">
                                <label for="publisher" class="block text-sm font-medium text-gray-900 mb-2">Penerbit</label>
                                <input type="text" name="publisher" id="publisher"
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white text-gray-900"
                                    value="{{ old('publisher') }}">
                                @error('publisher')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-900 mb-2">Deskripsi</label>
                                <textarea name="description" id="description" rows="3"
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white text-gray-900">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('books.index') }}" 
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
                                Simpan Buku
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>