@extends('layouts.admin-simple')

@section('title', 'Dashboard Admin - ' . $schoolName)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/30">
    <!-- Header Dashboard dengan gradient yang menarik -->
    <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 shadow-2xl relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="mb-8 lg:mb-0">
                    <h1 class="text-5xl lg:text-6xl font-bold text-white mb-4 drop-shadow-lg">
                        Dashboard
                    </h1>
                    <p class="text-xl lg:text-2xl text-blue-100 font-medium">
                        Selamat datang kembali, <span class="text-white font-bold">{{ Auth::user()->name }}</span>!
                    </p>
                    <p class="text-blue-100 mt-2">Kelola semua konten website pondok pesantren Anda dari sini</p>
                </div>
                
                <div class="flex items-center space-x-6 bg-white/10 backdrop-blur-sm rounded-3xl p-6 border border-white/20">
                    <div class="text-center">
                        <p class="text-sm text-blue-100 font-medium">Hari ini</p>
                        <p class="text-3xl font-bold text-white">{{ now()->format('d') }}</p>
                        <p class="text-sm text-blue-100">{{ now()->format('M Y') }}</p>
                    </div>
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-calendar-alt text-white text-3xl"></i>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-blue-100 font-medium">Jam</p>
                        <p class="text-3xl font-bold text-white" id="current-time">{{ now()->format('H:i') }}</p>
                        <p class="text-sm text-blue-100">{{ now()->format('l') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards Grid dengan grid responsif -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Total Users</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $data['total_users'] ?? 0 }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-green-600 font-semibold">
                    <i class="fas fa-arrow-up mr-2"></i>
                    <span>+12% dari bulan lalu</span>
                </div>
            </div>

            <!-- Total Berita Card -->
            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 via-emerald-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-newspaper text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Total Berita</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $data['total_berita'] ?? 0 }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-green-600 font-semibold">
                    <i class="fas fa-arrow-up mr-2"></i>
                    <span>{{ $data['berita_published'] ?? 0 }} published</span>
                </div>
            </div>

            <!-- Total Agenda Card -->
            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 via-purple-600 to-violet-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-calendar-alt text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Total Agenda</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $data['total_agenda'] ?? 0 }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-blue-600 font-semibold">
                    <i class="fas fa-clock mr-2"></i>
                    <span>{{ $data['agenda_upcoming'] ?? 0 }} upcoming</span>
                </div>
            </div>

            <!-- Total Downloads Card -->
            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 via-orange-600 to-red-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-download text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Total Downloads</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $data['total_downloads'] ?? 0 }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-orange-600 font-semibold">
                    <i class="fas fa-download mr-2"></i>
                    <span>{{ $data['downloads_this_month'] ?? 0 }} bulan ini</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Aksi Cepat</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.berita.create') }}" class="group">
                    <div class="card-modern text-center p-6 hover:scale-105 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-plus text-white text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tambah Berita</h3>
                        <p class="text-sm text-gray-600">Buat berita baru untuk website</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.agenda.create') }}" class="group">
                    <div class="card-modern text-center p-6 hover:scale-105 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-calendar-plus text-white text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tambah Agenda</h3>
                        <p class="text-sm text-gray-600">Jadwalkan acara baru</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.guru-staf.create') }}" class="group">
                    <div class="card-modern text-center p-6 hover:scale-105 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-user-plus text-white text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Tambah Guru</h3>
                        <p class="text-sm text-gray-600">Tambah data guru/staf baru</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.galeri.create') }}" class="group">
                    <div class="card-modern text-center p-6 hover:scale-105 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-image text-white text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Upload Galeri</h3>
                        <p class="text-sm text-gray-600">Tambah foto ke galeri</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activities & Quick Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Activities -->
            <div class="card-modern">
                <div class="card-modern-header">
                    <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                </div>
                <div class="card-modern-body">
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-newspaper text-blue-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Berita baru ditambahkan</p>
                                <p class="text-xs text-gray-500">2 jam yang lalu</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-green-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Guru baru ditambahkan</p>
                                <p class="text-xs text-gray-500">4 jam yang lalu</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-calendar text-purple-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Agenda baru dijadwalkan</p>
                                <p class="text-xs text-gray-500">6 jam yang lalu</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-download text-orange-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">File baru diupload</p>
                                <p class="text-xs text-gray-500">1 hari yang lalu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card-modern">
                <div class="card-modern-header">
                    <h3 class="text-lg font-semibold text-gray-900">Statistik Cepat</h3>
                </div>
                <div class="card-modern-body">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Berita Diterbitkan</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $data['berita_published'] ?? 0 }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Agenda Mendatang</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $data['agenda_upcoming'] ?? 0 }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Total Guru & Staf</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $data['total_guru_staf'] ?? 0 }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">File Downloads</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $data['total_downloads'] ?? 0 }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Pesan Buku Tamu</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $data['total_buku_tamu'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="mt-8">
            <div class="card-modern">
                <div class="card-modern-header">
                    <h3 class="text-lg font-semibold text-gray-900">Status Sistem</h3>
                </div>
                <div class="card-modern-body">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-server text-green-600 text-2xl"></i>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-900 mb-1">Server</h4>
                            <span class="badge-modern-success">Online</span>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-database text-blue-600 text-2xl"></i>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-900 mb-1">Database</h4>
                            <span class="badge-modern-success">Connected</span>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-shield-alt text-purple-600 text-2xl"></i>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-900 mb-1">Security</h4>
                            <span class="badge-modern-success">Protected</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update time every minute
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = now.toLocaleTimeString('id-ID', { 
                hour: '2-digit', 
                minute: '2-digit',
                hour12: false 
            });
        }
    }
    
    // Update time every minute
    setInterval(updateTime, 60000);
    
    // Initial update
    updateTime();
</script>
@endsection
