@extends('layouts.app')

@section('title', 'User Profile - ' . ($schoolName ?? ''))

@section('content')
<div class="min-h-screen bg-gray-50" x-data="{ 
    sidebarOpen: false, 
    sidebarCollapsed: false,
    activeMenu: '{{ 
        request()->routeIs('admin.dashboard') ? 'dashboard' : 
        (request()->routeIs('profile.show') ? 'profile' : 
        (request()->routeIs('home') ? 'home' : 
        (request()->routeIs('profil') ? 'profil' : 
        (request()->routeIs('berita') ? 'berita' : 
        (request()->routeIs('agenda') ? 'agenda' : 
        (request()->routeIs('galeri') ? 'galeri' : ''))))))) 
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
    <!-- Enhanced Sidebar -->
    <div class="fixed inset-y-0 left-0 z-50 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 shadow-2xl transform transition-all duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0" 
         :class="{
            'translate-x-0': sidebarOpen, 
            '-translate-x-full': !sidebarOpen,
            'w-72': !sidebarCollapsed,
            'w-20': sidebarCollapsed
         }">
        
        <!-- Enhanced Sidebar Header -->
        <div class="flex items-center justify-between h-20 px-6 border-b border-slate-700/50 bg-gradient-to-r from-slate-800 via-slate-700 to-slate-800 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.15) 1px, transparent 0); background-size: 20px 20px;"></div>
            </div>
            
            <div class="flex items-center relative z-10" :class="{'justify-center w-full': sidebarCollapsed}">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl flex-shrink-0 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-500 opacity-20 animate-pulse"></div>
                    <i class="fas fa-user-circle text-white text-xl relative z-10"></i>
                </div>
                <div class="ml-4 transition-all duration-300" :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">
                    <h1 class="text-xl font-bold text-white tracking-tight">User Panel</h1>
                    <p class="text-xs text-slate-300 font-medium">{{ $schoolName ?? '' }}</p>
                </div>
            </div>
            
            <!-- Enhanced Toggle Button -->
            <button @click="toggleSidebar()" 
                    class="hidden lg:flex items-center justify-center w-10 h-10 text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-xl transition-all duration-200 group"
                    :class="{'w-full': sidebarCollapsed}">
                <i class="fas fa-bars text-sm transition-transform duration-200 group-hover:scale-110" :class="{'rotate-90': sidebarCollapsed}"></i>
            </button>
            
            <!-- Enhanced Close Button for Mobile -->
            <button @click="sidebarOpen = false" class="lg:hidden text-slate-300 hover:text-white transition-colors duration-200 p-2 rounded-lg hover:bg-slate-700/50">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Enhanced Sidebar Navigation -->
        <nav class="mt-6 px-4 pb-6 overflow-y-auto h-[calc(100vh-5rem)] scrollbar-thin scrollbar-thumb-slate-600 scrollbar-track-transparent">
            <div class="space-y-3">
                
                <!-- Dashboard - Enhanced -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="group flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-blue-500/20 hover:to-blue-600/20 hover:text-white transition-all duration-200 font-semibold text-sm cursor-pointer {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg' : '' }}"
                   :class="{'justify-center': sidebarCollapsed}">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                        <i class="fas fa-tachometer-alt text-white text-sm"></i>
                    </div>
                    <span class="text-sm font-semibold transition-all duration-300 ml-3" 
                          :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">Dashboard</span>
                </a>
                
                <!-- User Profile - Enhanced -->
                <a href="{{ route('profile.show') }}" 
                   class="group flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-emerald-500/20 hover:to-emerald-600/20 hover:text-white transition-all duration-200 font-semibold text-sm cursor-pointer {{ request()->routeIs('profile.show') ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg' : '' }}"
                   :class="{'justify-center': sidebarCollapsed}">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <span class="text-sm font-semibold transition-all duration-300 ml-3" 
                          :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">Profil Saya</span>
                </a>
                
                <!-- Frontend Pages Section - Enhanced -->
                <div class="pt-6" :class="{'hidden': sidebarCollapsed}">
                    <div class="px-3 mb-4">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Halaman Publik</p>
                        <div class="w-8 h-0.5 bg-gradient-to-r from-green-500 to-purple-500 mt-2 rounded-full"></div>
                    </div>
                    
                    <!-- Home Page -->
                    <a href="{{ route('home') }}" 
                       class="group flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-green-500/20 hover:to-green-600/20 hover:text-white transition-all duration-200 font-medium text-sm cursor-pointer {{ request()->routeIs('home') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : '' }}"
                       :class="{'justify-center': sidebarCollapsed}">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                            <i class="fas fa-home text-white text-sm"></i>
                        </div>
                        <span class="text-sm font-medium transition-all duration-300 ml-3" 
                              :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">Beranda</span>
                    </a>
                    
                    <!-- Profile Madrasah -->
                    <a href="{{ route('profil') }}" 
                       class="group flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-purple-500/20 hover:to-purple-600/20 hover:text-white transition-all duration-200 font-medium text-sm cursor-pointer {{ request()->routeIs('profil') ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : '' }}"
                       :class="{'justify-center': sidebarCollapsed}">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                            <i class="fas fa-info-circle text-white text-sm"></i>
                        </div>
                        <span class="text-sm font-medium transition-all duration-300 ml-3" 
                              :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">Profil Madrasah</span>
                    </a>
                    
                    <!-- Berita -->
                    <a href="{{ route('berita') }}" 
                       class="group flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-orange-500/20 hover:to-orange-600/20 hover:text-white transition-all duration-200 font-medium text-sm cursor-pointer {{ request()->routeIs('berita') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : '' }}"
                       :class="{'justify-center': sidebarCollapsed}">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                            <i class="fas fa-newspaper text-white text-sm"></i>
                        </div>
                        <span class="text-sm font-medium transition-all duration-300 ml-3" 
                              :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">Berita</span>
                    </a>
                    
                    <!-- Agenda -->
                    <a href="{{ route('agenda') }}" 
                       class="group flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-red-500/20 hover:to-red-600/20 hover:text-white transition-all duration-200 font-medium text-sm cursor-pointer {{ request()->routeIs('agenda') ? 'bg-gradient-to-r from-red-500 to-red-600 text-white shadow-lg' : '' }}"
                       :class="{'justify-center': sidebarCollapsed}">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                            <i class="fas fa-calendar-alt text-white text-sm"></i>
                        </div>
                        <span class="text-sm font-medium transition-all duration-300 ml-3" 
                              :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">Agenda</span>
                    </a>
                    
                    <!-- Galeri -->
                    <a href="{{ route('galeri') }}" 
                       class="group flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-pink-500/20 hover:to-pink-600/20 hover:text-white transition-all duration-200 font-medium text-sm cursor-pointer {{ request()->routeIs('galeri') ? 'bg-gradient-to-r from-pink-500 to-pink-600 text-white shadow-lg' : '' }}"
                       :class="{'justify-center': sidebarCollapsed}">
                        <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                            <i class="fas fa-images text-white text-sm"></i>
                        </div>
                        <span class="text-sm font-medium transition-all duration-300 ml-3" 
                              :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">Galeri</span>
                    </a>
                </div>
                
                <!-- Admin Access Section - Enhanced -->
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'operator' || auth()->user()->role === 'editor')
                <div class="pt-6" :class="{'hidden': sidebarCollapsed}">
                    <div class="px-3 mb-4">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Admin Panel</p>
                        <div class="w-8 h-0.5 bg-gradient-to-r from-indigo-500 to-blue-500 mt-2 rounded-full"></div>
                    </div>
                    
                    <a href="{{ route('admin.dashboard') }}" 
                       class="group flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-indigo-500/20 hover:to-indigo-600/20 hover:text-white transition-all duration-200 font-medium text-sm cursor-pointer"
                       :class="{'justify-center': sidebarCollapsed}">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                            <i class="fas fa-cog text-white text-sm"></i>
                        </div>
                        <span class="text-sm font-medium transition-all duration-300 ml-3" 
                              :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">Admin Dashboard</span>
                    </a>
                </div>
                @endif
                
                <!-- Quick Actions Section - Enhanced -->
                <div class="pt-6" :class="{'hidden': sidebarCollapsed}">
                    <div class="px-3 mb-4">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Quick Actions</p>
                        <div class="w-8 h-0.5 bg-gradient-to-r from-cyan-500 to-blue-500 mt-2 rounded-full"></div>
                    </div>
                    
                    <div class="space-y-2">
                        <a href="{{ route('profile.show') }}" class="group flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-cyan-500/20 hover:to-blue-500/20 hover:text-white transition-all duration-200 text-sm cursor-pointer">
                            <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                <i class="fas fa-user-edit text-white text-sm"></i>
                            </div>
                            <span class="text-sm font-semibold ml-3">Edit Profil</span>
                        </a>
                        
                        <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-cyan-500/20 hover:to-blue-500/20 hover:text-white transition-all duration-200 text-sm cursor-pointer">
                            <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                <i class="fas fa-home text-white text-sm"></i>
                            </div>
                            <span class="text-sm font-semibold ml-3">Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- Enhanced Mobile overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" 
         class="fixed inset-0 z-40 bg-gray-900 bg-opacity-75 lg:hidden transition-opacity duration-300 backdrop-blur-sm"></div>

    <!-- Enhanced Main Content -->
    <div class="flex-1 flex flex-col min-w-0 transition-all duration-300 ease-in-out" :class="{'lg:ml-20': sidebarCollapsed, 'lg:ml-72': !sidebarCollapsed}">
        
        <!-- Enhanced Top Navigation -->
        <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30 backdrop-blur-sm bg-white/95">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <!-- Enhanced Mobile menu button -->
                <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition-all duration-200">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                
                <!-- Enhanced Page Title -->
                <div class="flex-1 ml-4 lg:ml-0">
                    <h1 class="text-xl font-semibold text-gray-900">Profil User</h1>
                    <p class="text-sm text-gray-500">Kelola informasi profil Anda</p>
                </div>
                
                <!-- Enhanced Right side -->
                <div class="flex items-center space-x-4">
                    <!-- Enhanced Notifications -->
                    <button class="relative p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 rounded-lg transition-all duration-200 group">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                    </button>
                    
                    <!-- Enhanced User dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200 group">
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
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                            
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-user mr-3 text-gray-400"></i>Profil
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-tachometer-alt mr-3 text-gray-400"></i>Dashboard
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
        
        <!-- Enhanced Page Content -->
        <main class="flex-1 overflow-hidden bg-gray-50">
            @yield('content')
        </main>
    </div>
</div>

<!-- Enhanced Scripts -->
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
