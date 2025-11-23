@extends('layouts.app')

@section('title', 'Detail Anggota - ' . $member->name)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Anggota</h2>
            <p class="text-gray-600">Informasi lengkap tentang anggota</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('members.edit', $member) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('members.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="md:flex">
            <!-- Member Photo Placeholder -->
            <div class="md:w-1/3 bg-gray-200 flex items-center justify-center p-8">
                <div class="text-center">
                    <i class="fas fa-user text-6xl text-gray-400 mb-4"></i>
                    <p class="text-gray-500">Foto Anggota</p>
                </div>
            </div>
            
            <!-- Member Details -->
            <div class="md:w-2/3 p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $member->name }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Email</label>
                        <p class="text-lg text-gray-800">{{ $member->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Telepon</label>
                        <p class="text-lg text-gray-800">{{ $member->phone ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tanggal Bergabung</label>
                        <p class="text-lg text-gray-800">{{ $member->join_date->format('d M Y') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Status</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            {{ $member->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $member->status == 'active' ? 'Aktif' : 'Non-Aktif' }}
                        </span>
                    </div>
                </div>

                <!-- Address -->
                @if($member->address)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-600 mb-2">Alamat</label>
                    <p class="text-gray-700 bg-gray-50 p-4 rounded-lg">{{ $member->address }}</p>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <div class="text-sm text-gray-500">
                        Bergabung: {{ $member->created_at->diffForHumans() }}
                    </div>
                    <div class="flex space-x-2">
                        <form action="{{ route('members.destroy', $member) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg" 
                                    onclick="return confirm('Hapus anggota {{ $member->name }}?')">
                                <i class="fas fa-trash mr-2"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
