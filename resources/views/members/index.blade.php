<x-app-layout>

    <div class="py-6 sm:py-12 bg-cyan-50 dark:bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Title + Button -->
            <div class="mb-6 flex justify-between items-center">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">
                    Daftar Anggota
                </h2>

                <a href="{{ route('members.create') }}"
                   class="bg-cyan-400 hover:bg-cyan-500 border border-black text-gray-900
                          shadow-[3px_3px_0px_rgba(0,0,0,1)]
                          active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                          transition-all px-4 py-2 rounded-md font-medium inline-flex items-center gap-2">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Anggota
                </a>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="bg-green-200 dark:bg-green-900 dark:text-white border border-black shadow-[3px_3px_0px_rgba(0,0,0,1)]
                            px-4 py-3 rounded mb-4 text-gray-900 font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table Container -->
            <div class="bg-white border border-black rounded-lg 
                        shadow-[6px_6px_0px_rgba(0,0,0,1)] overflow-hidden dark:bg-slate-800 dark:border-white/20">

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm sm:text-base">
                        <thead class="bg-gray-100 dark:bg-slate-700 border-b border-black">
                            <tr>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 dark:text-gray-100 border-r border-black">Nama</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Email</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Telepon</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Tanggal Bergabung</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900 border-r border-black">Status</th>
                                <th class="px-6 py-3 text-left font-bold text-gray-900">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($members as $member)
                            <tr class="border-b border-black dark:border-white/5">
                                <td class="px-6 py-4 border-r border-black text-gray-900 dark:text-gray-100">{{ $member->name }}</td>
                                <td class="px-6 py-4 border-r border-black text-gray-900 dark:text-gray-100">{{ $member->email }}</td>
                                <td class="px-6 py-4 border-r border-black text-gray-900 dark:text-gray-100">{{ $member->phone ?? '-' }}</td>
                                <td class="px-6 py-4 border-r border-black text-gray-900 dark:text-gray-100">{{ $member->join_date->format('d M Y') }}</td>
                                <td class="px-6 py-4 border-r border-black">
                                    @if($member->status == 'active')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-200 text-green-900 border border-green-900">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-200 text-red-900 border border-red-900">
                                            Non-Aktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 flex gap-2">

                                    <!-- Lihat -->
                                                <a href="{{ route('members.show', $member) }}"
                                                    class="bg-blue-300 hover:bg-blue-400 dark:bg-blue-600 dark:hover:bg-blue-700 border border-black 
                                                             px-3 py-1 rounded shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                                             active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                                                             transition-all text-sm font-medium text-gray-900 dark:text-white">
                                        Lihat
                                    </a>

                                    <!-- Edit -->
                                                <a href="{{ route('members.edit', $member) }}"
                                                    class="bg-yellow-300 hover:bg-yellow-400 dark:bg-yellow-600 dark:hover:bg-yellow-700 border border-black 
                                                             px-3 py-1 rounded shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                                             active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                                                             transition-all text-sm font-medium text-gray-900 dark:text-white">
                                        Edit
                                    </a>

                                    <!-- Hapus -->
                                    <form action="{{ route('members.destroy', $member) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Hapus anggota ini?')"
                        class="bg-red-300 hover:bg-red-400 dark:bg-red-600 dark:hover:bg-red-700 border border-black 
                               px-3 py-1 rounded shadow-[2px_2px_0px_rgba(0,0,0,1)]
                               active:translate-x-[2px] active:translate-y-[2px] active:shadow-none
                               transition-all text-sm font-medium text-gray-900 dark:text-white">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-600">
                                    Tidak ada data anggota.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>