@extends('layouts.admin-simple')

@section('title', 'Profil User - ' . $schoolName)

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section dengan Breadcrumb -->
        <div class="mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors">
                            <i class="fas fa-home mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="text-sm font-medium text-gray-500">Profil User</span>
                        </div>
                    </li>
                </ol>
            </nav>
            
            <div class="mt-4">
                <h1 class="text-3xl font-bold text-gray-900">Profil User</h1>
                <p class="mt-2 text-lg text-gray-600">Kelola dan lihat informasi profil Anda</p>
            </div>
        </div>

        <!-- Profile Hero Card -->
        <div class="bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 rounded-3xl shadow-2xl overflow-hidden mb-8">
            <div class="relative px-8 py-12">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                </div>
                
                <div class="relative z-10 flex flex-col lg:flex-row items-center lg:items-start space-y-6 lg:space-y-0 lg:space-x-8">
                    <!-- Profile Avatar -->
                    <div class="relative">
                        <div class="w-32 h-32 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border-4 border-white/30 shadow-2xl">
                            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-4xl font-bold text-blue-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <!-- Status Indicator -->
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-400 rounded-full border-4 border-white flex items-center justify-center">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                    </div>
                    
                    <!-- Profile Info -->
                    <div class="text-center lg:text-left flex-1">
                        <h2 class="text-4xl font-bold text-white mb-2">{{ Auth::user()->name }}</h2>
                        <p class="text-xl text-blue-100 mb-3">{{ Auth::user()->email }}</p>
                        
                        <div class="flex flex-wrap justify-center lg:justify-start gap-3 mb-4">
                            <span class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium text-white border border-white/30">
                                <i class="fas fa-user-tag mr-2"></i>
                                {{ ucfirst(Auth::user()->role ?? 'User') }}
                            </span>
                            <span class="inline-flex items-center px-4 py-2 bg-green-500/20 backdrop-blur-sm rounded-full text-sm font-medium text-green-100 border border-green-400/30">
                                <i class="fas fa-circle mr-2 text-green-300"></i>
                                Aktif
                            </span>
                        </div>
                        
                        <p class="text-blue-100 text-lg">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            Bergabung sejak {{ Auth::user()->created_at->format('d-m-Y') }}
                        </p>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="flex flex-col space-y-3">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl text-white font-medium hover:bg-white/30 transition-all duration-200 hover:scale-105">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                        @if(Auth::user()->role === 'admin' || Auth::user()->role === 'operator')
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-xl text-white font-medium hover:from-green-600 hover:to-emerald-700 transition-all duration-200 hover:scale-105 shadow-lg">
                            <i class="fas fa-cog mr-2"></i>
                            Admin Panel
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Basic Info & Stats -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Basic Information Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-info-circle text-blue-500 mr-3"></i>
                            Informasi Dasar
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                    <span class="text-sm font-medium text-gray-600">Nama Lengkap</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                    <span class="text-sm font-medium text-gray-600">Email</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                    <span class="text-sm font-medium text-gray-600">Role</span>
                                    <span class="text-sm font-semibold text-gray-900">{{ ucfirst(Auth::user()->role ?? 'User') }}</span>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                    <span class="text-sm font-medium text-gray-600">Status</span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Aktif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Statistics Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-100 border-b border-blue-200">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-chart-line text-blue-500 mr-3"></i>
                            Statistik Aktivitas
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl border border-blue-200">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                    <i class="fas fa-calendar-day text-white text-xl"></i>
                                </div>
                                <div class="text-3xl font-bold text-blue-600 mb-1">{{ Auth::user()->created_at->diffInDays(now()) }}</div>
                                <div class="text-sm text-gray-600">Hari Bergabung</div>
                            </div>
                            
                            <div class="text-center p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl border border-green-200">
                                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                    <i class="fas fa-clock text-white text-xl"></i>
                                </div>
                                <div class="text-3xl font-bold text-green-600 mb-1">{{ Auth::user()->updated_at->diffInDays(now()) }}</div>
                                <div class="text-sm text-gray-600">Hari Update</div>
                            </div>
                            
                            <div class="text-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl border border-purple-200">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                    <i class="fas fa-id-card text-white text-xl"></i>
                                </div>
                                <div class="text-3xl font-bold text-purple-600 mb-1">{{ Auth::user()->id }}</div>
                                <div class="text-sm text-gray-600">ID User</div>
                            </div>
                            
                            <div class="text-center p-4 bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl border border-orange-200">
                                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                    <i class="fas fa-shield-alt text-white text-xl"></i>
                                </div>
                                <div class="text-lg font-bold text-orange-600 mb-1">
                                    {{ Auth::user()->email_verified_at ? 'Terverifikasi' : 'Belum' }}
                                </div>
                                <div class="text-sm text-gray-600">Status Email</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity History Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-emerald-50 to-teal-100 border-b border-emerald-200">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-history text-emerald-500 mr-3"></i>
                            Riwayat Aktivitas
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-xl border border-green-200">
                                <div class="w-3 h-3 bg-green-400 rounded-full mr-4"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Akun dibuat</p>
                                    <p class="text-xs text-gray-600">{{ Auth::user()->created_at->format('d-m-Y H:i') }}</p>
                                </div>
                                <i class="fas fa-user-plus text-green-500"></i>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                                <div class="w-3 h-3 bg-blue-400 rounded-full mr-4"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Terakhir login</p>
                                    <p class="text-xs text-gray-600">{{ Auth::user()->updated_at->format('d-m-Y H:i') }}</p>
                                </div>
                                <i class="fas fa-sign-in-alt text-blue-500"></i>
                            </div>
                            
                            @if(Auth::user()->email_verified_at)
                            <div class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl border border-purple-200">
                                <div class="w-3 h-3 bg-purple-400 rounded-full mr-4"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Email diverifikasi</p>
                                    <p class="text-xs text-gray-600">{{ Auth::user()->email_verified_at->format('d-m-Y H:i') }}</p>
                                </div>
                                <i class="fas fa-check-circle text-purple-500"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Permissions & Security -->
            <div class="space-y-8">
                <!-- Permissions Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-amber-50 to-orange-100 border-b border-amber-200">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-key text-amber-500 mr-3"></i>
                            Hak Akses
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            @if(Auth::user()->role === 'admin')
                                <span class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-red-100 to-red-200 text-red-800 text-sm font-medium rounded-xl border border-red-200">
                                    <i class="fas fa-crown mr-2"></i>
                                    Administrator
                                </span>
                                <span class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 text-sm font-medium rounded-xl border border-blue-200">
                                    <i class="fas fa-database mr-2"></i>
                                    Kelola Semua Data
                                </span>
                                <span class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-100 to-green-200 text-green-800 text-sm font-medium rounded-xl border border-green-200">
                                    <i class="fas fa-users-cog mr-2"></i>
                                    Kelola User
                                </span>
                            @elseif(Auth::user()->role === 'operator')
                                <span class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 text-sm font-medium rounded-xl border border-blue-200">
                                    <i class="fas fa-cogs mr-2"></i>
                                    Operator
                                </span>
                                <span class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-100 to-green-200 text-green-800 text-sm font-medium rounded-xl border border-green-200">
                                    <i class="fas fa-edit mr-2"></i>
                                    Kelola Konten
                                </span>
                            @elseif(Auth::user()->role === 'editor')
                                <span class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-green-100 to-green-200 text-green-800 text-sm font-medium rounded-xl border border-green-200">
                                    <i class="fas fa-pen mr-2"></i>
                                    Editor
                                </span>
                                <span class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 text-sm font-medium rounded-xl border border-yellow-200">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit Konten
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 text-sm font-medium rounded-xl border border-gray-200">
                                    <i class="fas fa-user mr-2"></i>
                                    User
                                </span>
                                <span class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 text-sm font-medium rounded-xl border border-blue-200">
                                    <i class="fas fa-eye mr-2"></i>
                                    Lihat Konten
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Security Info Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-red-50 to-pink-100 border-b border-red-200">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-shield-alt text-red-500 mr-3"></i>
                            Informasi Keamanan
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                <span class="text-sm font-medium text-gray-600">Password</span>
                                <span class="text-sm text-gray-900">•••••••• (Terenkripsi)</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                <span class="text-sm font-medium text-gray-600">Two-Factor Auth</span>
                                <span class="text-sm text-gray-900">Tidak Aktif</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                <span class="text-sm font-medium text-gray-600">Session Aktif</span>
                                <span class="text-sm text-gray-900">Ya</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                <span class="text-sm font-medium text-gray-600">IP Address</span>
                                <span class="text-sm text-gray-900">{{ request()->ip() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-100 border-b border-indigo-200">
                        <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-rocket text-indigo-500 mr-3"></i>
                            Aksi Cepat
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('admin.dashboard') }}" class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 border border-transparent rounded-xl font-medium text-white hover:from-blue-600 hover:to-blue-700 transition-all duration-200 hover:scale-105 shadow-lg">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard
                            </a>
                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'operator')
                            <a href="{{ route('admin.dashboard') }}" class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-600 border border-transparent rounded-xl font-medium text-white hover:from-green-600 hover:to-emerald-700 transition-all duration-200 hover:scale-105 shadow-lg">
                                <i class="fas fa-cog mr-2"></i>
                                Admin Panel
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
