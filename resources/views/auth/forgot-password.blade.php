<x-guest-layout>
    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Lupa Password</h2>
        <p class="text-gray-600 text-sm mt-1">Tidak masalah! Masukkan email Anda dan kami akan mengirimkan link untuk mereset password</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 bg-green-100 border border-green-600 text-green-700 px-4 py-3 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus
                class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                       bg-white text-gray-900" />
            @error('email')
                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-cyan-600 hover:text-cyan-700 font-medium">
                Kembali ke login
            </a>

            <button type="submit"
                class="bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900
                       shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                       transition-all px-6 py-2 rounded-md font-medium">
                Kirim Link Reset
            </button>
        </div>
    </form>
</x-guest-layout>
