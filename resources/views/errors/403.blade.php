@extends('layouts.frontend')

@section('title', 'Akses Ditolak - ' . $schoolName)

@section('content')
<div class="bg-gray-50 py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-8">
            <div class="mx-auto w-32 h-32 bg-yellow-100 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-ban text-6xl text-yellow-500"></i>
            </div>
            <h1 class="text-6xl font-bold text-gray-900 mb-4">403</h1>
            <h2 class="text-3xl font-semibold text-gray-700 mb-4">Akses Ditolak</h2>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Jika Anda yakin ini adalah kesalahan, silakan hubungi administrator.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-home mr-2"></i>
                Kembali ke Beranda
            </a>
            <a href="{{ route('kontak') }}" class="border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-envelope mr-2"></i>
                Hubungi Kami
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-6">Halaman yang Tersedia</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-newspaper text-2xl text-blue-600"></i>
                    </div>
                    <h4 class="font-medium text-gray-900 mb-2">Berita</h4>
                    <a href="{{ route('berita') }}" class="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-200">
                        Lihat Berita
                    </a>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-alt text-2xl text-green-600"></i>
                    </div>
                    <h4 class="font-medium text-gray-900 mb-2">Agenda</h4>
                    <a href="{{ route('agenda') }}" class="text-sm text-green-600 hover:text-green-800 transition-colors duration-200">
                        Lihat Agenda
                    </a>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-images text-2xl text-purple-600"></i>
                    </div>
                    <h4 class="font-medium text-gray-900 mb-2">Galeri</h4>
                    <a href="{{ route('galeri') }}" class="text-sm text-purple-600 hover:text-purple-800 transition-colors duration-200">
                        Lihat Galeri
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-8 text-sm text-gray-500">
            <p>Jika Anda memerlukan akses khusus, silakan <a href="{{ route('kontak') }}" class="text-blue-600 hover:text-blue-800">hubungi kami</a>.</p>
        </div>
    </div>
</div>
@endsection
