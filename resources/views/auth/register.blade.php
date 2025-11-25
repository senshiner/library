<x-guest-layout>
    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Daftar</h2>
        <p class="text-gray-600 text-sm mt-1">Buat akun baru untuk menggunakan sistem</p>
    </div>

    <!-- Session Status -->
    @if ($errors->any())
        <div class="mb-4 bg-red-100 border border-red-600 text-red-700 px-4 py-3 rounded">
            <p class="font-semibold">Terjadi kesalahan:</p>
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-900 mb-2">Nama Lengkap</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                       bg-white text-gray-900" />
            @error('name')
                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                       bg-white text-gray-900" />
            @error('email')
                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-900 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                       bg-white text-gray-900" />
            @error('password')
                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-900 mb-2">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                       bg-white text-gray-900" />
            @error('password_confirmation')
                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="text-sm text-cyan-600 hover:text-cyan-700 font-medium" href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <button type="submit"
                class="bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900
                       shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                       transition-all px-6 py-2 rounded-md font-medium ms-3">
                Daftar
            </button>
        </div>
    </form>
</x-guest-layout>
