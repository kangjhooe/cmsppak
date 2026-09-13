<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Fallback CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    <div x-data="{ sidebarOpen: true }" class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-72 bg-gradient-to-b from-slate-800 via-slate-700 to-slate-800 shadow-2xl">
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
            </div>

            <!-- Sidebar Navigation -->
            <nav class="mt-6 px-4 pb-6 overflow-y-auto h-[calc(100vh-5rem)]">
                <div class="space-y-2">
                    <!-- Dashboard -->
                    <div>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg' : 'hover:bg-slate-600/50 hover:text-white' }}">
                            <div class="w-10 h-10 {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                <i class="fas fa-tachometer-alt text-sm {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                            </div>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </div>
                    
                    <!-- Guru & Staf Menu -->
                    <div>
                        <a href="{{ route('admin.guru-staf.index') }}" 
                           class="flex items-center px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group {{ request()->routeIs('admin.guru-staf*') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'hover:bg-slate-600/50 hover:text-white' }}">
                            <div class="w-10 h-10 {{ request()->routeIs('admin.guru-staf*') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                <i class="fas fa-users text-sm {{ request()->routeIs('admin.guru-staf*') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                            </div>
                            <span class="ml-3">Guru & Staf</span>
                        </a>
                    </div>
                    
                    <!-- Berita Menu -->
                    <div>
                        <a href="{{ route('admin.berita.index') }}" 
                           class="flex items-center px-4 py-3 text-slate-100 rounded-xl transition-all duration-200 font-medium text-sm group {{ request()->routeIs('admin.berita*') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'hover:bg-slate-600/50 hover:text-white' }}">
                            <div class="w-10 h-10 {{ request()->routeIs('admin.berita*') ? 'bg-white/20' : 'bg-slate-600/50 group-hover:bg-slate-500/50' }} rounded-xl flex items-center justify-center transition-colors">
                                <i class="fas fa-newspaper text-sm {{ request()->routeIs('admin.berita*') ? 'text-white' : 'text-slate-300 group-hover:text-white' }}"></i>
                            </div>
                            <span class="ml-3">Berita</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
                <div class="flex items-center justify-between h-16 px-6">
                    <div class="flex items-center space-x-4">
                        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-bars text-lg"></i>
                        </button>
                        <h2 class="text-lg font-semibold text-gray-900">Admin Dashboard</h2>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg">
                                    <span class="text-white text-sm font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <span class="hidden md:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-auto bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
