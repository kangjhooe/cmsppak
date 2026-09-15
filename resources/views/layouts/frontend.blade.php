<!DOCTYPE html>
<html lang="id" class="bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $schoolName)</title>
    
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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Source+Serif+4:opsz,wght@8..60,600;8..60,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modern-components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme-consistency.css') }}">
    <style>
        html, body {
            background-color: white !important;
        }
        html {
            font-size: 14px;
        }
        @media (min-width: 1536px) {
            html { font-size: 15px; }
        }
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            font-size: 0.9375rem;
            line-height: 1.6;
        }
        .font-display,
        h1, h2, h3 {
            font-family: 'Source Serif 4', Georgia, 'Times New Roman', serif;
        }
        .line-clamp-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }
        .line-clamp-3 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }
    </style>
    @stack('styles')
    @stack('scripts-head')
    @stack('meta')
</head>
<body class="bg-white font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50 transition-all duration-300 border-b border-gray-100" 
         x-data="{ mobileMenuOpen: false, scrolled: false }" 
         @scroll.window="scrolled = window.pageYOffset > 50"
         :class="{ 'shadow-md': scrolled }">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14 lg:h-16">
                <!-- Logo dan Nama Sekolah -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        @php
                            $profileData = $profile ?? $data['profile'] ?? null;
                        @endphp
                        <!-- Logo dari profil backend -->
                        @if($profileData && $profileData->logo_url)
                            <img src="{{ $profileData->logo_url }}" alt="Logo {{ $profileData->nama_sekolah ?? $schoolName }}" 
                                 class="w-10 h-10 lg:w-12 lg:h-12 rounded-xl object-cover shadow-lg">
                        @else
                            <!-- Fallback logo dengan gradient sederhana -->
                            <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-xl flex items-center justify-center shadow-lg bg-gradient-to-br from-green-600 to-green-700">
                                <i class="fas fa-graduation-cap text-white text-base lg:text-lg"></i>
                            </div>
                        @endif
                    </div>
                    <div class="ml-3">
                        <h1 class="text-sm sm:text-base lg:text-lg font-bold text-gray-800 leading-tight">
                            {{ $profileData->nama_sekolah ?? $schoolName }}
                        </h1>
                        @if(!empty($schoolTagline) && $schoolTagline !== ($profileData->nama_sekolah ?? $schoolName))
                        <p class="text-xs lg:text-sm text-gray-600 font-medium hidden sm:block">{{ $schoolTagline }}</p>
                        @endif
                    </div>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-4 lg:space-x-6">
                    <a href="{{ route('home') }}" class="nav-link-clean {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('profil') }}" class="nav-link-clean {{ request()->routeIs('profil') ? 'nav-link-active' : '' }}">
                        Profil
                    </a>
                    <a href="{{ route('berita') }}" class="nav-link-clean {{ request()->routeIs('berita*') ? 'nav-link-active' : '' }}">
                        Berita
                    </a>
                    <a href="{{ route('agenda') }}" class="nav-link-clean {{ request()->routeIs('agenda*') ? 'nav-link-active' : '' }}">
                        Agenda
                    </a>
                    <a href="{{ route('galeri') }}" class="nav-link-clean {{ request()->routeIs('galeri*') ? 'nav-link-active' : '' }}">
                        Galeri
                    </a>
                    <a href="{{ route('downloads') }}" class="nav-link-clean {{ request()->routeIs('downloads*') ? 'nav-link-active' : '' }}">
                        Downloads
                    </a>
                    <a href="{{ route('kontak') }}" class="nav-link-clean {{ request()->routeIs('kontak') ? 'nav-link-active' : '' }}">
                        Kontak
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" 
                            class="p-2 text-gray-800 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" 
             x-transition:enter-start="opacity-0 -translate-y-1" 
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150" 
             x-transition:leave-start="opacity-100 translate-y-0" 
             x-transition:leave-end="opacity-0 -translate-y-1"
             class="lg:hidden bg-white border-t border-gray-200 shadow-lg">
            <div class="px-4 py-3 flex flex-col space-y-2">
                <a href="{{ route('home') }}" class="mobile-nav-link-clean {{ request()->routeIs('home') ? 'mobile-nav-link-active' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('profil') }}" class="mobile-nav-link-clean {{ request()->routeIs('profil') ? 'mobile-nav-link-active' : '' }}">
                    Profil
                </a>
                <a href="{{ route('berita') }}" class="mobile-nav-link-clean {{ request()->routeIs('berita*') ? 'mobile-nav-link-active' : '' }}">
                    Berita
                </a>
                <a href="{{ route('agenda') }}" class="mobile-nav-link-clean {{ request()->routeIs('agenda*') ? 'mobile-nav-link-active' : '' }}">
                    Agenda
                </a>
                <a href="{{ route('galeri') }}" class="mobile-nav-link-clean {{ request()->routeIs('galeri*') ? 'mobile-nav-link-active' : '' }}">
                    Galeri
                </a>
                <a href="{{ route('downloads') }}" class="mobile-nav-link-clean {{ request()->routeIs('downloads*') ? 'mobile-nav-link-active' : '' }}">
                    Downloads
                </a>
                <a href="{{ route('kontak') }}" class="mobile-nav-link-clean {{ request()->routeIs('kontak') ? 'mobile-nav-link-active' : '' }}">
                    Kontak
                </a>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-dark relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- {{ __('school') }} Info -->
                <div class="lg:col-span-2">
                    <div class="flex items-center mb-6">
                        @if($profileData && $profileData->logo_url)
                            <img src="{{ $profileData->logo_url }}" alt="Logo {{ $profileData->nama_sekolah ?? $schoolName }}" 
                                 class="w-16 h-16 rounded-2xl object-cover shadow-xl mr-4">
                        @else
                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center shadow-xl mr-4" 
                                 style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary), var(--color-accent));">
                                <i class="fas fa-graduation-cap text-white text-2xl"></i>
                            </div>
                        @endif
                        <div>
                            <h3 class="text-2xl font-bold text-white">
                                {{ $profileData->nama_sekolah ?? $schoolName }}
                            </h3>
                            @if(!empty($schoolTagline) && $schoolTagline !== ($profileData->nama_sekolah ?? $schoolName))
                            <p class="footer-text">{{ $schoolTagline }}</p>
                            @endif
                        </div>
                    </div>
                    <p class="leading-relaxed mb-6 footer-text">
                        {{ $schoolDescription ?? ($profileData->profil_hero_description ?? ($profileData->nama_sekolah ?? $schoolName)) }}
                    </p>
                    <div class="flex space-x-4">
                        @if($profileData?->facebook)
                        <a href="{{ $profileData->facebook }}" target="_blank" rel="noopener noreferrer" class="footer-social-icon-simple">
                            <i class="fab fa-facebook-f text-white"></i>
                        </a>
                        @endif
                        @if($profileData?->twitter)
                        <a href="{{ $profileData->twitter }}" target="_blank" rel="noopener noreferrer" class="footer-social-icon-simple">
                            <i class="fab fa-twitter text-white"></i>
                        </a>
                        @endif
                        @if($profileData?->instagram)
                        <a href="{{ $profileData->instagram }}" target="_blank" rel="noopener noreferrer" class="footer-social-icon-simple">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                        @endif
                        @if($profileData?->youtube)
                        <a href="{{ $profileData->youtube }}" target="_blank" rel="noopener noreferrer" class="footer-social-icon-simple">
                            <i class="fab fa-youtube text-white"></i>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6">Link Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="footer-link">Beranda</a></li>
                        <li><a href="{{ route('profil') }}" class="footer-link">Profil {{ __('school') }}</a></li>
                        <li><a href="{{ route('berita') }}" class="footer-link">Berita</a></li>
                        <li><a href="{{ route('agenda') }}" class="footer-link">Agenda</a></li>
                        <li><a href="{{ route('galeri') }}" class="footer-link">Galeri</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-6">Kontak</h4>
                    <div class="space-y-4">
                        @if($profileData?->alamat)
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 mt-1 footer-icon-bg-primary">
                                <i class="fas fa-map-marker-alt text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm footer-text">
                                    {{ $profileData->alamat }}
                                </p>
                            </div>
                        </div>
                        @endif
                        
                        @if($profileData?->telepon)
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 mt-1 footer-icon-bg-primary">
                                <i class="fas fa-phone text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm footer-text">
                                    <a href="{{ $profileData->telepon_url }}" class="footer-link">{{ $profileData->telepon }}</a>
                                </p>
                            </div>
                        </div>
                        @endif
                        
                        @if($profileData?->email)
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 mt-1 footer-icon-bg-primary">
                                <i class="fas fa-envelope text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm footer-text">
                                    <a href="mailto:{{ $profileData->email }}" class="footer-link">{{ $profileData->email }}</a>
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Bottom Footer -->
            <div class="border-t footer-border mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm mb-4 md:mb-0 footer-text">
                        © {{ date('Y') }} {{ $profileData->nama_sekolah ?? $schoolName }}. All rights reserved.
                    </div>
                    <div class="flex space-x-6 text-sm">
                        <a href="{{ route('privacy') }}" class="footer-link">Kebijakan Privasi</a>
                        <a href="{{ route('terms') }}" class="footer-link">Syarat Layanan</a>
                        <a href="{{ route('cookies') }}" class="footer-link">Kebijakan Cookie</a>
                    </div>
                </div>
                
                <!-- Developer Info -->
                <div class="border-t footer-border mt-6 pt-6">
                    <div class="flex flex-col md:flex-row justify-center items-center space-y-2 md:space-y-0 md:space-x-4">
                        <div class="text-sm footer-text">
                            &lt;/&gt; developed by 
                            <a href="https://www.kangjhooe.com" target="_blank" rel="noopener noreferrer" 
                               class="footer-link font-medium">
                                kangjhooe
                            </a> 
                            untuk {{ $schoolName }} 
                            <button id="version-info-btn" 
                                    class="footer-link font-medium underline cursor-pointer">
                                versi 1.3
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" 
            class="fixed bottom-8 right-8 w-12 h-12 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 opacity-0 invisible z-40"
            style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
        <i class="fas fa-arrow-up text-lg"></i>
    </button>

    <!-- Version Info Modal -->
    <div id="version-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl max-w-4xl w-full mx-4 transform transition-all duration-500 scale-95 opacity-0 max-h-[90vh] flex flex-col" id="modal-content">
                <!-- Modal Header -->
                <div class="rounded-t-3xl px-8 py-6 flex-shrink-0 bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-white/25 rounded-2xl flex items-center justify-center backdrop-blur-sm shadow-md">
                                <i class="fas fa-rocket text-white text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-white drop-shadow-sm">Informasi Aplikasi</h3>
                                <p class="text-emerald-100 text-sm font-medium">{{ $schoolName }} - CMS Modern</p>
                            </div>
                        </div>
                        <button id="close-modal" class="w-10 h-10 bg-white/25 hover:bg-white/35 rounded-xl flex items-center justify-center text-white hover:text-gray-100 transition-all duration-300 backdrop-blur-sm shadow-md hover:shadow-lg">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Modal Body - Scrollable -->
                <div class="flex-1 overflow-y-auto px-8 py-8 custom-scrollbar">
                    <div class="space-y-8">
                        <!-- Version Badge -->
                        <div class="text-center">
                            <div class="inline-flex items-center px-6 py-3 rounded-2xl shadow-lg"
                                 style="background: linear-gradient(to right, #10b981, #047857);">
                                <i class="fas fa-tag text-white mr-3"></i>
                                <span class="text-white font-bold text-xl">Versi 1.3</span>
                                <span class="ml-3 px-3 py-1 bg-white/25 rounded-full text-white text-sm font-medium">Stable</span>
                            </div>
                            <div class="mt-4 flex items-center justify-center space-x-4 text-gray-600">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt text-emerald-500 mr-2"></i>
                                    <span>Rilis: 15 September 2026</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-code-branch text-teal-500 mr-2"></i>
                                    <span>Build: 2026.09.15</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pembaruan Versi 1.3 -->
                        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-6 border border-emerald-200">
                            <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-sparkles text-emerald-500 mr-3 text-2xl"></i>
                                Pembaruan Versi 1.3
                            </h4>
                            <div class="space-y-3">
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
                        <div class="bg-gradient-to-br from-gray-50 to-slate-50 rounded-2xl p-6 border border-gray-200">
                            <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-history text-gray-500 mr-3 text-2xl"></i>
                                Riwayat Versi
                            </h4>
                            <div class="space-y-4">
                                <!-- Versi 1.3 (Current) -->
                                <div class="bg-white rounded-xl p-4 border-l-4 border-emerald-500 shadow-sm">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-3">
                                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-sm font-bold">v1.3</span>
                                            <span class="text-gray-700 font-semibold">Versi Terkini</span>
                                        </div>
                                        <span class="text-gray-500 text-sm">15 September 2026</span>
                                    </div>
                                    <p class="text-gray-600 text-sm">Slider beranda, widget waktu sholat & Hijriyah, halaman legal, dan penyegaran tampilan</p>
                                </div>

                                <!-- Versi 1.2 -->
                                <div class="bg-white rounded-xl p-4 border-l-4 border-blue-400 shadow-sm opacity-75">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-3">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-bold">v1.2</span>
                                            <span class="text-gray-600 text-sm">Versi Sebelumnya</span>
                                        </div>
                                        <span class="text-gray-500 text-sm">Januari 2025</span>
                                    </div>
                                    <p class="text-gray-600 text-sm">Peningkatan performa, perbaikan UI/UX, keamanan ditingkatkan, dan fitur baru</p>
                                </div>
                                
                                <!-- Versi 1.1 -->
                                <div class="bg-white rounded-xl p-4 border-l-4 border-slate-300 shadow-sm opacity-75">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-3">
                                            <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm font-bold">v1.1</span>
                                            <span class="text-gray-600 text-sm">Versi Sebelumnya</span>
                                        </div>
                                        <span class="text-gray-500 text-sm">Januari 2025</span>
                                    </div>
                                    <p class="text-gray-600 text-sm">Rilis stabil pertama dengan fitur lengkap CMS untuk sekolah</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Features Grid -->
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-star text-emerald-500 mr-3 text-2xl"></i>
                                Fitur Utama Aplikasi
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100 hover:shadow-lg transition-all duration-300 group">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-newspaper text-white text-lg"></i>
                                        </div>
                                        <h5 class="font-semibold text-gray-800">Berita & Artikel</h5>
                                    </div>
                                    <p class="text-gray-600 text-sm">Sistem manajemen berita dengan editor WYSIWYG, kategori, dan SEO optimization</p>
                                </div>
                                
                                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100 hover:shadow-lg transition-all duration-300 group">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-calendar-alt text-white text-lg"></i>
                                        </div>
                                        <h5 class="font-semibold text-gray-800">Agenda & Event</h5>
                                    </div>
                                    <p class="text-gray-600 text-sm">Kalender interaktif dengan reminder, kategori event, dan integrasi Google Calendar</p>
                                </div>
                                
                                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100 hover:shadow-lg transition-all duration-300 group">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-images text-white text-lg"></i>
                                        </div>
                                        <h5 class="font-semibold text-gray-800">Galeri Media</h5>
                                    </div>
                                    <p class="text-gray-600 text-sm">Galeri foto dengan lightbox, album, dan dukungan berbagai format media</p>
                                </div>
                                
                                <div class="bg-gradient-to-br from-teal-50 to-cyan-50 rounded-2xl p-6 border border-teal-100 hover:shadow-lg transition-all duration-300 group">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-teal-500 to-cyan-600 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-download text-white text-lg"></i>
                                        </div>
                                        <h5 class="font-semibold text-gray-800">File Download</h5>
                                    </div>
                                    <p class="text-gray-600 text-sm">Sistem download file dengan kategori, preview, dan statistik download</p>
                                </div>
                                
                                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-2xl p-6 border border-indigo-100 hover:shadow-lg transition-all duration-300 group">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-300">
                                            <i class="fas fa-book text-white text-lg"></i>
                                        </div>
                                        <h5 class="font-semibold text-gray-800">Buku Tamu</h5>
                                    </div>
                                    <p class="text-gray-600 text-sm">Buku tamu digital dengan validasi, moderasi, dan notifikasi real-time</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Technical Specifications -->
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-cogs text-blue-500 mr-3 text-2xl"></i>
                                Spesifikasi Teknis
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gradient-to-br from-gray-50 to-slate-50 rounded-2xl p-6 border border-gray-200">
                                    <h5 class="font-semibold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-server text-blue-500 mr-2"></i>
                                        Backend Technology
                                    </h5>
                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600">Framework:</span>
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Laravel 10</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600">PHP Version:</span>
                                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">8.1+</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600">Database:</span>
                                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">MySQL/SQLite</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600">Cache:</span>
                                            <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-medium">Redis/Memcached</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-gray-50 to-slate-50 rounded-2xl p-6 border border-gray-200">
                                    <h5 class="font-semibold text-gray-800 mb-4 flex items-center">
                                        <i class="fas fa-palette text-green-500 mr-2"></i>
                                        Frontend Technology
                                    </h5>
                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600">CSS Framework:</span>
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Tailwind CSS 3</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600">JavaScript:</span>
                                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">Alpine.js</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600">Icons:</span>
                                            <span class="px-3 py-1 bg-pink-100 text-pink-800 rounded-full text-sm font-medium">FontAwesome 6</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600">Responsive:</span>
                                            <span class="px-3 py-1 bg-teal-100 text-teal-800 rounded-full text-sm font-medium">Mobile First</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Performance & Security -->
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-shield-alt text-green-500 mr-3 text-2xl"></i>
                                Performa & Keamanan
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-center p-4 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border border-green-200">
                                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-bolt text-white text-2xl"></i>
                                    </div>
                                    <h5 class="font-semibold text-gray-800 mb-2">Performa</h5>
                                    <p class="text-gray-600 text-sm">Optimized queries, caching, dan lazy loading untuk kecepatan maksimal</p>
                                </div>
                                
                                <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
                                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-lock text-white text-2xl"></i>
                                    </div>
                                    <h5 class="font-semibold text-gray-800 mb-2">Keamanan</h5>
                                    <p class="text-gray-600 text-sm">CSRF protection, XSS prevention, dan role-based access control</p>
                                </div>
                                
                                <div class="text-center p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl border border-purple-200">
                                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-mobile-alt text-white text-2xl"></i>
                                    </div>
                                    <h5 class="font-semibold text-gray-800 mb-2">Responsive</h5>
                                    <p class="text-gray-600 text-sm">Design yang optimal untuk semua device dari mobile hingga desktop</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Developer Section -->
                        <div class="text-center bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 rounded-2xl p-8 border border-blue-200">
                            <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-code text-white text-3xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800 mb-3">Dikembangkan dengan ❤️</h4>
                            <p class="text-gray-600 mb-4">Tim pengembang profesional yang berkomitmen memberikan solusi terbaik</p>
                            <div class="flex items-center justify-center space-x-4">
                                <a href="https://www.kangjhooe.com" target="_blank" rel="noopener noreferrer" 
                                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:scale-105">
                                    <i class="fas fa-globe mr-2"></i>
                                    kangjhooe.com
                                </a>
                                <div class="text-gray-500">
                                    <i class="fas fa-envelope mr-2"></i>
                                    <span class="text-sm">kang.jhooe@gmail.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Footer -->
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-b-3xl px-8 py-6 flex-shrink-0 border-t border-emerald-200">
                    <div class="flex justify-between items-center">
                        <div class="text-gray-500 text-sm">
                            <i class="fas fa-info-circle mr-2 text-emerald-500"></i>
                            Aplikasi ini menggunakan teknologi terbaru dan best practices
                        </div>
                        <button id="close-modal-footer" 
                                class="px-8 py-3 text-white rounded-xl transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:scale-105"
                                style="background: linear-gradient(to right, #10b981, #047857);"
                                onmouseover="this.style.background='linear-gradient(to right, #059669, #065f46)'"
                                onmouseout="this.style.background='linear-gradient(to right, #10b981, #047857)'">
                            <i class="fas fa-check mr-2"></i>
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Back to top functionality
        const backToTopButton = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.add('opacity-0', 'invisible');
                backToTopButton.classList.remove('opacity-100', 'visible');
            }
        });
        
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Version Modal functionality
        const versionModal = document.getElementById('version-modal');
        const modalContent = document.getElementById('modal-content');
        const versionInfoBtn = document.getElementById('version-info-btn');
        const closeModal = document.getElementById('close-modal');
        const closeModalFooter = document.getElementById('close-modal-footer');

        function openModal() {
            versionModal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModalFunc() {
            modalContent.classList.add('scale-95', 'opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => {
                versionModal.classList.add('hidden');
            }, 300);
        }

        // Event listeners
        versionInfoBtn.addEventListener('click', openModal);
        closeModal.addEventListener('click', closeModalFunc);
        closeModalFooter.addEventListener('click', closeModalFunc);

        // Close modal when clicking outside
        versionModal.addEventListener('click', (e) => {
            if (e.target === versionModal) {
                closeModalFunc();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !versionModal.classList.contains('hidden')) {
                closeModalFunc();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>

<style>
/* Clean Navigation Styles */
.nav-link-clean {
    @apply px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 text-gray-800 hover:text-green-600 hover:bg-green-50;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

@media (min-width: 1024px) {
    .nav-link-clean {
        @apply px-3 py-2;
    }
}

@media (min-width: 1441px) {
    .nav-link-clean {
        @apply px-5 py-3;
    }
}

.nav-link-clean:hover {
    transform: translateY(-1px);
}

.nav-link-clean i {
    color: inherit;
}

.nav-link-active {
    @apply text-green-600 font-semibold;
    position: relative;
}

.nav-link-active::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 20px;
    height: 2px;
    background: var(--color-primary);
    border-radius: 1px;
}

.mobile-nav-link-clean {
    @apply block w-full px-5 py-4 text-base font-medium rounded-lg transition-all duration-200 text-gray-800 hover:text-green-600 hover:bg-green-50 text-center;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.mobile-nav-link-clean i {
    color: inherit;
}

.mobile-nav-link-active {
    @apply text-green-600 font-semibold;
}

/* Header Typography Improvements */
.nav h1 {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    font-weight: 700;
    letter-spacing: -0.025em;
    line-height: 1.2;
}

.nav p {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    font-weight: 500;
    letter-spacing: 0.025em;
    line-height: 1.4;
}

/* Header Container Improvements */
.nav {
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

/* Focus States for Accessibility */
.nav-link-clean:focus,
.mobile-nav-link-clean:focus {
    @apply outline-none ring-2 ring-green-500 ring-offset-2;
}

/* Smooth Transitions */
.nav * {
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Logo Hover Effect */
.nav img:hover,
.nav .flex-shrink-0 > div:hover {
    transform: scale(1.05);
}

/* Ensure proper contrast for all navigation elements */
.nav-link-clean,
.mobile-nav-link-clean {
    color: #1f2937 !important; /* text-gray-800 */
}

.nav-link-clean:hover,
.mobile-nav-link-clean:hover {
    color: var(--color-primary) !important;
}

.nav-link-clean i,
.mobile-nav-link-clean i {
    color: inherit !important;
}

/* Active state - only color change, no background */
.nav-link-active,
.mobile-nav-link-active {
    color: var(--color-primary) !important;
    background: transparent !important;
}

/* Mobile menu button contrast */
.lg\\:hidden button {
    color: #1f2937 !important; /* text-gray-800 */
}

.lg\\:hidden button:hover {
    color: #111827 !important; /* text-gray-900 */
}

/* Mobile Navigation menggunakan class yang sama dengan desktop */

/* Legacy styles untuk kompatibilitas tema */
.nav-link {
    @apply px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center;
    color: var(--color-text-dark);
}

.nav-link:hover {
    color: var(--color-primary);
}

.nav-link-active {
    color: var(--color-primary);
    background: var(--color-primary-light);
}

.mobile-nav-link {
    @apply block px-3 py-2 text-base font-medium rounded-lg transition-all duration-200 flex items-center;
    color: var(--color-text-dark);
}

.mobile-nav-link:hover {
    color: var(--color-primary);
    background: var(--color-primary-light);
}

.mobile-nav-link-active {
    color: var(--color-primary);
    background: var(--color-primary-light);
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
.custom-scrollbar::-webkit-scrollbar {
    width: 12px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: linear-gradient(to bottom, #f8fafc, #e2e8f0);
    border-radius: 8px;
    margin: 4px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, var(--color-primary), var(--color-secondary), var(--color-accent));
    border-radius: 8px;
    border: 2px solid #f8fafc;
    transition: all 0.3s ease;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, var(--color-primary-dark), var(--color-secondary-dark), var(--color-accent-dark));
    transform: scale(1.1);
}

.custom-scrollbar::-webkit-scrollbar-corner {
    background: transparent;
}

/* Legacy scrollbar untuk kompatibilitas */
.overflow-y-auto::-webkit-scrollbar {
    width: 8px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 4px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, var(--color-primary), var(--color-secondary));
    border-radius: 4px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, var(--color-primary-dark), var(--color-secondary-dark));
}
</style>
