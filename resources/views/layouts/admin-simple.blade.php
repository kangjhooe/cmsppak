<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>
    
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
    <link rel="manifest" href="{{ asset("site.webmanifest") }}">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    
    <!-- Fallback CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Styles Stack -->
    @stack('styles')
    
    <style>
        /* Custom CSS to fix sidebar positioning and remove empty space */
        @media (min-width: 1024px) {
            .lg\\:relative {
                position: relative !important;
            }
            
            .lg\\:flex-shrink-0 {
                flex-shrink: 0 !important;
            }
            
                    /* Ensure main content has proper margin */
        .flex-1.flex.flex-col.overflow-hidden {
            margin-left: 0 !important;
        }
        
        /* Fix sidebar positioning on desktop */
        @media (min-width: 1024px) {
            .lg\\:fixed {
                position: fixed !important;
            }
            
            /* Ensure main content doesn't overlap with fixed sidebar */
            main.flex-1.bg-gray-50 {
                margin-left: 288px !important; /* 18rem = 288px */
            }
        }
        }
        
        /* Mobile overlay fix */
        @media (max-width: 1023px) {
            .fixed.inset-y-0.left-0 {
                position: fixed !important;
            }
        }
        
        /* Remove unnecessary empty space */
        body {
            min-height: 100vh;
        }
        
        .min-h-screen {
            min-height: 100vh !important;
        }
        
        /* Ensure main content doesn't create extra space */
        main.flex-1.overflow-auto.bg-gray-50 {
            min-height: auto !important;
            height: auto !important;
        }
        
        /* Remove any extra padding/margin that might cause empty space */
        .py-12 {
            padding-bottom: 3rem !important;
        }
        
        /* Remove any hidden headers or elements that might cause empty space */
        main.flex-1.overflow-auto.bg-gray-50 {
            position: relative !important;
        }
        
        /* Ensure no extra elements are created after content */
        main.flex-1.overflow-auto.bg-gray-50::after {
            display: none !important;
            content: none !important;
        }
        
        /* Remove any potential sticky positioning issues */
        .sticky {
            position: relative !important;
        }
        
        /* Ensure content doesn't create extra height */
        .flex-1.flex.flex-col.overflow-hidden {
            height: auto !important;
            min-height: auto !important;
        }
        
        /* Aggressively remove all empty space */
        * {
            box-sizing: border-box !important;
        }
        
        /* Remove any potential margin/padding that creates empty space */
        body, html {
            margin: 0 !important;
            padding: 0 !important;
            height: auto !important;
            min-height: auto !important;
        }
        
        /* Force main content to only take necessary space */
        main.flex-1.overflow-auto.bg-gray-50 {
            flex: 1 !important;
            height: auto !important;
            min-height: auto !important;
            max-height: none !important;
            overflow: visible !important;
        }
        
        /* Remove any flex properties that might cause extra height */
        .flex.min-h-screen {
            height: auto !important;
            min-height: auto !important;
        }
        
        /* Ensure no extra spacing in content area */
        .py-12 {
            padding-top: 3rem !important;
            padding-bottom: 1rem !important;
        }
        
        /* Remove any potential bottom margin from last element */
        .py-12 > *:last-child {
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }
        
        /* Hide any unwanted elements that might appear at the bottom */
        .py-12::after,
        .py-12::before {
            display: none !important;
            content: none !important;
        }
        
        /* Ensure no extra elements are rendered after the form */
        form::after,
        form::before {
            display: none !important;
            content: none !important;
        }
        
        /* Hide any potential footer or header elements */
        footer,
        .footer,
        .page-footer,
        .admin-footer {
            display: none !important;
        }
        
        /* Ensure main content area is clean */
        main.flex-1.bg-gray-50::after,
        main.flex-1.bg-gray-50::before {
            display: none !important;
            content: none !important;
        }
        
        /* Aggressively hide any text or elements that might appear */
        .py-12 *:last-child::after,
        .py-12 *:last-child::before {
            display: none !important;
            content: none !important;
        }
        
        /* Hide any potential text that might appear */
        .py-12:after,
        .py-12:before {
            display: none !important;
            content: none !important;
        }
        
        /* Ensure the page ends cleanly after the form */
        .py-12 {
            position: relative;
        }
        
        .py-12:after {
            display: none !important;
            content: none !important;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div x-data="{ 
        sidebarOpen: true,
        activeMenu: '{{ request()->routeIs("admin.dashboard") ? "dashboard" : "" }}',
        openMenus: ['{{ request()->routeIs("admin.dashboard") ? "dashboard" : "" }}']
    }" class="flex h-auto">
        
        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"
             @click="sidebarOpen = false">
        </div>

        <!-- Sidebar -->
        <div x-show="sidebarOpen" 
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-slate-800 via-slate-700 to-slate-800 shadow-2xl lg:fixed lg:translate-x-0 lg:flex-shrink-0">
            
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-20 px-6 border-b border-slate-600/50 bg-gradient-to-r from-slate-700 via-slate-600 to-slate-700">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-xl font-bold text-white">Admin Panel</h1>
                        <p class="text-xs text-slate-200">{{ $schoolName }}</p>
                    </div>
                </div>
                
                <!-- Close button for mobile -->
                <button @click="sidebarOpen = false" class="lg:hidden p-2 text-slate-300 hover:text-white hover:bg-slate-600 rounded-lg transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="mt-6 px-4 pb-6 overflow-y-auto h-[calc(100vh-5rem)]">
                <div class="space-y-2">
                    
                    <!-- Dashboard -->
                    <div>
                        <a href="{{ route('admin.dashboard') }}" 
                           @click="activeMenu = 'dashboard'; openMenus = ['dashboard']"
                           class="flex items-center px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg' : 'hover:bg-slate-600/50 hover:text-white' }}">
                            <div class="w-10 h-10 {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                <i class="fas fa-tachometer-alt text-sm {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                            </div>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </div>
                    
                    <!-- Alpine.js Test (Hidden for production) -->
                    @if(config('app.debug') || app()->environment('local'))
                    <div>
                        <a href="{{ route('admin.alpine-test') }}" 
                           @click="activeMenu = 'alpine-test'; openMenus = ['alpine-test']"
                           class="flex items-center px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group {{ request()->routeIs('admin.alpine-test') ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : 'hover:bg-slate-600/50 hover:text-white' }}">
                            <div class="w-10 h-10 {{ request()->routeIs('admin.alpine-test') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                <i class="fas fa-flask text-sm {{ request()->routeIs('admin.alpine-test') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                            </div>
                            <span class="ml-3">Alpine.js Test</span>
                        </a>
                    </div>
                    @endif
                    
                    <!-- Profile Management -->
                    <div>
                        <a href="{{ route('admin.profile.index') }}" 
                           @click="activeMenu = 'profile'; openMenus = ['profile']"
                           class="flex items-center px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group {{ request()->routeIs('admin.profile*') ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg' : 'hover:bg-slate-600/50 hover:text-white' }}">
                            <div class="w-10 h-10 {{ request()->routeIs('admin.profile*') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                <i class="fas fa-building text-sm {{ request()->routeIs('admin.profile*') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                            </div>
                            <span class="ml-3">Profil Pondok Pesantren</span>
                        </a>
                    </div>
                    
                    
                    <!-- Content Management Section -->
                    <div class="pt-6">
                        <div class="px-3 mb-4">
                            <p class="text-xs font-bold text-slate-300 uppercase tracking-wider">Manajemen Konten</p>
                            <div class="w-8 h-0.5 bg-gradient-to-r from-blue-400 to-purple-400 mt-2 rounded-full"></div>
                        </div>
                        
                        <!-- Guru & Staf Menu with Submenu -->
                        <div x-data="{ open: {{ request()->routeIs('admin.guru-staf*') ? 'true' : 'false' }} }">
                            <button @click="open = !open; if(open) openMenus.push('guru-staf'); else openMenus = openMenus.filter(m => m !== 'guru-staf')"
                                    @click="activeMenu = 'guru-staf'"
                                    class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group hover:bg-slate-600/50 hover:text-white {{ request()->routeIs('admin.guru-staf*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : '' }}">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 {{ request()->routeIs('admin.guru-staf*') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                        <i class="fas fa-users text-sm {{ request()->routeIs('admin.guru-staf*') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                                    </div>
                                    <span class="ml-3">Guru & Staf</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            
                            <!-- Submenu -->
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                                 class="ml-8 mt-2 space-y-1">
                                <a href="{{ route('admin.guru-staf.index') }}" 
                                   class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.guru-staf.index') ? 'bg-slate-600/30 text-white' : '' }}">
                                    <i class="fas fa-list-ul w-4 text-center mr-3"></i>
                                    Daftar Guru & Staf
                                </a>
                                <a href="{{ route('admin.guru-staf.create') }}" 
                                   class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.guru-staf.create') ? 'bg-slate-600/30 text-white' : '' }}">
                                    <i class="fas fa-plus w-4 text-center mr-3"></i>
                                    Tambah Baru
                                </a>
                            </div>
                        </div>
                        
                        <!-- Berita Menu with Submenu -->
                        <div x-data="{ open: {{ request()->routeIs('admin.berita*') ? 'true' : 'false' }} }">
                            <button @click="open = !open; if(open) openMenus.push('berita'); else openMenus = openMenus.filter(m => m !== 'berita')"
                                    @click="activeMenu = 'berita'"
                                    class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group hover:bg-slate-600/50 hover:text-white {{ request()->routeIs('admin.berita*') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : '' }}">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 {{ request()->routeIs('admin.berita*') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                        <i class="fas fa-newspaper text-sm {{ request()->routeIs('admin.berita*') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                                    </div>
                                    <span class="ml-3">Berita</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            
                            <!-- Submenu -->
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                                 class="ml-8 mt-2 space-y-1">
                                <a href="{{ route('admin.berita.index') }}" 
                                   class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.berita.index') ? 'bg-slate-600/30 text-white' : '' }}">
                                    <i class="fas fa-list-ul w-4 text-center mr-3"></i>
                                    Daftar Berita
                                </a>
                                <a href="{{ route('admin.berita.create') }}" 
                                   class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.berita.create') ? 'bg-slate-600/30 text-white' : '' }}">
                                    <i class="fas fa-plus w-4 text-center mr-3"></i>
                                    Tambah Berita
                                </a>
                            </div>
                        </div>
                        
                        <!-- Agenda Menu with Submenu -->
                        <div x-data="{ open: {{ request()->routeIs('admin.agenda*') ? 'true' : 'false' }} }">
                            <button @click="open = !open; if(open) openMenus.push('agenda'); else openMenus = openMenus.filter(m => m !== 'agenda')"
                                    @click="activeMenu = 'agenda'"
                                    class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group hover:bg-slate-600/50 hover:text-white {{ request()->routeIs('admin.agenda*') ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : '' }}">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 {{ request()->routeIs('admin.agenda*') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                        <i class="fas fa-calendar-alt text-sm {{ request()->routeIs('admin.agenda*') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                                    </div>
                                    <span class="ml-3">Agenda</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            
                            <!-- Submenu -->
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                                 class="ml-8 mt-2 space-y-1">
                                <a href="{{ route('admin.agenda.index') }}" 
                                   class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.agenda.index') ? 'bg-slate-600/30 text-white' : '' }}">
                                    <i class="fas fa-list-ul w-4 text-center mr-3"></i>
                                    Daftar Agenda
                                </a>
                                <a href="{{ route('admin.agenda.create') }}" 
                                   class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.agenda.create') ? 'bg-slate-600/30 text-white' : '' }}">
                                    <i class="fas fa-plus w-4 text-center mr-3"></i>
                                    Tambah Agenda
                                </a>
                            </div>
                        </div>
                        
                        <!-- Galeri Menu with Submenu -->
                        <div x-data="{ open: {{ request()->routeIs('admin.galeri*') ? 'true' : 'false' }} }">
                            <button @click="open = !open; if(open) openMenus.push('galeri'); else openMenus = openMenus.filter(m => m !== 'galeri')"
                                    @click="activeMenu = 'galeri'"
                                    class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group hover:bg-slate-600/50 hover:text-white {{ request()->routeIs('admin.galeri*') ? 'bg-gradient-to-r from-pink-500 to-pink-600 text-white shadow-lg' : '' }}">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 {{ request()->routeIs('admin.galeri*') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                        <i class="fas fa-images text-sm {{ request()->routeIs('admin.galeri*') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                                    </div>
                                    <span class="ml-3">Galeri</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            
                            <!-- Submenu -->
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                                 class="ml-8 mt-2 space-y-1">
                                <a href="{{ route('admin.galeri.index') }}" 
                                   class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.galeri.index') ? 'bg-slate-600/30 text-white' : '' }}">
                                    <i class="fas fa-list-ul w-4 text-center mr-3"></i>
                                    Daftar Galeri
                                </a>
                                <a href="{{ route('admin.galeri.create') }}" 
                                   class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.galeri.create') ? 'bg-slate-600/30 text-white' : '' }}">
                                    <i class="fas fa-plus w-4 text-center mr-3"></i>
                                    Tambah Galeri
                                </a>
                            </div>
                        </div>
                        
                        <!-- Program Unggulan Menu -->
                        <div>
                            <a href="{{ route('admin.program-unggulan.index') }}" 
                               @click="activeMenu = 'program-unggulan'; openMenus = ['program-unggulan']"
                               class="flex items-center px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group {{ request()->routeIs('admin.program-unggulan*') ? 'bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-lg' : 'hover:bg-slate-600/50 hover:text-white' }}">
                                <div class="w-10 h-10 {{ request()->routeIs('admin.program-unggulan*') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                    <i class="fas fa-star text-sm {{ request()->routeIs('admin.program-unggulan*') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                                </div>
                                <span class="ml-3">Program Unggulan</span>
                            </a>
                        </div>
                        
                        <!-- Features Menu -->
                        <div>
                            <a href="{{ route('admin.features.index') }}" 
                               @click="activeMenu = 'features'; openMenus = ['features']"
                               class="flex items-center px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group {{ request()->routeIs('admin.features*') ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-lg' : 'hover:bg-slate-600/50 hover:text-white' }}">
                                <div class="w-10 h-10 {{ request()->routeIs('admin.features*') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                    <i class="fas fa-check-circle text-sm {{ request()->routeIs('admin.features*') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                                </div>
                                <span class="ml-3">Fitur (Mengapa Memilih Kami?)</span>
                            </a>
                        </div>
                        
                        <!-- Downloads Menu with Submenu -->
                        <div x-data="{ open: {{ request()->routeIs('admin.downloads*') ? 'true' : 'false' }} }">
                            <button @click="open = !open; if(open) openMenus.push('downloads'); else openMenus = openMenus.filter(m => m !== 'downloads')"
                                    @click="activeMenu = 'downloads'"
                                    class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group hover:bg-slate-600/50 hover:text-white {{ request()->routeIs('admin.downloads*') ? 'bg-gradient-to-r from-indigo-500 to-indigo-600 text-white shadow-lg' : '' }}">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 {{ request()->routeIs('admin.downloads*') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                        <i class="fas fa-download text-sm {{ request()->routeIs('admin.downloads*') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                                    </div>
                                    <span class="ml-3">Downloads</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            
                            <!-- Submenu -->
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                                 class="ml-8 mt-2 space-y-1">
                                <a href="{{ route('admin.downloads.index') }}" 
                                   class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.downloads.index') ? 'bg-slate-600/30 text-white' : '' }}">
                                    <i class="fas fa-list-ul w-4 text-center mr-3"></i>
                                    Daftar File
                                </a>
                                <a href="{{ route('admin.downloads.create') }}" 
                                   class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.downloads.create') ? 'bg-slate-600/30 text-white' : '' }}">
                                    <i class="fas fa-plus w-4 text-center mr-3"></i>
                                    Upload File
                                </a>
                            </div>
                        </div>
                        
                        <!-- Comments Menu with Submenu -->
                        <div x-data="{ open: {{ request()->routeIs('admin.comments*') ? 'true' : 'false' }} }">
                            <button @click="open = !open; if(open) openMenus.push('comments'); else openMenus = openMenus.filter(m => m !== 'comments')"
                                    @click="activeMenu = 'comments'"
                                    class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group hover:bg-slate-600/50 hover:text-white {{ request()->routeIs('admin.comments*') ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : '' }}">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 {{ request()->routeIs('admin.comments*') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                        <i class="fas fa-comments text-sm {{ request()->routeIs('admin.comments*') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                                    </div>
                                    <span class="ml-3">Komentar</span>
                                    @php
                                        $pendingComments = \App\Models\Comment::where('status', 'pending')->count();
                                    @endphp
                                    @if($pendingComments > 0)
                                        <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $pendingComments }}</span>
                                    @endif
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                            </button>
                            
                            <!-- Submenu -->
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                                 class="ml-8 mt-2 space-y-1">
                                <a href="{{ route('admin.comments.index') }}" 
                                   class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.comments.index') ? 'bg-slate-600/30 text-white' : '' }}">
                                    <i class="fas fa-list-ul w-4 text-center mr-3"></i>
                                    Daftar Komentar
                                </a>
                                <a href="{{ route('admin.comments.index', ['status' => 'pending']) }}" 
                                   class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors">
                                    <i class="fas fa-clock w-4 text-center mr-3"></i>
                                    Menunggu Persetujuan
                                    @if($pendingComments > 0)
                                        <span class="ml-auto bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-full">{{ $pendingComments }}</span>
                                    @endif
                                </a>
                            </div>
                        </div>
                        
                        <!-- User & Role Management (Admin only) -->
                        @if(auth()->user()->hasRole('admin'))
                        <div class="pt-6">
                            <div class="px-3 mb-4">
                                <p class="text-xs font-bold text-slate-300 uppercase tracking-wider">Administrasi</p>
                                <div class="w-8 h-0.5 bg-gradient-to-r from-red-400 to-orange-400 mt-2 rounded-full"></div>
                            </div>
                            
                            <!-- Users Menu -->
                            <div x-data="{ open: {{ request()->routeIs('admin.users*') ? 'true' : 'false' }} }">
                                <button @click="open = !open; if(open) openMenus.push('users'); else openMenus = openMenus.filter(m => m !== 'users')"
                                        @click="activeMenu = 'users'"
                                        class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group hover:bg-slate-600/50 hover:text-white {{ request()->routeIs('admin.users*') ? 'bg-gradient-to-r from-red-500 to-red-600 text-white shadow-lg' : '' }}">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 {{ request()->routeIs('admin.users*') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                            <i class="fas fa-user-shield text-sm {{ request()->routeIs('admin.users*') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                                        </div>
                                        <span class="ml-3">Users</span>
                                    </div>
                                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                                </button>
                                
                                <!-- Submenu -->
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                                     x-transition:enter-end="opacity-100 transform translate-y-0"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 transform translate-y-0"
                                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                                     class="ml-8 mt-2 space-y-1">
                                    <a href="{{ route('admin.users.index') }}" 
                                       class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.users.index') ? 'bg-slate-600/30 text-white' : '' }}">
                                        <i class="fas fa-list-ul w-4 text-center mr-3"></i>
                                        Daftar Users
                                    </a>
                                    <a href="{{ route('admin.users.create') }}" 
                                       class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.users.create') ? 'bg-slate-600/30 text-white' : '' }}">
                                        <i class="fas fa-plus w-4 text-center mr-3"></i>
                                        Tambah User
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Roles Menu -->
                            <div x-data="{ open: {{ request()->routeIs('admin.roles*') ? 'true' : 'false' }} }">
                                <button @click="open = !open; if(open) openMenus.push('roles'); else openMenus = openMenus.filter(m => m !== 'roles')"
                                        @click="activeMenu = 'roles'"
                                        class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group hover:bg-slate-600/50 hover:text-white {{ request()->routeIs('admin.roles*') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : '' }}">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 {{ request()->routeIs('admin.roles*') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                            <i class="fas fa-user-tag text-sm {{ request()->routeIs('admin.roles*') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                                        </div>
                                        <span class="ml-3">Roles</span>
                                    </div>
                                    <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                                </button>
                                
                                <!-- Submenu -->
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                                     x-transition:enter-end="opacity-100 transform translate-y-0"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 transform translate-y-0"
                                     x-transition:leave-end="opacity-0 transform -translate-y-2"
                                     class="ml-8 mt-2 space-y-1">
                                    <a href="{{ route('admin.roles.index') }}" 
                                       class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.roles.index') ? 'bg-slate-600/30 text-white' : '' }}">
                                        <i class="fas fa-list-ul w-4 text-center mr-3"></i>
                                        Daftar Roles
                                    </a>
                                    <a href="{{ route('admin.roles.create') }}" 
                                       class="flex items-center px-3 py-2 text-sm text-slate-300 rounded-lg hover:bg-slate-600/30 hover:text-white transition-colors {{ request()->routeIs('admin.roles.create') ? 'bg-slate-600/30 text-white' : '' }}">
                                        <i class="fas fa-plus w-4 text-center mr-3"></i>
                                        Tambah Role
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200 relative z-30">
                <div class="flex items-center justify-between h-16 px-6">
                    
                    <!-- Left side - Hamburger & Search -->
                    <div class="flex items-center space-x-4">
                        <!-- Hamburger Menu Button -->
                        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-bars text-lg"></i>
                        </button>
                        
                        <!-- Search Bar -->
                        <div class="hidden sm:flex flex-1 max-w-lg">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400 text-sm"></i>
                                </div>
                                <input type="text" placeholder="Cari berita, agenda, guru..." 
                                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all duration-200">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right side -->
                    <div class="flex items-center space-x-4">
                        
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 rounded-lg transition-all duration-200">
                            <i class="fas fa-bell text-lg"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                        </button>
                        
                        <!-- Profile dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-all duration-200 group">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                    <span class="text-white text-sm font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <span class="hidden md:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs text-gray-400 group-hover:text-gray-600 transition-colors duration-200"></i>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" 
                                 x-transition:enter="transition ease-out duration-100" 
                                 x-transition:enter-start="transform opacity-0 scale-95" 
                                 x-transition:enter-end="transform opacity-100 scale-100" 
                                 x-transition:leave="transition ease-in duration-75" 
                                 x-transition:leave-start="transform opacity-100 scale-100" 
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 border border-gray-200">
                                
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                                
                                <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <i class="fas fa-user mr-3 text-gray-400"></i>Profil
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <i class="fas fa-cog mr-3 text-gray-400"></i>Pengaturan
                                </a>
                                <hr class="my-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <i class="fas fa-sign-out-alt mr-3"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 bg-gray-50">
                <!-- Alerts Section -->
                @if(session('success'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-400 text-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">
                                        {{ session('success') }}
                                    </p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button onclick="this.parentElement.parentElement.parentElement.parentElement.remove()" class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                                            <i class="fas fa-times text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400 text-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">
                                        {{ session('error') }}
                                    </p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button onclick="this.parentElement.parentElement.parentElement.parentElement.remove()" class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-50">
                                            <i class="fas fa-times text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('warning'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-yellow-400 text-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-yellow-800">
                                        {{ session('warning') }}
                                    </p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button onclick="this.parentElement.parentElement.parentElement.parentElement.remove()" class="inline-flex bg-yellow-50 rounded-md p-1.5 text-yellow-500 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-yellow-600 focus:ring-offset-2 focus:ring-offset-yellow-50">
                                            <i class="fas fa-times text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('info'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                        <div class="bg-primary-light border border-primary rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-info-circle text-blue-400 text-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-blue-800">
                                        {{ session('info') }}
                                    </p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button onclick="this.parentElement.parentElement.parentElement.parentElement.remove()" class="inline-flex bg-primary-light rounded-md p-1.5 text-primary hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 focus:ring-offset-primary-light">
                                            <i class="fas fa-times text-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Scripts Stack -->
    @stack('scripts')
</body>
</html>
