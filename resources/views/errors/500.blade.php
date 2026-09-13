@extends('layouts.frontend')

@section('title', 'Kesalahan Server - ' . $schoolName)

@section('content')
<div class="bg-gray-50 py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-8">
            <div class="mx-auto w-32 h-32 bg-red-100 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-server text-6xl text-red-500"></i>
            </div>
            <h1 class="text-6xl font-bold text-gray-900 mb-4">500</h1>
            <h2 class="text-3xl font-semibold text-gray-700 mb-4">Kesalahan Server</h2>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Maaf, terjadi kesalahan pada server kami. Tim teknis telah diberitahu dan sedang mengatasi masalah ini. Silakan coba lagi dalam beberapa saat.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-home mr-2"></i>
                Kembali ke Beranda
            </a>
            <a href="{{ route('kontak') }}" class="border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-envelope mr-2"></i>
                Laporkan Masalah
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-6">Yang Bisa Anda Lakukan</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="text-left">
                    <h4 class="font-medium text-gray-900 mb-3">Coba Lagi</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>Refresh halaman ini</li>
                        <li>Hapus cache browser</li>
                        <li>Coba dari browser lain</li>
                    </ul>
                </div>
                <div class="text-left">
                    <h4 class="font-medium text-gray-900 mb-3">Alternatif</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li><a href="{{ route('berita') }}" class="hover:text-blue-600 transition-colors duration-200">Lihat Berita</a></li>
                        <li><a href="{{ route('agenda') }}" class="hover:text-blue-600 transition-colors duration-200">Lihat Agenda</a></li>
                        <li><a href="{{ route('galeri') }}" class="hover:text-blue-600 transition-colors duration-200">Lihat Galeri</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-8 text-sm text-gray-500">
            <p>Jika masalah berlanjut, silakan <a href="{{ route('kontak') }}" class="text-blue-600 hover:text-blue-800">hubungi kami</a> untuk bantuan lebih lanjut.</p>
        </div>
    </div>
</div>
@endsection
