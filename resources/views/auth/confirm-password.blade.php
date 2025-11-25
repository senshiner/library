<x-guest-layout>
    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Konfirmasi Password</h2>
        <p class="text-gray-600 text-sm mt-1">Ini adalah area aman. Silakan konfirmasi password Anda untuk melanjutkan</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-900 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                       bg-white text-gray-900" />
            @error('password')
                <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit"
                class="bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900
                       shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                       transition-all px-6 py-2 rounded-md font-medium">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-guest-layout>
