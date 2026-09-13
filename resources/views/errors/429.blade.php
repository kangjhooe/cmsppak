@extends('layouts.frontend')

@section('title', 'Terlalu Banyak Permintaan - ' . $schoolName)

@section('content')
<div class="bg-gray-50 py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-8">
            <div class="mx-auto w-32 h-32 bg-red-100 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-tachometer-alt text-6xl text-red-500"></i>
            </div>
            <h1 class="text-6xl font-bold text-gray-900 mb-4">429</h1>
            <h2 class="text-3xl font-semibold text-gray-700 mb-4">Terlalu Banyak Permintaan</h2>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Maaf, Anda telah mengirim terlalu banyak permintaan dalam waktu singkat. Silakan tunggu beberapa saat sebelum mencoba lagi.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-home mr-2"></i>
                Kembali ke Beranda
            </a>
            <button onclick="setTimeout(() => window.location.reload(), 5000)" class="border-2 border-red-600 text-red-600 hover:bg-red-600 hover:text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-clock mr-2"></i>
                Coba Lagi (5 detik)
            </button>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-6">Mengapa Ini Terjadi?</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="text-left">
                    <h4 class="font-medium text-gray-900 mb-3">Kemungkinan Penyebab</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>Refresh halaman terlalu cepat</li>
                        <li>Mengirim form berulang kali</li>
                        <li>Bot atau script otomatis</li>
                    </ul>
                </div>
                <div class="text-left">
                    <h4 class="font-medium text-gray-900 mb-3">Solusi</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>Tunggu beberapa menit</li>
                        <li>Jangan refresh terlalu cepat</li>
                        <li>Gunakan tombol "Coba Lagi"</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-8 text-sm text-gray-500">
            <p>Jika masalah berlanjut, silakan <a href="{{ route('kontak') }}" class="text-blue-600 hover:text-blue-800">hubungi kami</a> untuk bantuan lebih lanjut.</p>
        </div>
    </div>
</div>

<script>
// Auto-reload after 30 seconds
setTimeout(function() {
    window.location.reload();
}, 30000);
</script>
@endsection
