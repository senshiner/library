<x-app-layout>

    <div class="py-6 sm:py-12 bg-cyan-50 dark:bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">

                <!-- Title + Buttons -->
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Detail Anggota</h2>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Informasi lengkap tentang anggota</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('members.edit', $member) }}"
                           class="bg-yellow-300 hover:bg-yellow-400 border border-black text-gray-900
                                  shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                  active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                                  transition-all px-4 py-2 rounded-md font-medium">
                            Edit
                        </a>
                        <a href="{{ route('members.index') }}"
                           class="bg-gray-300 hover:bg-gray-400 border border-black text-gray-900
                                  shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                  active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                                  transition-all px-4 py-2 rounded-md font-medium">
                            Kembali
                        </a>
                    </div>
                </div>

                <!-- Member Detail Container -->
                <div class="bg-white border border-black rounded-lg 
                            shadow-[6px_6px_0px_rgba(0,0,0,1)] overflow-hidden dark:bg-slate-800 dark:border-white/20">

                    <div class="md:flex">
                        <!-- Member Photo Placeholder -->
                        <div class="md:w-1/3 bg-gray-100 dark:bg-slate-800 border-r border-black dark:border-white/5 flex items-center justify-center p-8">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <p class="text-gray-600">Foto Anggota</p>
                            </div>
                        </div>
                        
                        <!-- Member Details -->
                        <div class="md:w-2/3 p-6">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $member->name }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Email</label>
                                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $member->email }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Telepon</label>
                                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $member->phone ?? '-' }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Tanggal Bergabung</label>
                                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $member->join_date->format('d M Y') }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">Status</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                              {{ $member->status == 'active' ? 'bg-green-200 text-green-900 border border-green-900' : 'bg-red-200 text-red-900 border border-red-900' }}">
                                        {{ $member->status == 'active' ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Address -->
                            @if($member->address)
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-600 mb-2">Alamat</label>
                                <p class="text-gray-700 bg-gray-50 border border-gray-300 p-4 rounded-md">{{ $member->address }}</p>
                            </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center pt-4 border-t border-gray-300">
                                <div class="text-sm text-gray-600 dark:text-gray-300">
                                    Bergabung: {{ $member->created_at->diffForHumans() }}
                                </div>
                                <div class="flex gap-2">
                                    <form action="{{ route('members.destroy', $member) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Hapus anggota {{ $member->name }}?')"
                                                class="bg-red-300 hover:bg-red-400 dark:bg-red-600 dark:hover:bg-red-700 border border-black text-gray-900 dark:text-white
                                                       shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                                       active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                                                       transition-all px-4 py-2 rounded-md font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>