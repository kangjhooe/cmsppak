@extends('layouts.admin-simple')

@section('title', 'Sidebar Preview - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white mb-4">Sidebar Preview</h1>
                <p class="text-xl text-blue-100">Lihat fitur sidebar yang baru dengan menu bertumpuk</p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Nested Menu -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-sitemap text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Menu Bertumpuk</h3>
                <p class="text-gray-600 text-sm">Setiap menu utama bisa diklik untuk menampilkan submenu dengan animasi accordion yang smooth.</p>
            </div>

            <!-- Responsive Design -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-mobile-alt text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Responsif</h3>
                <p class="text-gray-600 text-sm">Sidebar otomatis collapse pada layar mobile dengan tombol hamburger dan overlay.</p>
            </div>

            <!-- Smooth Animations -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-all duration-300">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-magic text-white text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Animasi Halus</h3>
                <p class="text-gray-600 text-sm">Transisi slide down/up yang smooth dengan Alpine.js dan Tailwind CSS.</p>
            </div>
        </div>

        <!-- Instructions -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Cara Menggunakan Sidebar</h2>
            <div class="space-y-4">
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0 mt-1">1</div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Buka Menu</h3>
                        <p class="text-gray-600 text-sm">Klik pada menu utama (seperti "Guru & Staf", "Berita", dll) untuk membuka submenu.</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0 mt-1">2</div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Navigasi Submenu</h3>
                        <p class="text-gray-600 text-sm">Setelah submenu terbuka, klik pada item submenu untuk navigasi ke halaman yang sesuai.</p>
                    </div>
                </div>
                
                <div class="flex items-start space-x-3">
                    <div class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0 mt-1">3</div>
                    <div>
                        <h3 class="font-semibold text-gray-900">Mobile Navigation</h3>
                        <p class="text-gray-600 text-sm">Pada layar mobile, gunakan tombol hamburger di header untuk membuka/menutup sidebar.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Structure -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Struktur Menu yang Tersedia</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Content Management -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-folder-open text-blue-500 mr-2"></i>
                        Manajemen Konten
                    </h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-users text-gray-400 w-4"></i>
                            <span class="text-gray-700">Guru & Staf</span>
                            <span class="text-xs text-gray-500">(2 submenu)</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-newspaper text-gray-400 w-4"></i>
                            <span class="text-gray-700">Berita</span>
                            <span class="text-xs text-gray-500">(2 submenu)</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar-alt text-gray-400 w-4"></i>
                            <span class="text-gray-700">Agenda</span>
                            <span class="text-xs text-gray-500">(2 submenu)</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-images text-gray-400 w-4"></i>
                            <span class="text-gray-700">Galeri</span>
                            <span class="text-xs text-gray-500">(2 submenu)</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-download text-gray-400 w-4"></i>
                            <span class="text-gray-700">Downloads</span>
                            <span class="text-xs text-gray-500">(2 submenu)</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-book text-gray-400 w-4"></i>
                            <span class="text-gray-700">Buku Tamu</span>
                            <span class="text-xs text-gray-500">(2 submenu)</span>
                        </div>
                    </div>
                </div>

                <!-- Administration -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-cogs text-purple-500 mr-2"></i>
                        Administrasi
                    </h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-user-cog text-gray-400 w-4"></i>
                            <span class="text-gray-700">Users</span>
                            <span class="text-xs text-gray-500">(2 submenu)</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-shield-alt text-gray-400 w-4"></i>
                            <span class="text-gray-700">Roles</span>
                            <span class="text-xs text-gray-500">(2 submenu)</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-xs text-yellow-800">
                            <i class="fas fa-info-circle mr-1"></i>
                            Menu Administrasi hanya tersedia untuk user dengan role Admin.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Technical Details -->
        <div class="bg-gray-50 rounded-xl p-6 mt-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Detail Teknis</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div class="bg-white p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-900 mb-2">Frontend</h4>
                    <ul class="text-gray-600 space-y-1">
                        <li>• Tailwind CSS</li>
                        <li>• Alpine.js 3.x</li>
                        <li>• Font Awesome Icons</li>
                        <li>• Responsive Design</li>
                    </ul>
                </div>
                
                <div class="bg-white p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-900 mb-2">Features</h4>
                    <ul class="text-gray-600 space-y-1">
                        <li>• Nested Menu Support</li>
                        <li>• Smooth Animations</li>
                        <li>• Mobile Responsive</li>
                        <li>• Keyboard Navigation</li>
                    </ul>
                </div>
                
                <div class="bg-white p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-900 mb-2">Performance</h4>
                    <ul class="text-gray-600 space-y-1">
                        <li>• Lazy Loading</li>
                        <li>• Optimized CSS</li>
                        <li>• Minimal JavaScript</li>
                        <li>• Smooth Transitions</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Demo script untuk menampilkan fitur sidebar
document.addEventListener('DOMContentLoaded', function() {
    // Auto-expand menu untuk demo
    setTimeout(() => {
        const alpineComponent = document.querySelector('[x-data]').__x.$data;
        if (alpineComponent) {
            alpineComponent.activeMenu = 'berita';
        }
    }, 1000);
    
    // Auto-close setelah 3 detik
    setTimeout(() => {
        const alpineComponent = document.querySelector('[x-data]').__x.$data;
        if (alpineComponent) {
            alpineComponent.activeMenu = null;
        }
    }, 4000);
});
</script>
@endpush
