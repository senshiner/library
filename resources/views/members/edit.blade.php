<x-app-layout>

    <div class="py-6 sm:py-12 bg-cyan-50 dark:bg-slate-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">

                <!-- Title -->
                <div class="mb-6">
                    <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">Edit Anggota</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-2">Update informasi anggota</p>
                </div>

                <!-- Form Container -->
                <div class="bg-white border border-black rounded-lg 
                            shadow-[6px_6px_0px_rgba(0,0,0,1)] p-6 dark:bg-slate-800 dark:border-white/20">

                    <form action="{{ route('members.update', $member) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Nama -->
                            <div>
                    <label for="name" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Nama Lengkap *</label>
                    <input type="text" name="name" id="name" required
                     class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                         py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                         bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 dark:border-white/10"
                     value="{{ old('name', $member->name) }}">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                    <label for="email" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Email *</label>
                    <input type="email" name="email" id="email" required
                     class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                         py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                         bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 dark:border-white/10"
                     value="{{ old('email', $member->email) }}">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Telepon -->
                            <div>
                    <label for="phone" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Nomor Telepon</label>
                    <input type="text" name="phone" id="phone"
                     class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                         py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                         bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 dark:border-white/10"
                     value="{{ old('phone', $member->phone) }}">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Alamat -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Alamat</label>
                                <textarea name="address" id="address" rows="3"
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 dark:border-white/10">{{ old('address', $member->address) }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal Bergabung -->
                            <div>
                    <label for="join_date" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Tanggal Bergabung *</label>
                    <input type="date" name="join_date" id="join_date" required
                     class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                         py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                         bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 dark:border-white/10"
                     value="{{ old('join_date', $member->join_date->format('Y-m-d')) }}">
                                @error('join_date')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-2">Status *</label>
                                <select name="status" id="status" required
                                    class="block w-full border border-black rounded-md shadow-[2px_2px_0px_rgba(0,0,0,1)]
                                           py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500
                                           bg-white dark:bg-slate-800 text-gray-900 dark:text-gray-100 dark:border-white/10">
                                    <option value="">Pilih Status</option>
                                    <option value="active" {{ old('status', $member->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status', $member->status) == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('members.show', $member) }}" 
                   class="bg-gray-300 hover:bg-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600 border border-black text-gray-900 dark:text-gray-100
                       shadow-[2px_2px_0px_rgba(0,0,0,1)]
                       active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                       transition-all px-4 py-2 rounded-md font-medium">
                                Batal
                            </a>
                <button type="submit" 
                     class="bg-cyan-400 hover:bg-cyan-500 dark:bg-cyan-600 dark:hover:bg-cyan-700 border border-black text-gray-900 dark:text-gray-100
                         shadow-[2px_2px_0px_rgba(0,0,0,1)]
                         active:translate-x-[1px] active:translate-y-[1px] active:shadow-none
                         transition-all px-4 py-2 rounded-md font-medium">
                                Update Anggota
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>