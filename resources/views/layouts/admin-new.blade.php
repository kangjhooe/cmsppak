@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50" x-data="{ 
    sidebarOpen: false, 
    sidebarCollapsed: false,
    activeMenu: '{{ 
        request()->routeIs('admin.berita*') ? 'berita' : 
        (request()->routeIs('admin.agenda*') ? 'agenda' : 
        (request()->routeIs('admin.galeri*') ? 'galeri' : 
        (request()->routeIs('admin.downloads*') ? 'downloads' : 
        (request()->routeIs('admin.buku-tamu*') ? 'buku-tamu' : 
        (request()->routeIs('admin.users*') ? 'users' : 
        (request()->routeIs('admin.roles*') ? 'roles' : '')))))) 
    }}',
    toggleSidebar() {
        this.sidebarCollapsed = !this.sidebarCollapsed;
        localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
    },
    toggleMenu(menu) {
        this.activeMenu = this.activeMenu === menu ? '' : menu;
    }
}" x-init="
    sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (window.innerWidth < 1024) sidebarCollapsed = true;
">
    
    <!-- Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 shadow-2xl transform transition-all duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0" 
         :class="{
            'translate-x-0': sidebarOpen, 
            '-translate-x-full': !sidebarOpen,
            'w-72': !sidebarCollapsed,
            'w-20': sidebarCollapsed
         }">
        
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between h-20 px-6 border-b border-slate-700/50 bg-gradient-to-r from-slate-800 via-slate-700 to-slate-800">
            <div class="flex items-center" :class="{'justify-center w-full': sidebarCollapsed}">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl">
                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                </div>
                <div class="ml-4 transition-all duration-300" :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">
                    <h1 class="text-xl font-bold text-white">Admin Panel</h1>
                    <p class="text-xs text-slate-300">{{ $schoolName }}</p>
                </div>
            </div>
            
            <!-- Toggle Button -->
            <button @click="toggleSidebar()" 
                    class="hidden lg:flex items-center justify-center w-10 h-10 text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-xl transition-all duration-200"
                    :class="{'w-full': sidebarCollapsed}">
                <i class="fas fa-bars text-sm" :class="{'rotate-90': sidebarCollapsed}"></i>
            </button>
            
            <!-- Close Button for Mobile -->
            <button @click="sidebarOpen = false" class="lg:hidden text-slate-300 hover:text-white transition-colors duration-200 p-2 rounded-lg hover:bg-slate-700/50">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="mt-6 px-4 pb-6 overflow-y-auto h-[calc(100vh-5rem)]">
            <div class="space-y-3">
                
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-blue-500/20 hover:text-white transition-all duration-200 font-semibold text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white shadow-lg' : '' }}"
                   :class="{'justify-center': sidebarCollapsed}">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-tachometer-alt text-white text-sm"></i>
                    </div>
                    <span class="text-sm font-semibold transition-all duration-300 ml-3" 
                          :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">Dashboard</span>
                </a>
                
                <!-- Profile Management -->
                <a href="{{ route('admin.profile.index') }}" 
                   class="flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-emerald-500/20 hover:text-white transition-all duration-200 font-semibold text-sm {{ request()->routeIs('admin.profile*') ? 'bg-emerald-500 text-white shadow-lg' : '' }}"
                   :class="{'justify-center': sidebarCollapsed}">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-building text-white text-sm"></i>
                    </div>
                    <span class="text-sm font-semibold transition-all duration-300 ml-3" 
                          :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">Profil {{ __('school') }}</span>
                </a>
                
                <!-- Content Management Section -->
                <div class="pt-6" :class="{'hidden': sidebarCollapsed}">
                    <div class="px-3 mb-4">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Manajemen Konten</p>
                        <div class="w-8 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 mt-2 rounded-full"></div>
                    </div>
                    
                    <!-- Berita Menu -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('berita')" 
                                class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-orange-500/20 hover:text-white transition-all duration-200 font-semibold text-sm {{ request()->routeIs('admin.berita*') ? 'bg-orange-500 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-newspaper text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Berita</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300" 
                               :class="{'rotate-180': activeMenu === 'berita'}"></i>
                        </button>
                        
                        <!-- Submenu Berita -->
                        <div x-show="activeMenu === 'berita'" x-transition class="ml-4 space-y-1 border-l-2 border-orange-500/30 pl-4">
                            <a href="{{ route('admin.berita.index') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-orange-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.berita.index') ? 'bg-orange-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3"></i>
                                <span>Daftar Berita</span>
                            </a>
                            <a href="{{ route('admin.berita.create') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-orange-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.berita.create') ? 'bg-orange-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3"></i>
                                <span>Tambah Berita</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Agenda Menu -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('agenda')" 
                                class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-purple-500/20 hover:text-white transition-all duration-200 font-semibold text-sm {{ request()->routeIs('admin.agenda*') ? 'bg-purple-500 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-calendar-alt text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Agenda</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300" 
                               :class="{'rotate-180': activeMenu === 'agenda'}"></i>
                        </button>
                        
                        <!-- Submenu Agenda -->
                        <div x-show="activeMenu === 'agenda'" x-transition class="ml-4 space-y-1 border-l-2 border-purple-500/30 pl-4">
                            <a href="{{ route('admin.agenda.index') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-purple-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.agenda.index') ? 'bg-purple-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3"></i>
                                <span>Daftar Agenda</span>
                            </a>
                            <a href="{{ route('admin.agenda.create') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-purple-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.agenda.create') ? 'bg-purple-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3"></i>
                                <span>Tambah Agenda</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Galeri Menu -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('galeri')" 
                                class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-pink-500/20 hover:text-white transition-all duration-200 font-semibold text-sm {{ request()->routeIs('admin.galeri*') ? 'bg-pink-500 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-images text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Galeri</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300" 
                               :class="{'rotate-180': activeMenu === 'galeri'}"></i>
                        </button>
                        
                        <!-- Submenu Galeri -->
                        <div x-show="activeMenu === 'galeri'" x-transition class="ml-4 space-y-1 border-l-2 border-pink-500/30 pl-4">
                            <a href="{{ route('admin.galeri.index') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-pink-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.galeri.index') ? 'bg-pink-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3"></i>
                                <span>Daftar Galeri</span>
                            </a>
                            <a href="{{ route('admin.galeri.create') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-pink-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.galeri.create') ? 'bg-pink-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3"></i>
                                <span>Tambah Galeri</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Downloads Menu -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('downloads')" 
                                class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-indigo-500/20 hover:text-white transition-all duration-200 font-semibold text-sm {{ request()->routeIs('admin.downloads*') ? 'bg-indigo-500 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-download text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Downloads</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300" 
                               :class="{'rotate-180': activeMenu === 'downloads'}"></i>
                        </button>
                        
                        <!-- Submenu Downloads -->
                        <div x-show="activeMenu === 'downloads'" x-transition class="ml-4 space-y-1 border-l-2 border-indigo-500/30 pl-4">
                            <a href="{{ route('admin.downloads.index') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-indigo-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.downloads.index') ? 'bg-indigo-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3"></i>
                                <span>Daftar File</span>
                            </a>
                            <a href="{{ route('admin.downloads.create') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-indigo-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.downloads.create') ? 'bg-indigo-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3"></i>
                                <span>Upload File</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Buku Tamu Menu -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('buku-tamu')" 
                                class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-teal-500/20 hover:text-white transition-all duration-200 font-semibold text-sm {{ request()->routeIs('admin.buku-tamu*') ? 'bg-teal-500 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-book text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Buku Tamu</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300" 
                               :class="{'rotate-180': activeMenu === 'buku-tamu'}"></i>
                        </button>
                        
                        <!-- Submenu Buku Tamu -->
                        <div x-show="activeMenu === 'buku-tamu'" x-transition class="ml-4 space-y-1 border-l-2 border-teal-500/30 pl-4">
                            <a href="{{ route('admin.buku-tamu.index') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-teal-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.buku-tamu.index') ? 'bg-teal-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3"></i>
                                <span>Daftar Pesan</span>
                            </a>
                            <a href="{{ route('admin.buku-tamu.create') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-teal-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.buku-tamu.create') ? 'bg-teal-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3"></i>
                                <span>Tambah Pesan</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Administration Section -->
                @can('manage users')
                <div class="pt-6" :class="{'hidden': sidebarCollapsed}">
                    <div class="px-3 mb-4">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Administrasi</p>
                        <div class="w-8 h-0.5 bg-gradient-to-r from-red-500 to-amber-500 mt-2 rounded-full"></div>
                    </div>
                    
                    <!-- Users Menu -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('users')" 
                                class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-red-500/20 hover:text-white transition-all duration-200 font-semibold text-sm {{ request()->routeIs('admin.users*') ? 'bg-red-500 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-user-shield text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Users</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300" 
                               :class="{'rotate-180': activeMenu === 'users'}"></i>
                        </button>
                        
                        <!-- Submenu Users -->
                        <div x-show="activeMenu === 'users'" x-transition class="ml-4 space-y-1 border-l-2 border-red-500/30 pl-4">
                            <a href="{{ route('admin.users.index') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-red-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.users.index') ? 'bg-red-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3"></i>
                                <span>Daftar Users</span>
                            </a>
                            <a href="{{ route('admin.users.create') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-red-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.users.create') ? 'bg-red-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3"></i>
                                <span>Tambah User</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Roles Menu -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('roles')" 
                                class="w-full flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-amber-500/20 hover:text-white transition-all duration-200 font-semibold text-sm {{ request()->routeIs('admin.roles*') ? 'bg-amber-500 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-user-tag text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Roles</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300" 
                               :class="{'rotate-180': activeMenu === 'roles'}"></i>
                        </button>
                        
                        <!-- Submenu Roles -->
                        <div x-show="activeMenu === 'roles'" x-transition class="ml-4 space-y-1 border-l-2 border-amber-500/30 pl-4">
                            <a href="{{ route('admin.roles.index') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-amber-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.roles.index') ? 'bg-amber-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3"></i>
                                <span>Daftar Roles</span>
                            </a>
                            <a href="{{ route('admin.roles.create') }}" 
                               class="flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-amber-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.roles.create') ? 'bg-amber-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3"></i>
                                <span>Tambah Role</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endcan
            </div>
        </nav>
    </div>

    <!-- Mobile overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" 
         class="fixed inset-0 z-40 bg-gray-900 bg-opacity-75 lg:hidden transition-opacity duration-300"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 transition-all duration-300 ease-in-out" :class="{'lg:ml-20': sidebarCollapsed, 'lg:ml-72': !sidebarCollapsed}">
        
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                
                <!-- Mobile menu button -->
                <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition-all duration-200">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                
                <!-- Search Bar -->
                <div class="flex-1 max-w-lg ml-4 lg:ml-0">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" placeholder="Cari berita, agenda..." 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all duration-200">
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
                        <button @click="open = !open" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-all duration-200">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-white text-sm font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <span class="hidden md:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" 
                             x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 border border-gray-200">
                            
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
        <main class="flex-1 overflow-hidden bg-gray-50">
            @yield('content')
        </main>
    </div>
</div>

<script>
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'b') {
            e.preventDefault();
            // Toggle sidebar
            const sidebar = document.querySelector('[x-data]').__x.$data;
            sidebar.sidebarCollapsed = !sidebar.sidebarCollapsed;
        }
    });
    
    // Auto-hide sidebar on mobile after navigation
    document.addEventListener('click', function(e) {
        if (e.target.tagName === 'A' && window.innerWidth < 1024) {
            const sidebar = document.querySelector('[x-data]').__x.$data;
            sidebar.sidebarOpen = false;
        }
    });
</script>
@endsection
