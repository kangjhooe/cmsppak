@extends('layouts.admin-simple')

@section('title', 'Manajemen Galeri - ' . ($schoolName ?? ''))

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-2">Manajemen Galeri</h1>
                    <p class="text-purple-100">Kelola semua foto dan video galeri website</p>
                </div>
                <div class="hidden md:block">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-images text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Test Content -->
        <div class="card p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Test View Galeri</h2>
            <p class="text-gray-600 mb-4">Ini adalah halaman test untuk memverifikasi bahwa view galeri bisa diakses.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-4 bg-green-100 rounded-lg">
                    <h3 class="font-medium text-green-800">✅ View Berhasil</h3>
                    <p class="text-sm text-green-600">Halaman galeri bisa diakses</p>
                </div>
                
                <div class="p-4 bg-blue-100 rounded-lg">
                    <h3 class="font-medium text-blue-800">📁 File View</h3>
                    <p class="text-sm text-blue-600">Semua file view sudah dibuat</p>
                </div>
                
                <div class="p-4 bg-purple-100 rounded-lg">
                    <h3 class="font-medium text-purple-800">🔗 Route</h3>
                    <p class="text-sm text-purple-600">Route sudah terdaftar</p>
                </div>
            </div>
            
            <div class="mt-6 p-4 bg-yellow-100 rounded-lg">
                <h3 class="font-medium text-yellow-800">⚠️ Catatan</h3>
                <p class="text-sm text-yellow-600">
                    Halaman ini adalah versi test. Untuk halaman lengkap dengan data, 
                    pastikan controller mengirimkan variabel <code>$galeri</code>.
                </p>
            </div>
        </div>
    </div>
@endsection
