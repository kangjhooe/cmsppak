<!DOCTYPE html>
<html lang="id">
<head>
    
    <!-- Favicon -->
    @php
        $faviconUrl = ($profile && $profile->favicon) ? asset('storage/' . $profile->favicon) : asset('favicon.ico');
        $faviconPng = ($profile && $profile->favicon) ? asset('storage/' . $profile->favicon) : asset('favicon-256x256.png');
    @endphp
    <link rel="icon" type="image/x-icon" href="{{ $faviconUrl }}">
    @if($profile && $profile->favicon)
        <link rel="icon" type="image/png" href="{{ $faviconUrl }}">
    @else
        <link rel="icon" type="image/svg+xml" href="{{ asset("favicon.svg") }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("favicon-16x16.png") }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset("favicon-32x32.png") }}">
        <link rel="icon" type="image/png" sizes="48x48" href="{{ asset("favicon-48x48.png") }}">
        <link rel="icon" type="image/png" sizes="64x64" href="{{ asset("favicon-64x64.png") }}">
        <link rel="icon" type="image/png" sizes="128x128" href="{{ asset("favicon-128x128.png") }}">
        <link rel="icon" type="image/png" sizes="256x256" href="{{ asset("favicon-256x256.png") }}">
    @endif
    
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $faviconPng }}">
    
    <!-- Android Chrome -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ $faviconPng }}">
    
    <!-- Web App Manifest -->
    <link rel="manifest" href="{{ route('webmanifest') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $schoolName)</title>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Theme Consistency CSS -->
    <link rel="stylesheet" href="{{ asset('css/theme-consistency.css') }}">
    
    <!-- Fallback CDN jika Vite tidak tersedia -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
        }
        .menu-item {
            position: relative;
            transition: all 0.3s ease;
        }
        .menu-item::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #feca57);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .menu-item:hover::before {
            width: 100%;
        }
        .menu-item:hover {
            transform: translateY(-2px);
        }
        .rainbow-text {
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #feca57, #ff9ff3);
            background-size: 400% 400%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: rainbow 3s ease-in-out infinite;
        }
        @keyframes rainbow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        /* Animasi untuk Modal */
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Hover effects untuk cards */
        .group:hover .group-hover\:scale-105 {
            transform: scale(1.05);
        }
        
        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Custom scrollbar untuk modal */
        .overflow-y-auto::-webkit-scrollbar {
            width: 8px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
            border-radius: 4px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to bottom, #2563eb, #7c3aed);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header dengan Menu Bar yang Berwarna -->
    <header class="bg-white shadow-lg border-b-4 border-gradient-to-r from-blue-500 via-purple-500 to-pink-500">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <!-- Logo dan Nama {{ __('school') }} -->
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg floating">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold rainbow-text">{{ $schoolName }}</h1>
                        <p class="text-sm text-gray-600 font-medium">Membentuk Generasi Unggul</p>
                    </div>
                </div>

                <!-- Menu Bar yang Berwarna dan Menarik -->
                <nav class="hidden md:flex space-x-1">
                    <!-- Beranda -->
                    <a href="#" class="menu-item px-6 py-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:from-blue-600 hover:to-blue-700 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-home mr-2"></i>
                        Beranda
                    </a>

                    <!-- Profil -->
                    <a href="#" class="menu-item px-6 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 text-white font-semibold hover:from-purple-600 hover:to-purple-700 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-info-circle mr-2"></i>
                        Profil
                    </a>

                    <!-- Berita -->
                    <a href="#" class="menu-item px-6 py-3 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold hover:from-orange-600 hover:to-orange-700 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-newspaper mr-2"></i>
                        Berita
                    </a>

                    <!-- Agenda -->
                    <a href="#" class="menu-item px-6 py-3 rounded-xl bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold hover:from-red-600 hover:to-red-700 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-calendar mr-2"></i>
                        Agenda
                    </a>

                    <!-- Galeri -->
                    <a href="#" class="menu-item px-6 py-3 rounded-xl bg-gradient-to-r from-pink-500 to-pink-600 text-white font-semibold hover:from-pink-600 hover:to-pink-700 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-images mr-2"></i>
                        Galeri
                    </a>

                    <!-- Downloads -->
                    <a href="#" class="menu-item px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-indigo-600 text-white font-semibold hover:from-indigo-600 hover:to-indigo-700 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-download mr-2"></i>
                        Downloads
                    </a>

                    <!-- Kontak -->
                    <a href="#" class="menu-item px-6 py-3 rounded-xl bg-gradient-to-r from-teal-500 to-teal-600 text-white font-semibold hover:from-teal-600 hover:to-teal-700 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-envelope mr-2"></i>
                        Kontak
                    </a>
                </nav>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button class="text-gray-600 hover:text-gray-900 focus:outline-none focus:text-gray-900">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div class="md:hidden py-4 border-t" style="border-color: var(--color-border);">
                <div class="grid grid-cols-2 gap-2">
                    <a href="#" class="px-4 py-3 rounded-lg text-white font-semibold text-center text-sm shadow-md" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);">
                        <i class="fas fa-home mr-2"></i>Beranda
                    </a>
                    <a href="#" class="px-4 py-3 rounded-lg text-white font-semibold text-center text-sm shadow-md" style="background: linear-gradient(135deg, var(--color-secondary) 0%, var(--color-secondary-dark) 100%);">
                        <i class="fas fa-info-circle mr-2"></i>Profil
                    </a>
                    <a href="#" class="px-4 py-3 rounded-lg text-white font-semibold text-center text-sm shadow-md" style="background: linear-gradient(135deg, var(--color-warning) 0%, #d97706 100%);">
                        <i class="fas fa-newspaper mr-2"></i>Berita
                    </a>
                    <a href="#" class="px-4 py-3 rounded-lg text-white font-semibold text-center text-sm shadow-md" style="background: linear-gradient(135deg, var(--color-error) 0%, #dc2626 100%);">
                        <i class="fas fa-calendar mr-2"></i>Agenda
                    </a>
                    <a href="#" class="px-4 py-3 rounded-lg text-white font-semibold text-center text-sm shadow-md" style="background: linear-gradient(135deg, #ec4899 0%, #be185d 100%);">
                        <i class="fas fa-images mr-2"></i>Galeri
                    </a>
                    <a href="#" class="px-4 py-3 rounded-lg text-white font-semibold text-center text-sm shadow-md" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);">
                        <i class="fas fa-download mr-2"></i>Downloads
                    </a>
                    <a href="#" class="px-4 py-3 rounded-lg text-white font-semibold text-center text-sm shadow-md" style="background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);">
                        <i class="fas fa-envelope mr-2"></i>Kontak
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-white py-8 mt-16" style="background-color: #1e293b;">
        <div class="container mx-auto px-4 text-center">
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Hubungi Kami</h3>
                <div class="flex justify-center space-x-6 mb-4">
                    @if($profile?->telepon_url)
                    <a href="{{ $profile->telepon_url }}" class="text-gray-300 hover:text-white transition-colors duration-200">
                        <i class="fas fa-phone text-xl"></i>
                    </a>
                    @endif
                    @if($profile?->whatsapp_url)
                    <a href="{{ $profile->whatsapp_url }}" target="_blank" rel="noopener noreferrer" class="text-gray-300 hover:text-green-400 transition-colors duration-200">
                        <i class="fab fa-whatsapp text-xl"></i>
                    </a>
                    @endif
                    @if($profile?->email)
                    <a href="mailto:{{ $profile->email }}" class="text-gray-300 hover:text-white transition-colors duration-200">
                        <i class="fas fa-envelope text-xl"></i>
                    </a>
                    @endif
                </div>
                
                <!-- Detail Kontak -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="text-left">
                        <h4 class="font-semibold text-school-400 mb-2">Alamat Lengkap</h4>
                        <p class="text-gray-300 text-sm leading-relaxed">
                            {{ $profile?->alamat ?: 'Alamat belum tersedia' }}
                        </p>
                    </div>
                    <div class="text-left">
                        <h4 class="font-semibold text-school-400 mb-2">Kontak</h4>
                        <div class="space-y-2 text-sm text-gray-300">
                            @if($profile?->telepon)
                                <p><i class="fas fa-phone mr-2 text-school-400"></i>{{ $profile->telepon }}</p>
                            @endif
                            @if($profile?->email)
                                <p><i class="fas fa-envelope mr-2 text-school-400"></i>{{ $profile->email }}</p>
                            @endif
                            @if($profile?->website)
                                <p><i class="fas fa-globe mr-2 text-school-400"></i>{{ $profile->website }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Koordinat GPS -->
                @if($profile?->koordinat_lat && $profile?->koordinat_lng)
                <div class="bg-gray-700 rounded-lg p-4 mb-6">
                    <h4 class="font-semibold text-school-400 mb-2">Lokasi GPS</h4>
                    <div class="flex flex-wrap justify-center gap-4 text-sm">
                        <span class="bg-gray-600 px-3 py-1 rounded">
                            <i class="fas fa-map-marker-alt mr-2 text-red-400"></i>
                            Lat: {{ $profile->koordinat_lat }}
                        </span>
                        <span class="bg-gray-600 px-3 py-1 rounded">
                            <i class="fas fa-map-marker-alt mr-2 text-blue-400"></i>
                            Lng: {{ $profile->koordinat_lng }}
                        </span>
                        @if($profile->koordinat_alt)
                        <span class="bg-gray-600 px-3 py-1 rounded">
                            <i class="fas fa-mountain mr-2 text-green-400"></i>
                            Alt: {{ $profile->koordinat_alt }}m dpl
                        </span>
                        @endif
                    </div>
                    <div class="flex justify-center gap-3 mt-3">
                        @if($profile->google_maps_url)
                        <a href="{{ $profile->google_maps_url }}" 
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fab fa-google mr-2"></i>
                            Google Maps
                        </a>
                        @endif
                        @if($profile->waze_url)
                        <a href="{{ $profile->waze_url }}" 
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-lg hover:bg-blue-600 transition-colors duration-200">
                            <i class="fas fa-car mr-2"></i>
                            Waze
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
            
            <div class="border-t border-gray-700 pt-6">
                <p class="text-gray-400 mb-2">&copy; {{ date('Y') }} {{ $schoolName }}. Semua hak dilindungi.</p>
                <div class="flex items-center justify-center space-x-2 text-sm">
                    <span class="text-gray-500">&lt;/&gt;</span>
                    <span class="text-gray-400">developed by</span>
                    <a href="https://www.kangjhooe.com" 
                       target="_blank" 
                       class="text-school-400 hover:text-school-300 font-semibold transition-colors duration-200">
                        kangjhooe
                    </a>
                    <span class="text-gray-400">cms</span>
                    <button onclick="showFeatures()" 
                            class="text-blue-400 hover:text-blue-300 font-semibold transition-colors duration-200 cursor-pointer">
                        v1.3
                    </button>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal Fitur Aplikasi -->
    <div id="featuresModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto transform transition-all duration-500 scale-95 opacity-0" id="modalContent">
                <!-- Header Modal dengan Gradient yang Lebih Menarik -->
                <div class="bg-gradient-to-br from-blue-600 via-purple-600 to-pink-600 text-white p-6 rounded-t-3xl relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-0 left-0 w-24 h-24 bg-white rounded-full -translate-x-12 -translate-y-12"></div>
                        <div class="absolute top-0 right-0 w-20 h-20 bg-yellow-300 rounded-full translate-x-10 -translate-y-10"></div>
                        <div class="absolute bottom-0 left-0 w-16 h-16 bg-green-300 rounded-full -translate-x-8 translate-y-8"></div>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div class="animate-fade-in-up">
                                <div class="flex items-center mb-3">
                                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-3 backdrop-blur-sm">
                                        <span class="text-2xl">🚀</span>
                                    </div>
                                    <div>
                                        <h2 class="text-2xl font-bold bg-gradient-to-r from-yellow-300 to-pink-300 bg-clip-text text-transparent">
                                            Fitur Aplikasi CMS
                                        </h2>
                                        <p class="text-lg text-blue-100 mt-1">{{ $schoolName }}</p>
                                    </div>
                                </div>
                                <p class="text-blue-100 text-base">Versi 1.3 - Sistem Manajemen Konten {{ __('school') }} Terdepan</p>
                            </div>
                            <button onclick="hideFeatures()" class="text-white hover:text-yellow-300 text-2xl transition-all duration-300 hover:scale-110 bg-white/20 p-2 rounded-full backdrop-blur-sm">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Content Modal dengan Warna yang Lebih Menarik -->
                <div class="p-6 bg-gradient-to-br from-gray-50 to-blue-50">
                    <!-- Pembaruan Versi 1.3 -->
                    <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-6 border border-emerald-200 mb-6">
                        <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-sparkles text-emerald-500 mr-3 text-2xl"></i>
                            Pembaruan Versi 1.3
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="flex items-start space-x-3">
                                <div class="w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-gray-700 font-medium">Slider Beranda yang Dikelola</p>
                                    <p class="text-gray-600 text-sm">Hero slider beranda kini diatur dari admin: gambar, judul, tautan, urutan, dan status tampil</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-gray-700 font-medium">Widget Beranda</p>
                                    <p class="text-gray-600 text-sm">Waktu sholat, kalender Hijriyah, agenda terdekat, tautan cepat, dan HTML kustom di sisi beranda</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-gray-700 font-medium">Halaman Legal</p>
                                    <p class="text-gray-600 text-sm">Kebijakan privasi, syarat layanan, dan kebijakan cookie yang lebih lengkap di footer</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-gray-700 font-medium">Beranda & Galeri</p>
                                    <p class="text-gray-600 text-sm">Tampilan beranda diperbarui, galeri lebih fleksibel, dan tema halaman lebih konsisten</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Riwayat Versi -->
                    <div class="bg-gradient-to-br from-gray-50 to-slate-50 rounded-2xl p-6 border border-gray-200 mb-6">
                        <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-history text-gray-500 mr-3 text-2xl"></i>
                            Riwayat Versi
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Versi 1.3 (Current) -->
                            <div class="bg-white rounded-xl p-4 border-l-4 border-emerald-500 shadow-sm">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-sm font-bold">v1.3</span>
                                        <span class="text-gray-700 font-semibold text-sm">Versi Terkini</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 text-xs mb-2">15 September 2026</p>
                                <p class="text-gray-600 text-sm">Slider beranda, widget waktu sholat & Hijriyah, halaman legal, dan penyegaran tampilan</p>
                            </div>

                            <!-- Versi 1.2 -->
                            <div class="bg-white rounded-xl p-4 border-l-4 border-blue-400 shadow-sm opacity-75">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-bold">v1.2</span>
                                        <span class="text-gray-600 text-sm">Versi Sebelumnya</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 text-xs mb-2">Januari 2025</p>
                                <p class="text-gray-600 text-sm">Peningkatan performa, perbaikan UI/UX, keamanan ditingkatkan, dan fitur baru</p>
                            </div>
                            
                            <!-- Versi 1.1 -->
                            <div class="bg-white rounded-xl p-4 border-l-4 border-slate-300 shadow-sm opacity-75">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm font-bold">v1.1</span>
                                        <span class="text-gray-600 text-sm">Versi Sebelumnya</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 text-xs mb-2">Januari 2025</p>
                                <p class="text-gray-600 text-sm">Rilis stabil pertama dengan fitur lengkap CMS untuk sekolah</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Frontend Features dengan Warna yang Lebih Menarik -->
                        <div class="space-y-4">
                            <div class="text-center mb-4">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 flex items-center justify-center">
                                    <span class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-3 text-white">
                                        <i class="fas fa-globe text-lg"></i>
                                    </span>
                                    Frontend Features
                                </h3>
                                <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full mx-auto"></div>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-blue-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 flex-shrink-0" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);">
                                            <i class="fas fa-home text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-blue-600 transition-colors duration-300">Beranda Interaktif</h4>
                                            <p class="text-gray-600 mt-1 text-sm">Hero section yang memukau, berita terbaru, agenda {{ __('school') }}, dan statistik yang informatif</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-green-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <i class="fas fa-info-circle text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-green-600 transition-colors duration-300">Profil {{ __('school') }}</h4>
                                            <p class="text-gray-600 mt-1 text-sm">Visi, misi, sejarah, dan struktur organisasi yang lengkap dan terstruktur</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-orange-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <i class="fas fa-newspaper text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-orange-600 transition-colors duration-300">Berita & Artikel</h4>
                                            <p class="text-gray-600 mt-1 text-sm">Sistem berita canggih dengan kategori, tag, dan fitur pencarian</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-red-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <i class="fas fa-calendar-alt text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-red-600 transition-colors duration-300">Agenda & Event</h4>
                                            <p class="text-gray-600 mt-1 text-sm">Kalender kegiatan {{ __('school') }} yang interaktif dan mudah diakses</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-pink-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <i class="fas fa-images text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-pink-600 transition-colors duration-300">Galeri Media</h4>
                                            <p class="text-gray-600 mt-1 text-sm">Foto dan video kegiatan {{ __('school') }} dengan tampilan yang memukau</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-indigo-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <i class="fas fa-download text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-indigo-600 transition-colors duration-300">Download Center</h4>
                                            <p class="text-gray-600 mt-1 text-sm">Formulir dan dokumen penting dengan sistem kategori yang terorganisir</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-teal-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-teal-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <i class="fas fa-map-marker-alt text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-teal-600 transition-colors duration-300">Kontak & Lokasi</h4>
                                            <p class="text-gray-600 mt-1 text-sm">GPS, Google Maps, Waze integration dengan tampilan yang informatif</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Admin Features dengan Warna yang Lebih Menarik -->
                        <div class="space-y-4">
                            <div class="text-center mb-4">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 flex items-center justify-center">
                                    <span class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-3 text-white">
                                        <i class="fas fa-cogs text-lg"></i>
                                    </span>
                                    Admin Features
                                </h3>
                                <div class="w-20 h-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full mx-auto"></div>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-blue-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 flex-shrink-0" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);">
                                            <i class="fas fa-chart-line text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-blue-600 transition-colors duration-300">Dashboard Analytics</h4>
                                            <p class="text-gray-600 mt-1 text-sm">Statistik pengunjung dan aktivitas dengan grafik yang informatif</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-green-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <i class="fas fa-edit text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-green-600 transition-colors duration-300">Manajemen Konten</h4>
                                            <p class="text-gray-600 mt-1 text-sm">CRUD berita, agenda, galeri dengan interface yang user-friendly</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-purple-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <i class="fas fa-user-shield text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-purple-600 transition-colors duration-300">User Management</h4>
                                            <p class="text-gray-600 mt-1 text-sm">Role-based access control dengan sistem permission yang aman</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-orange-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <i class="fas fa-folder-open text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-orange-600 transition-colors duration-300">Media Library</h4>
                                            <p class="text-gray-600 mt-1 text-sm">Upload dan organisasi file dengan preview dan kategori yang rapi</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-red-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <i class="fas fa-envelope text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-red-600 transition-colors duration-300">Buku Tamu</h4>
                                            <p class="text-gray-600 mt-1 text-sm">Sistem pesan pengunjung dengan notifikasi real-time</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-pink-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <i class="fas fa-clipboard-list text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-pink-600 transition-colors duration-300">Activity Logger</h4>
                                            <p class="text-gray-600 mt-1 text-sm">Tracking aktivitas admin dengan detail timestamp dan action</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-indigo-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <i class="fas fa-database text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-indigo-600 transition-colors duration-300">Backup & Restore</h4>
                                            <p class="text-gray-600 mt-1 text-sm">Keamanan data {{ __('school') }} dengan sistem backup otomatis</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="group bg-white rounded-xl p-4 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-teal-500">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-gradient-to-br from-teal-500 to-teal-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                            <i class="fas fa-search text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800 text-base group-hover:text-teal-600 transition-colors duration-300">SEO Optimization</h4>
                                            <p class="text-gray-600 mt-1 text-sm">Meta tags dan sitemap untuk optimasi mesin pencari</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Technical Specs dengan Desain yang Lebih Menarik -->
                    <div class="mt-8 p-6 bg-gradient-to-br from-gray-50 to-blue-100 rounded-2xl border border-blue-200">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">
                            <span class="inline-flex items-center">
                                <i class="fas fa-code text-blue-600 mr-3 text-2xl"></i>
                                Technical Specifications
                            </span>
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="group text-center transform hover:scale-105 transition-all duration-300">
                                <div class="text-white p-4 rounded-xl shadow-lg group-hover:shadow-2xl mb-3" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);">
                                    <i class="fab fa-laravel text-2xl mb-2"></i>
                                    <div class="text-lg font-bold">Laravel 11</div>
                                </div>
                                <p class="text-gray-700 font-medium text-sm">Framework</p>
                            </div>
                            <div class="group text-center transform hover:scale-105 transition-all duration-300">
                                <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-4 rounded-xl shadow-lg group-hover:shadow-2xl mb-3">
                                    <i class="fas fa-database text-2xl mb-2"></i>
                                    <div class="text-lg font-bold">MySQL</div>
                                </div>
                                <p class="text-gray-700 font-medium text-sm">Database</p>
                            </div>
                            <div class="group text-center transform hover:scale-105 transition-all duration-300">
                                <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-4 rounded-xl shadow-lg group-hover:shadow-2xl mb-3">
                                    <i class="fab fa-css3-alt text-2xl mb-2"></i>
                                    <div class="text-lg font-bold">Tailwind CSS</div>
                                </div>
                                <p class="text-gray-700 font-medium text-sm">Styling</p>
                            </div>
                            <div class="group text-center transform hover:scale-105 transition-all duration-300">
                                <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white p-4 rounded-xl shadow-lg group-hover:shadow-2xl mb-3">
                                    <i class="fab fa-js text-2xl mb-2"></i>
                                    <div class="text-lg font-bold">Alpine.js</div>
                                </div>
                                <p class="text-gray-700 font-medium text-sm">JavaScript</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Footer Modal dengan Gradient -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 p-4 rounded-b-3xl text-center border-t border-gray-200">
                    <p class="text-gray-700 text-base font-medium">
                        <span class="inline-flex items-center">
                            <i class="fas fa-heart text-red-500 mr-2 text-lg animate-pulse"></i>
                            Dibuat dengan ❤️ oleh 
                            <a href="https://www.kangjhooe.com" 
                               target="_blank" 
                               class="text-blue-600 hover:text-blue-800 font-bold ml-2 transition-colors duration-300 hover:scale-105 transform inline-block">
                                kangjhooe
                            </a>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tambahkan efek hover yang lebih menarik
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.menu-item');
            
            menuItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px) scale(1.05)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });

        // Modal Fitur Aplikasi
        function showFeatures() {
            document.getElementById('featuresModal').classList.remove('hidden');
            document.getElementById('modalContent').classList.remove('scale-95', 'opacity-0');
            document.getElementById('modalContent').classList.add('scale-100', 'opacity-100');
        }

        function hideFeatures() {
            document.getElementById('featuresModal').classList.add('hidden');
            document.getElementById('modalContent').classList.remove('scale-100', 'opacity-100');
            document.getElementById('modalContent').classList.add('scale-95', 'opacity-0');
        }
    </script>
</body>
</html>
