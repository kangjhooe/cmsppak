@extends('layouts.frontend')

@section('title', 'Layanan Sedang Maintenance - ' . $schoolName)

@section('content')
<div class="bg-gray-50 py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="mb-8">
            <div class="mx-auto w-32 h-32 bg-yellow-100 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-tools text-6xl text-yellow-500"></i>
            </div>
            <h1 class="text-6xl font-bold text-gray-900 mb-4">503</h1>
            <h2 class="text-3xl font-semibold text-gray-700 mb-4">Layanan Sedang Maintenance</h2>
            <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                Maaf, website sedang dalam pemeliharaan untuk meningkatkan layanan. Kami akan segera kembali dengan fitur yang lebih baik.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
            <button onclick="window.location.reload()" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-redo mr-2"></i>
                Coba Lagi
            </button>
            <a href="{{ route('kontak') }}" class="border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                <i class="fas fa-envelope mr-2"></i>
                Hubungi Kami
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-6">Yang Sedang Kami Lakukan</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-cog text-2xl text-blue-600"></i>
                    </div>
                    <h4 class="font-medium text-gray-900 mb-2">Update Sistem</h4>
                    <p class="text-sm text-gray-600">Memperbarui fitur dan keamanan</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-database text-2xl text-green-600"></i>
                    </div>
                    <h4 class="font-medium text-gray-900 mb-2">Optimasi Database</h4>
                    <p class="text-sm text-gray-600">Meningkatkan performa sistem</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-2xl text-purple-600"></i>
                    </div>
                    <h4 class="font-medium text-gray-900 mb-2">Keamanan</h4>
                    <p class="text-sm text-gray-600">Memperkuat sistem keamanan</p>
                </div>
            </div>
        </div>

        <div class="mt-8 text-sm text-gray-500">
            <p>Perkiraan waktu selesai: <span class="font-medium">30-60 menit</span></p>
            <p class="mt-2">Untuk informasi lebih lanjut, silakan <a href="{{ route('kontak') }}" class="text-blue-600 hover:text-blue-800">hubungi kami</a>.</p>
        </div>
    </div>
</div>

<script>
// Auto-reload every 2 minutes
setInterval(function() {
    window.location.reload();
}, 120000);
</script>
@endsection
