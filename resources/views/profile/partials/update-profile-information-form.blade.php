<section>
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 mb-2">
            📝 Informasi Profil
        </h2>
        <p class="text-sm text-gray-600">
            Update data pribadi Anda termasuk nama, email, nomor telepon, dan alamat
        </p>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-bold text-gray-900 mb-2">
                📛 Nama Lengkap
            </label>
            <input id="name" name="name" type="text" 
                   class="w-full px-3 py-2 border border-black rounded-md bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-cyan-400"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-bold text-gray-900 mb-2">
                📧 Email
            </label>
            <input id="email" name="email" type="email" 
                   class="w-full px-3 py-2 border border-black rounded-md bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-cyan-400"
                   value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-yellow-50 border border-yellow-300 rounded-md text-sm text-yellow-800">
                    <p class="mb-2">⚠️ Email Anda belum diverifikasi.</p>
                    <button form="send-verification" class="text-cyan-600 hover:text-cyan-700 font-medium underline">
                        Klik di sini untuk mengirim ulang email verifikasi.
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 p-2 bg-green-50 border border-green-400 text-green-800 text-sm rounded-md">
                        ✓ Email verifikasi telah dikirim ke email Anda.
                    </p>
                @endif
            @endif
        </div>

        <!-- Phone (Member Only) -->
        @if($user->isMember() && $member)
        <div>
            <label for="phone" class="block text-sm font-bold text-gray-900 mb-2">
                📱 Nomor Telepon
            </label>
            <input id="phone" name="phone" type="text" 
                   class="w-full px-3 py-2 border border-black rounded-md bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-cyan-400"
                   value="{{ old('phone', $member->phone) }}" autocomplete="tel" />
            @error('phone')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Address (Member Only) -->
        <div>
            <label for="address" class="block text-sm font-bold text-gray-900 mb-2">
                🏠 Alamat
            </label>
            <textarea id="address" name="address" rows="3"
                      class="w-full px-3 py-2 border border-black rounded-md bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-cyan-400"
                      autocomplete="street-address">{{ old('address', $member->address) }}</textarea>
            @error('address')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex gap-3 pt-4 border-t border-gray-300">
            <button type="submit" 
                    class="flex-1 bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900 font-bold py-2 px-4 rounded-md shadow-[3px_3px_0px_rgba(0,0,0,1)] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none transition-all">
                💾 Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <div class="p-2 bg-green-50 border border-green-400 text-green-800 text-sm rounded-md">
                    ✓ Profil berhasil diupdate!
                </div>
            @endif
        </div>
    </form>
</section>
