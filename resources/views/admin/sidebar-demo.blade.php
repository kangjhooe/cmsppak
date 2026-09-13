@extends('layouts.admin-simple')

@section('title', 'Sidebar Demo - Admin Dashboard')

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Sidebar Demo Dashboard</h1>
        <p class="text-gray-600">Halaman demo untuk testing fitur sidebar admin yang lengkap dan modern</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-newspaper text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Berita</p>
                    <p class="text-2xl font-bold text-gray-900">24</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Guru & Staf</p>
                    <p class="text-2xl font-bold text-gray-900">18</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Agenda</p>
                    <p class="text-2xl font-bold text-gray-900">12</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-download text-white text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Downloads</p>
                    <p class="text-2xl font-bold text-gray-900">8</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 mb-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                Tambah Berita
            </a>
            <a href="{{ route('admin.agenda.create') }}" class="inline-flex items-center px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg transition-colors duration-200">
                <i class="fas fa-calendar-plus mr-2"></i>
                Tambah Agenda
            </a>
            <a href="{{ route('admin.guru-staf.create') }}" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors duration-200">
                <i class="fas fa-user-plus mr-2"></i>
                Tambah Guru/Staf
            </a>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Activities</h2>
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-newspaper text-blue-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Berita baru ditambahkan</p>
                        <p class="text-xs text-gray-500">2 jam yang lalu</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-green-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Guru baru ditambahkan</p>
                        <p class="text-xs text-gray-500">4 jam yang lalu</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar text-purple-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Agenda baru ditambahkan</p>
                        <p class="text-xs text-gray-500">6 jam yang lalu</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Stats</h2>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Berita Views</span>
                    <span class="text-sm font-semibold text-gray-900">1,234</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Total Users</span>
                    <span class="text-sm font-semibold text-gray-900">156</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">Active Sessions</span>
                    <span class="text-sm font-semibold text-gray-900">23</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600">System Load</span>
                    <span class="text-sm font-semibold text-green-600">Normal</span>
                </div>
            </div>
        </div>
    </div>

    <!-- System Info -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">System Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-600 mb-2">Server Status</h3>
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-sm text-gray-900">Online</span>
                </div>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-600 mb-2">Database</h3>
                <span class="text-sm text-gray-900">Connected</span>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-600 mb-2">Last Backup</h3>
                <span class="text-sm text-gray-900">2 jam yang lalu</span>
            </div>
        </div>
    </div>

    <!-- Sidebar Features Demo -->
    <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-200">
        <h2 class="text-lg font-semibold text-blue-900 mb-4">✨ Sidebar Features Demo</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-blue-800">
            <div>
                <h3 class="font-semibold mb-2">🎯 Fitur Utama:</h3>
                <ul class="space-y-1">
                    <li>• Sidebar yang dapat di-collapse</li>
                    <li>• Menu dropdown dengan submenu</li>
                    <li>• Responsive untuk mobile dan desktop</li>
                    <li>• Active state untuk menu yang sedang aktif</li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold mb-2">⌨️ Shortcuts:</h3>
                <ul class="space-y-1">
                    <li>• <kbd class="px-2 py-1 bg-blue-200 rounded text-xs">Ctrl + B</kbd> Toggle sidebar</li>
                    <li>• <kbd class="px-2 py-1 bg-blue-200 rounded text-xs">Click</kbd> Menu untuk expand/collapse</li>
                    <li>• <kbd class="px-2 py-1 bg-blue-200 rounded text-xs">Mobile</kbd> Tap untuk buka sidebar</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
