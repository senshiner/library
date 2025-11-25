<x-app-layout>
    <div class="py-6 sm:py-12 bg-cyan-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-6 sm:mb-8">
                <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">
                    👥 Manajemen Pengguna
                </h1>
                <p class="text-sm sm:text-base text-gray-600">
                    Kelola akun pengguna dan berikan role (Admin/Member)
                </p>
            </div>

            <!-- Alert Messages -->
            @if ($message = Session::get('success'))
            <div class="mb-6 bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-[2px_2px_0px_rgba(0,0,0,0.1)]">
                <strong>✓ Sukses:</strong> {{ $message }}
            </div>
            @endif

            <!-- Users Table -->
            <div class="bg-white border border-black rounded-lg shadow-[4px_4px_0px_rgba(0,0,0,1)] sm:shadow-[8px_8px_0px_rgba(0,0,0,1)] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-100 border-b border-black">
                            <tr>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-bold text-gray-900">Nama</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-bold text-gray-900">Email</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs sm:text-sm font-bold text-gray-900">Role</th>
                                <th class="px-4 sm:px-6 py-3 text-center text-xs sm:text-sm font-bold text-gray-900">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black">
                            @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 sm:px-6 py-4 text-xs sm:text-sm text-gray-900 font-medium">
                                    {{ $user->name }}
                                </td>
                                <td class="px-4 sm:px-6 py-4 text-xs sm:text-sm text-gray-600">
                                    {{ $user->email }}
                                </td>
                                <td class="px-4 sm:px-6 py-4">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs sm:text-sm font-semibold border border-black
                                        @if($user->isAdmin())
                                            bg-purple-200 text-purple-900
                                        @else
                                            bg-blue-200 text-blue-900
                                        @endif
                                    ">
                                        {{ $user->isAdmin() ? '👤 Admin' : '📚 Member' }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 text-center">
                                    <a href="{{ route('users.edit', $user) }}"
                                       class="inline-block bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900 font-bold py-2 px-3 sm:px-4 rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)] active:translate-x-[1px] active:translate-y-[1px] active:shadow-none transition-all text-xs sm:text-sm">
                                        ✏️ Edit Role
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 sm:px-6 py-8 text-center text-gray-500 text-sm sm:text-base">
                                    Tidak ada pengguna ditemukan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Total Users Info -->
            <div class="mt-6 bg-white border border-black rounded-lg p-4 sm:p-6 shadow-[4px_4px_0px_rgba(0,0,0,1)]">
                <p class="text-xs sm:text-sm text-gray-600">
                    <strong>Total Pengguna:</strong> {{ $users->count() }} 
                    | <strong>Admin:</strong> {{ $users->where('role', 'admin')->count() }}
                    | <strong>Member:</strong> {{ $users->where('role', 'member')->count() }}
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
