<x-guest-layout>
    <!-- Title -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Verifikasi Email</h2>
        <p class="text-gray-600 text-sm mt-1">Terima kasih telah mendaftar! Silakan verifikasi email Anda</p>
    </div>

    <div class="mb-6 p-4 bg-blue-50 border border-blue-300 rounded text-sm text-gray-700">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-4 bg-green-100 border border-green-600 text-green-700 rounded text-sm font-medium">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-6 flex items-center justify-between gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button type="submit"
                class="bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900
                       shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                       transition-all px-6 py-2 rounded-md font-medium">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="text-sm text-cyan-600 hover:text-cyan-700 font-medium">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
