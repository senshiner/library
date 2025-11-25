<x-app-layout>
    <div class="py-6 sm:py-12 bg-cyan-50 min-h-screen flex flex-col sm:justify-start items-center pt-6 sm:pt-6">
        <div class="w-full sm:max-w-2xl px-4 sm:px-6">

            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('users.index') }}" class="inline-flex items-center text-cyan-600 hover:text-cyan-700 font-medium text-sm">
                    ← Kembali ke Daftar Pengguna
                </a>
            </div>

            <!-- Form Card -->
            <div class="bg-white border border-black rounded-lg shadow-[6px_6px_0px_rgba(0,0,0,1)] p-6 sm:p-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">
                    ✏️ Edit Role Pengguna
                </h1>
                <p class="text-gray-600 mb-6">
                    Ubah role untuk pengguna: <strong>{{ $user->name }}</strong>
                </p>

                <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- User Info (Read-only) -->
                    <div class="space-y-4 p-4 bg-gray-50 border border-black rounded-md">
                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-2">
                                📝 Nama Pengguna
                            </label>
                            <input type="text" value="{{ $user->name }}" disabled 
                                   class="w-full px-3 py-2 border border-black rounded-md bg-white text-gray-600 cursor-not-allowed text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-900 mb-2">
                                📧 Email
                            </label>
                            <input type="email" value="{{ $user->email }}" disabled 
                                   class="w-full px-3 py-2 border border-black rounded-md bg-white text-gray-600 cursor-not-allowed text-sm">
                        </div>
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <label for="role" class="block text-sm font-bold text-gray-900 mb-3">
                            👥 Pilih Role
                        </label>
                        <div class="space-y-3">
                            <!-- Admin Option -->
                            <label class="flex items-center p-4 border-2 border-black rounded-lg cursor-pointer transition-all
                                {{ old('role', $user->role) === 'admin' ? 'bg-purple-100' : 'bg-white hover:bg-gray-50' }}">
                                <input type="radio" name="role" value="admin" 
                                       {{ old('role', $user->role) === 'admin' ? 'checked' : '' }}
                                       class="w-4 h-4 border-black cursor-pointer">
                                <div class="ms-4">
                                    <span class="block font-semibold text-gray-900">👤 Admin</span>
                                    <span class="block text-sm text-gray-600">Akses penuh ke semua fitur (Books, Members, Borrows, User Management)</span>
                                </div>
                            </label>

                            <!-- Member Option -->
                            <label class="flex items-center p-4 border-2 border-black rounded-lg cursor-pointer transition-all
                                {{ old('role', $user->role) === 'member' ? 'bg-blue-100' : 'bg-white hover:bg-gray-50' }}">
                                <input type="radio" name="role" value="member" 
                                       {{ old('role', $user->role) === 'member' ? 'checked' : '' }}
                                       class="w-4 h-4 border-black cursor-pointer">
                                <div class="ms-4">
                                    <span class="block font-semibold text-gray-900">📚 Member</span>
                                    <span class="block text-sm text-gray-600">Akses terbatas (Lihat Buku, Membuat Peminjaman)</span>
                                </div>
                            </label>
                        </div>

                        @error('role')
                        <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit" 
                                class="flex-1 bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900 font-bold py-3 px-4 rounded-lg shadow-[4px_4px_0px_rgba(0,0,0,1)] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none transition-all">
                            💾 Simpan Perubahan
                        </button>
                        <a href="{{ route('users.index') }}"
                           class="flex-1 bg-gray-300 hover:bg-gray-400 border border-black text-gray-900 font-bold py-3 px-4 rounded-lg shadow-[4px_4px_0px_rgba(0,0,0,1)] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none transition-all text-center">
                            ✕ Batal
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
