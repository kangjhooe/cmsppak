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
                    <i class="fas fa-graduation-cap text-white text-xl relative z-10"></i>
                </div>
                <div class="ml-4 transition-all duration-300" :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">
                    <h1 class="text-xl font-bold text-white tracking-tight">Admin Panel</h1>
                    <p class="text-xs text-slate-300 font-medium">{{ $schoolName }}</p>
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
                
                <!-- Profile Management - Enhanced -->
                <a href="{{ route('admin.profile.index') }}" 
                   class="group flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-emerald-500/20 hover:to-emerald-600/20 hover:text-white transition-all duration-200 font-semibold text-sm cursor-pointer {{ request()->routeIs('admin.profile*') ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg' : '' }}"
                   :class="{'justify-center': sidebarCollapsed}">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                        <i class="fas fa-building text-white text-sm"></i>
                    </div>
                    <span class="text-sm font-semibold transition-all duration-300 ml-3" 
                          :class="{'opacity-0 w-0': sidebarCollapsed, 'opacity-100 w-auto': !sidebarCollapsed}">Profil {{ __('school') }}</span>
                </a>
                
                <!-- Content Management Section - Enhanced -->
                <div class="pt-6" :class="{'hidden': sidebarCollapsed}">
                    <div class="px-3 mb-4">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Manajemen Konten</p>
                        <div class="w-8 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 mt-2 rounded-full"></div>
                    </div>
                    
                    <!-- Berita Menu - Enhanced -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('berita')" 
                                class="w-full group flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-orange-500/20 hover:to-orange-600/20 hover:text-white transition-all duration-200 font-semibold text-sm cursor-pointer {{ request()->routeIs('admin.berita*') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                    <i class="fas fa-newspaper text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Berita</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300 group-hover:text-white" 
                               :class="{'rotate-180': activeMenu === 'berita'}"></i>
                        </button>
                        
                        <!-- Enhanced Submenu Berita -->
                        <div x-show="activeMenu === 'berita'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-4 space-y-1 border-l-2 border-orange-500/30 pl-4">
                            <a href="{{ route('admin.berita.index') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-orange-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.berita.index') ? 'bg-orange-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Daftar Berita</span>
                            </a>
                            <a href="{{ route('admin.berita.create') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-orange-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.berita.create') ? 'bg-orange-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Tambah Berita</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Agenda Menu - Enhanced -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('agenda')" 
                                class="w-full group flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-purple-500/20 hover:to-purple-600/20 hover:text-white transition-all duration-200 font-semibold text-sm cursor-pointer {{ request()->routeIs('admin.agenda*') ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                    <i class="fas fa-calendar-alt text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Agenda</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300 group-hover:text-white" 
                               :class="{'rotate-180': activeMenu === 'agenda'}"></i>
                        </button>
                        
                        <!-- Enhanced Submenu Agenda -->
                        <div x-show="activeMenu === 'agenda'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-4 space-y-1 border-l-2 border-purple-500/30 pl-4">
                            <a href="{{ route('admin.agenda.index') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-purple-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.agenda.index') ? 'bg-purple-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Daftar Agenda</span>
                            </a>
                            <a href="{{ route('admin.agenda.create') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-purple-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.agenda.create') ? 'bg-purple-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Tambah Agenda</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Galeri Menu - Enhanced -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('galeri')" 
                                class="w-full group flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-pink-500/20 hover:to-pink-600/20 hover:text-white transition-all duration-200 font-semibold text-sm cursor-pointer {{ request()->routeIs('admin.galeri*') ? 'bg-gradient-to-r from-pink-500 to-pink-600 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                    <i class="fas fa-images text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Galeri</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300 group-hover:text-white" 
                               :class="{'rotate-180': activeMenu === 'galeri'}"></i>
                        </button>
                        
                        <!-- Enhanced Submenu Galeri -->
                        <div x-show="activeMenu === 'galeri'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-4 space-y-1 border-l-2 border-pink-500/30 pl-4">
                            <a href="{{ route('admin.galeri.index') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-pink-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.galeri.index') ? 'bg-pink-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Daftar Galeri</span>
                            </a>
                            <a href="{{ route('admin.galeri.create') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-pink-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.galeri.create') ? 'bg-pink-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Tambah Galeri</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Downloads Menu - Enhanced -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('downloads')" 
                                class="w-full group flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-indigo-500/20 hover:to-indigo-600/20 hover:text-white transition-all duration-200 font-semibold text-sm cursor-pointer {{ request()->routeIs('admin.downloads*') ? 'bg-gradient-to-r from-indigo-500 to-indigo-600 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                    <i class="fas fa-download text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Downloads</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300 group-hover:text-white" 
                               :class="{'rotate-180': activeMenu === 'downloads'}"></i>
                        </button>
                        
                        <!-- Enhanced Submenu Downloads -->
                        <div x-show="activeMenu === 'downloads'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-4 space-y-1 border-l-2 border-indigo-500/30 pl-4">
                            <a href="{{ route('admin.downloads.index') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-indigo-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.downloads.index') ? 'bg-indigo-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Daftar File</span>
                            </a>
                            <a href="{{ route('admin.downloads.create') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-indigo-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.downloads.create') ? 'bg-indigo-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Upload File</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Buku Tamu Menu - Enhanced -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('buku-tamu')" 
                                class="w-full group flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-teal-500/20 hover:to-teal-600/20 hover:text-white transition-all duration-200 font-semibold text-sm cursor-pointer {{ request()->routeIs('admin.buku-tamu*') ? 'bg-gradient-to-r from-teal-500 to-teal-600 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                    <i class="fas fa-book text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Buku Tamu</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300 group-hover:text-white" 
                               :class="{'rotate-180': activeMenu === 'buku-tamu'}"></i>
                        </button>
                        
                        <!-- Enhanced Submenu Buku Tamu -->
                        <div x-show="activeMenu === 'buku-tamu'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-4 space-y-1 border-l-2 border-teal-500/30 pl-4">
                            <a href="{{ route('admin.buku-tamu.index') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-teal-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.buku-tamu.index') ? 'bg-teal-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Daftar Pesan</span>
                            </a>
                            <a href="{{ route('admin.buku-tamu.create') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-teal-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.buku-tamu.create') ? 'bg-teal-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Tambah Pesan</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Administration Section - Enhanced -->
                @can('manage users')
                <div class="pt-6" :class="{'hidden': sidebarCollapsed}">
                    <div class="px-3 mb-4">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Administrasi</p>
                        <div class="w-8 h-0.5 bg-gradient-to-r from-red-500 to-amber-500 mt-2 rounded-full"></div>
                    </div>
                    
                    <!-- Users Menu - Enhanced -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('users')" 
                                class="w-full group flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-red-500/20 hover:to-red-600/20 hover:text-white transition-all duration-200 font-semibold text-sm cursor-pointer {{ request()->routeIs('admin.users*') ? 'bg-gradient-to-r from-red-500 to-red-600 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                    <i class="fas fa-user-shield text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Users</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300 group-hover:text-white" 
                               :class="{'rotate-180': activeMenu === 'users'}"></i>
                        </button>
                        
                        <!-- Enhanced Submenu Users -->
                        <div x-show="activeMenu === 'users'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-4 space-y-1 border-l-2 border-red-500/30 pl-4">
                            <a href="{{ route('admin.users.index') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-red-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.users.index') ? 'bg-red-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Daftar Users</span>
                            </a>
                            <a href="{{ route('admin.users.create') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-red-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.users.create') ? 'bg-red-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Tambah User</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Roles Menu - Enhanced -->
                    <div class="space-y-2">
                        <button @click="toggleMenu('roles')" 
                                class="w-full group flex items-center justify-between px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-amber-500/20 hover:to-amber-600/20 hover:text-white transition-all duration-200 font-semibold text-sm cursor-pointer {{ request()->routeIs('admin.roles*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg' : '' }}">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                    <i class="fas fa-user-tag text-white text-sm"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3">Roles</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs transition-transform duration-200 text-slate-300 group-hover:text-white" 
                               :class="{'rotate-180': activeMenu === 'roles'}"></i>
                        </button>
                        
                        <!-- Enhanced Submenu Roles -->
                        <div x-show="activeMenu === 'roles'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="ml-4 space-y-1 border-l-2 border-amber-500/30 pl-4">
                            <a href="{{ route('admin.roles.index') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-amber-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.roles.index') ? 'bg-amber-500/20 text-white' : '' }}">
                                <i class="fas fa-list text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Daftar Roles</span>
                            </a>
                            <a href="{{ route('admin.roles.create') }}" 
                               class="group flex items-center px-4 py-2.5 text-slate-200 rounded-lg hover:bg-amber-500/20 hover:text-white transition-all duration-200 text-sm {{ request()->routeIs('admin.roles.create') ? 'bg-amber-500/20 text-white' : '' }}">
                                <i class="fas fa-plus text-xs mr-3 group-hover:scale-110 transition-transform duration-200"></i>
                                <span>Tambah Role</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endcan
                
                <!-- Quick Actions Section - Enhanced -->
                <div class="pt-6" :class="{'hidden': sidebarCollapsed}">
                    <div class="px-3 mb-4">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Quick Actions</p>
                        <div class="w-8 h-0.5 bg-gradient-to-r from-cyan-500 to-blue-500 mt-2 rounded-full"></div>
                    </div>
                    
                    <div class="space-y-2">
                        <a href="{{ route('admin.berita.create') }}" class="group flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-cyan-500/20 hover:to-blue-500/20 hover:text-white transition-all duration-200 text-sm cursor-pointer">
                            <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                <i class="fas fa-plus text-white text-sm"></i>
                            </div>
                            <span class="text-sm font-semibold ml-3">Tambah Berita</span>
                        </a>
                        
                        <a href="{{ route('admin.agenda.create') }}" class="group flex items-center px-4 py-3 text-slate-100 rounded-xl hover:bg-gradient-to-r hover:from-cyan-500/20 hover:to-blue-500/20 hover:text-white transition-all duration-200 text-sm cursor-pointer">
                            <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-200">
                                <i class="fas fa-calendar-plus text-white text-sm"></i>
                            </div>
                            <span class="text-sm font-semibold ml-3">Tambah Agenda</span>
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
                
                <!-- Enhanced Search Bar -->
                <div class="flex-1 max-w-lg ml-4 lg:ml-0">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 text-sm group-focus-within:text-blue-500 transition-colors duration-200"></i>
                        </div>
                        <input type="text" placeholder="Cari berita, agenda, guru..." 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all duration-200">
                    </div>
                </div>
                
                <!-- Enhanced Right side -->
                <div class="flex items-center space-x-4">
                    
                    <!-- Enhanced Notifications -->
                    <button class="relative p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 rounded-lg transition-all duration-200 group">
                        <i class="fas fa-bell text-lg"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                    </button>
                    
                    <!-- Enhanced Profile dropdown -->
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
