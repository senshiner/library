<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Anggota - ') . $member->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Detail Anggota</h2>
                        <p class="text-gray-600 dark:text-gray-400">Informasi lengkap tentang anggota</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('members.edit', $member) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                            Edit
                        </a>
                        <a href="{{ route('members.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                            Kembali
                        </a>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <div class="md:flex">
                        <!-- Member Photo Placeholder -->
                        <div class="md:w-1/3 bg-gray-200 dark:bg-gray-700 flex items-center justify-center p-8">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">Foto Anggota</p>
                            </div>
                        </div>
                        
                        <!-- Member Details -->
                        <div class="md:w-2/3 p-6">
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">{{ $member->name }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Email</label>
                                    <p class="text-lg text-gray-800 dark:text-white">{{ $member->email }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Telepon</label>
                                    <p class="text-lg text-gray-800 dark:text-white">{{ $member->phone ?? '-' }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Tanggal Bergabung</label>
                                    <p class="text-lg text-gray-800 dark:text-white">{{ $member->join_date->format('d M Y') }}</p>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-400">Status</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $member->status == 'active' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                                        {{ $member->status == 'active' ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Address -->
                            @if($member->address)
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">Alamat</label>
                                <p class="text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">{{ $member->address }}</p>
                            </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-600">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    Bergabung: {{ $member->created_at->diffForHumans() }}
                                </div>
                                <div class="flex space-x-2">
                                    <form action="{{ route('members.destroy', $member) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg" 
                                                onclick="return confirm('Hapus anggota {{ $member->name }}?')">
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