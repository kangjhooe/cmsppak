@extends('layouts.frontend')

@section('title', 'Halaman Kedaluwarsa - ' . $schoolName)

@section('content')
<div class="bg-gray-50 py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-8">
            <div class="mx-auto w-32 h-32 bg-orange-100 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-clock text-6xl text-orange-500"></i>
            </div>
            <h1 class="text-6xl font-bold text-gray-900 mb-4">419</h1>
            <h2 class="text-3xl font-semibold text-gray-700 mb-4">Halaman Kedaluwarsa</h2>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Maaf, halaman yang Anda akses telah kedaluwarsa. Ini biasanya terjadi karena sesi Anda telah berakhir atau token CSRF tidak valid.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-home mr-2"></i>
                Kembali ke Beranda
            </a>
            <button onclick="window.location.reload()" class="border-2 border-orange-600 text-orange-600 hover:bg-orange-600 hover:text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-redo mr-2"></i>
                Coba Lagi
            </button>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-6">Solusi yang Bisa Dicoba</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="text-left">
                    <h4 class="font-medium text-gray-900 mb-3">Refresh Halaman</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>Tekan F5 atau Ctrl+R</li>
                        <li>Klik tombol refresh browser</li>
                        <li>Gunakan menu browser</li>
                    </ul>
                </div>
                <div class="text-left">
                    <h4 class="font-medium text-gray-900 mb-3">Hapus Cache</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>Hapus cache browser</li>
                        <li>Hapus cookies</li>
                        <li>Gunakan mode incognito</li>
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
