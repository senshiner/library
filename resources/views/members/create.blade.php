<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Anggota Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Tambah Anggota Baru</h2>
                    <p class="text-gray-600 dark:text-gray-400">Isi form berikut untuk menambah anggota baru</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <form action="{{ route('members.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Nama -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap *</label>
                                <input type="text" name="name" id="name" required
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email *</label>
                                <input type="email" name="email" id="email" required
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Telepon -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Telepon</label>
                                <input type="text" name="phone" id="phone"
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                                <textarea name="address" id="address" rows="3"
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Bergabung -->
                            <div>
                                <label for="join_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Bergabung *</label>
                                <input type="date" name="join_date" id="join_date" required
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('join_date', date('Y-m-d')) }}">
                                @error('join_date')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status *</label>
                                <select name="status" id="status" required
                                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                    <option value="">Pilih Status</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('members.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 dark:bg-gray-600 dark:hover:bg-gray-700 dark:text-white px-4 py-2 rounded-md">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                Simpan Anggota
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>