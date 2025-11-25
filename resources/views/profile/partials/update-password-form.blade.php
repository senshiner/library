<section>
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 mb-2">
            🔐 Ubah Kata Sandi
        </h2>
        <p class="text-sm text-gray-600">
            Pastikan akun Anda menggunakan kata sandi yang kuat dan acak untuk keamanan maksimal.
        </p>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-bold text-gray-900 mb-2">
                🔑 Kata Sandi Saat Ini
            </label>
            <input id="update_password_current_password" name="current_password" type="password" 
                   class="w-full px-3 py-2 border border-black rounded-md bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-cyan-400"
                   autocomplete="current-password" />
            @if($errors->updatePassword->has('current_password'))
                <span class="text-red-600 text-sm mt-1 block">{{ $errors->updatePassword->first('current_password') }}</span>
            @endif
        </div>

        <!-- New Password -->
        <div>
            <label for="update_password_password" class="block text-sm font-bold text-gray-900 mb-2">
                ✨ Kata Sandi Baru
            </label>
            <input id="update_password_password" name="password" type="password" 
                   class="w-full px-3 py-2 border border-black rounded-md bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-cyan-400"
                   autocomplete="new-password" />
            @if($errors->updatePassword->has('password'))
                <span class="text-red-600 text-sm mt-1 block">{{ $errors->updatePassword->first('password') }}</span>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-bold text-gray-900 mb-2">
                ✓ Konfirmasi Kata Sandi
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                   class="w-full px-3 py-2 border border-black rounded-md bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-cyan-400"
                   autocomplete="new-password" />
            @if($errors->updatePassword->has('password_confirmation'))
                <span class="text-red-600 text-sm mt-1 block">{{ $errors->updatePassword->first('password_confirmation') }}</span>
            @endif
        </div>

        <!-- Action Button -->
        <div class="flex gap-3 pt-4 border-t border-gray-300">
            <button type="submit" 
                    class="flex-1 bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900 font-bold py-2 px-4 rounded-md shadow-[3px_3px_0px_rgba(0,0,0,1)] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none transition-all">
                💾 Ubah Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <div class="p-2 bg-green-50 border border-green-400 text-green-800 text-sm rounded-md">
                    ✓ Kata sandi berhasil diubah!
                </div>
            @endif
        </div>
    </form>
</section>
