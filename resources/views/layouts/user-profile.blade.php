@extends('layouts.admin-simple')

@section('title', 'User Profile - ' . ($schoolName ?? ''))

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Profil User -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
            <!-- Header Profil User -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-8 text-white">
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">{{ $user->name ?? 'User' }}</h1>
                        <p class="text-blue-100">{{ $user->email ?? 'user@example.com' }}</p>
                        <p class="text-blue-100">{{ ucfirst($user->role ?? 'user') }}</p>
                        <p class="text-blue-100">Bergabung sejak: {{ $user->created_at ? $user->created_at->format('d-m-Y') : 'N/A' }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Informasi Profil -->
            <div class="px-6 py-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Dasar -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Dasar</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm font-medium text-gray-500">Nama Lengkap:</span>
                                <p class="text-gray-900">{{ $user->name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Email:</span>
                                <p class="text-gray-900">{{ $user->email ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Role:</span>
                                <p class="text-gray-900">{{ ucfirst($user->role ?? 'user') }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-500">Status:</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Statistik Aktivitas -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Aktivitas</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600">
                                    {{ $user->created_at ? $user->created_at->diffInDays(now()) : '0' }}
                                </div>
                                <div class="text-sm text-gray-600">Hari Bergabung</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600">
                                    {{ $user->updated_at ? $user->updated_at->diffInDays(now()) : '0' }}
                                </div>
                                <div class="text-sm text-gray-600">Hari Terakhir Update</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-600">{{ $user->id ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-600">ID User</div>
                            </div>
                            <div class="text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                    Terverifikasi
                                </span>
                                <div class="text-sm text-gray-600">Status Email</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Aksi -->
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Dashboard
                    </a>
                    
                    @if($user->role === 'admin' || $user->role === 'operator')
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <i class="fas fa-cog mr-2"></i>Admin Panel
                    </a>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Riwayat Aktivitas -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Riwayat Aktivitas</h3>
            </div>
            <div class="px-6 py-4">
                <p class="text-gray-500 text-center py-8">Belum ada aktivitas yang tercatat</p>
            </div>
        </div>
    </div>
</div>
@endsection
