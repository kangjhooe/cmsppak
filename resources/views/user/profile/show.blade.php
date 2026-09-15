@extends('layouts.user-profile')

@section('title', 'Profil User - ' . ($schoolName ?? ''))

@section('content')
<div class="p-6">
    <div class="max-w-7xl mx-auto">
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
                        <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                        <p class="text-blue-100">{{ $user->email }}</p>
                        <p class="text-blue-100">{{ ucfirst($user->role ?? 'User') }}</p>
                        <p class="text-blue-100">Bergabung sejak: {{ $user->created_at->format('d-m-Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi User -->
            <div class="px-6 py-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Informasi Profil</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Dasar -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Dasar</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="font-medium text-gray-700">Nama Lengkap:</span>
                                <p class="text-gray-900">{{ $user->name }}</p>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Email:</span>
                                <p class="text-gray-900">{{ $user->email }}</p>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Role:</span>
                                <p class="text-gray-900">{{ ucfirst($user->role ?? 'User') }}</p>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Status:</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Aktivitas -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistik Aktivitas</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-blue-600">{{ $user->created_at->diffInDays(now()) }}</div>
                                <div class="text-sm text-gray-600">Hari Bergabung</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-green-600">{{ $user->updated_at->diffInDays(now()) }}</div>
                                <div class="text-sm text-gray-600">Hari Terakhir Update</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-purple-600">{{ $user->id }}</div>
                                <div class="text-sm text-gray-600">ID User</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-orange-600">{{ $user->email_verified_at ? 'Terverifikasi' : 'Belum Verifikasi' }}</div>
                                <div class="text-sm text-gray-600">Status Email</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Aktivitas -->
                <div class="mt-6 bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Aktivitas</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                            <span class="text-gray-700">Akun dibuat pada {{ $user->created_at->format('d-m-Y H:i') }}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                            <span class="text-gray-700">Terakhir login pada {{ $user->updated_at->format('d-m-Y H:i') }}</span>
                        </div>
                        @if($user->email_verified_at)
                        <div class="flex items-center space-x-3">
                            <div class="w-2 h-2 bg-purple-400 rounded-full"></div>
                            <span class="text-gray-700">Email diverifikasi pada {{ $user->email_verified_at->format('d-m-Y H:i') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Hak Akses -->
                <div class="mt-6 bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Hak Akses</h3>
                    <div class="flex flex-wrap gap-2">
                        @if($user->role === 'admin')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                Administrator
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Kelola Semua Data
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Kelola User
                            </span>
                        @elseif($user->role === 'operator')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Operator
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Kelola Konten
                            </span>
                        @elseif($user->role === 'editor')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                Editor
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                Edit Konten
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                User
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Lihat Konten
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Informasi Keamanan -->
                <div class="mt-6 bg-gray-50 p-6 rounded-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Informasi Keamanan</h3>
                        <a href="{{ route('user.profile.change-password') }}" 
                           class="inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fas fa-key mr-2"></i>Ubah Password
                        </a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <span class="font-medium text-gray-700">Password:</span>
                            <p class="text-gray-900 mt-1">•••••••• (Terenkripsi)</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Two-Factor Auth:</span>
                            <p class="text-gray-900 mt-1">Tidak Aktif</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">Session Aktif:</span>
                            <p class="text-gray-900 mt-1">Ya</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-700">IP Address:</span>
                            <p class="text-gray-900 mt-1">{{ request()->ip() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi sekolah (jika user adalah admin/operator) -->
        @if(($user->role === 'admin' || $user->role === 'operator') && $profile)
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
            <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-6 py-6 text-white">
                <h2 class="text-2xl font-bold">Informasi {{ __('school') }}</h2>
                <p class="text-green-100">Data profil institusi yang Anda kelola</p>
            </div>
            <div class="px-6 py-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-4 bg-green-50 rounded-lg">
                        <div class="text-2xl font-bold text-green-600">{{ $profile->nama_sekolah ?? $schoolName ?? '' }}</div>
                        <div class="text-sm text-gray-600">Nama {{ __('school') }}</div>
                    </div>
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <div class="text-2xl font-bold text-blue-600">{{ $profile->npsn ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-600">NPSN</div>
                    </div>
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        <div class="text-2xl font-bold text-purple-600">{{ $profile->tahun_berdiri ?? 'N/A' }}</div>
                        <div class="text-sm text-gray-600">Tahun Berdiri</div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('admin.profile.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-edit mr-2"></i>Kelola Profil {{ __('school') }}
                    </a>
                </div>
            </div>
        </div>
        @endif

        <!-- Tombol Update Profil -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Update Profil</h3>
            <p class="text-gray-600 mb-4">Untuk mengubah informasi profil, gunakan menu pengaturan di dashboard.</p>
            <div class="flex space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </a>
                @if($user->role === 'admin' || $user->role === 'operator')
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <i class="fas fa-cog mr-2"></i>Admin Panel
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
