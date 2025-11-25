<x-guest-layout>
    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Masuk</h2>
        <p class="text-gray-600 text-sm mt-1">Masuk ke akun Anda untuk melanjutkan</p>
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

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-900 mb-2">Email</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
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
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                       bg-white text-gray-900" />
            @error('password')
                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-cyan-500 focus:ring-cyan-500" />
                <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm text-cyan-600 hover:text-cyan-700 font-medium" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif

            <button type="submit"
                class="bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900
                       shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                       transition-all px-6 py-2 rounded-md font-medium">
                Masuk
            </button>
        </div>

        <!-- Register Link -->
        <div class="text-center mt-4">
            <p class="text-sm text-gray-600">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-cyan-600 hover:text-cyan-700 font-semibold">Daftar di sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>
