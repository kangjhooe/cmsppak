@extends('layouts.frontend')

@section('title', $download->judul . ' - Download Area - ' . $schoolName)

@section('page-header')
    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $download->judul }}</h1>
    <p class="text-xl text-blue-100 max-w-3xl mx-auto">
        Detail file download
    </p>
@endsection

@section('content')
<div class="bg-gradient-to-br from-green-50 via-lime-50 to-yellow-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Main Container -->
        <div class="bg-white rounded-3xl shadow-2xl border border-green-200 overflow-hidden">
            <!-- File Header -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 p-6 sm:p-8 text-white">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl sm:text-3xl font-bold mb-2 break-words">{{ $download->judul }}</h2>
                        @if($download->deskripsi)
                            <p class="text-green-100 text-sm sm:text-base leading-relaxed break-words">{{ $download->deskripsi }}</p>
                        @endif
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                            @if($download->tipe_file == 'pdf')
                                <i class="fas fa-file-pdf text-white text-2xl sm:text-4xl"></i>
                            @elseif(in_array($download->tipe_file, ['doc', 'docx']))
                                <i class="fas fa-file-word text-white text-2xl sm:text-4xl"></i>
                            @elseif(in_array($download->tipe_file, ['xls', 'xlsx']))
                                <i class="fas fa-file-excel text-white text-2xl sm:text-4xl"></i>
                            @elseif(in_array($download->tipe_file, ['ppt', 'pptx']))
                                <i class="fas fa-file-powerpoint text-white text-2xl sm:text-4xl"></i>
                            @else
                                <i class="fas fa-file text-white text-2xl sm:text-4xl"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-4 sm:p-6 lg:p-8">
                <!-- File Details Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">
                    <!-- Kategori -->
                    <div class="bg-gradient-to-r from-green-50 to-green-100 p-4 sm:p-6 rounded-2xl border border-green-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-500 rounded-xl flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-tag text-white text-sm sm:text-lg"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-gray-600 text-xs sm:text-sm font-medium block">Kategori</span>
                                <div class="bg-green-500 text-white px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-semibold inline-block mt-1">
                                    {{ ucfirst($download->kategori) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Jumlah Download -->
                    <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 p-4 sm:p-6 rounded-2xl border border-emerald-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-emerald-500 rounded-xl flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-download text-white text-sm sm:text-lg"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-gray-600 text-xs sm:text-sm font-medium block">Jumlah Download</span>
                                <div class="text-gray-800 font-semibold text-sm sm:text-base mt-1">{{ $download->jumlah_download }} kali</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Nama File -->
                    <div class="bg-gradient-to-r from-lime-50 to-lime-100 p-4 sm:p-6 rounded-2xl border border-lime-200 sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-teal-500 rounded-xl flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-file text-white text-sm sm:text-lg"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-gray-600 text-xs sm:text-sm font-medium block">Nama File</span>
                                <div class="text-gray-800 font-semibold text-xs sm:text-sm mt-1 break-all">{{ $download->nama_file }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tanggal Upload -->
                    <div class="bg-gradient-to-r from-teal-50 to-teal-100 p-4 sm:p-6 rounded-2xl border border-teal-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-teal-500 rounded-xl flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-calendar text-white text-sm sm:text-lg"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-gray-600 text-xs sm:text-sm font-medium block">Tanggal Upload</span>
                                <div class="text-gray-800 font-semibold text-sm sm:text-base mt-1">{{ $download->created_at->format('d-m-Y') }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Ukuran File -->
                    <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 p-4 sm:p-6 rounded-2xl border border-yellow-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-yellow-500 rounded-xl flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-weight-hanging text-white text-sm sm:text-lg"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-gray-600 text-xs sm:text-sm font-medium block">Ukuran File</span>
                                <div class="text-gray-800 font-semibold text-sm sm:text-base mt-1">{{ $download->ukuran_file_formatted }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Waktu Upload -->
                    <div class="bg-gradient-to-r from-amber-50 to-amber-100 p-4 sm:p-6 rounded-2xl border border-amber-200">
                        <div class="flex items-center">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-amber-500 rounded-xl flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-clock text-white text-sm sm:text-lg"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="text-gray-600 text-xs sm:text-sm font-medium block">Waktu Upload</span>
                                <div class="text-gray-800 font-semibold text-sm sm:text-base mt-1">{{ $download->created_at->format('H:i') }} WIB</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Download Section -->
                <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-3xl p-6 sm:p-8 shadow-2xl">
                    <div class="text-center">
                        <h3 class="text-white text-lg sm:text-xl font-bold mb-2">Siap untuk Download</h3>
                        <p class="text-green-100 text-sm mb-6">Klik tombol di bawah untuk mengunduh file</p>
                        
                        <a href="{{ route('downloads.download', $download) }}" 
                           class="group inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white hover:text-white px-6 sm:px-8 py-3 sm:py-4 rounded-2xl transition-all duration-300 font-bold text-base sm:text-lg shadow-lg hover:shadow-xl transform hover:scale-105">
                            <div class="w-6 h-6 sm:w-8 sm:h-8 bg-white/20 group-hover:bg-white/30 rounded-lg flex items-center justify-center mr-2 sm:mr-3 transition-all duration-300">
                                <i class="fas fa-download text-white text-sm sm:text-lg"></i>
                            </div>
                            <span>Download Sekarang</span>
                        </a>
                        
                        <p class="text-green-100 text-xs mt-4 flex items-center justify-center">
                            <i class="fas fa-shield-alt mr-2"></i>
                            File aman dan akan langsung terdownload
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-6 sm:mt-8">
            <a href="{{ route('downloads') }}" 
               class="group inline-flex items-center bg-white hover:bg-green-50 text-green-700 hover:text-green-800 px-4 sm:px-6 py-2 sm:py-3 rounded-2xl border border-green-200 hover:border-green-300 transition-all duration-300 shadow-lg hover:shadow-xl">
                <div class="w-6 h-6 sm:w-8 sm:h-8 bg-green-100 group-hover:bg-green-200 rounded-xl flex items-center justify-center mr-2 sm:mr-3 transition-all duration-300">
                    <i class="fas fa-arrow-left text-green-600 text-xs sm:text-sm"></i>
                </div>
                <span class="font-semibold text-sm sm:text-base">Kembali ke Download Area</span>
            </a>
        </div>
    </div>
</div>
@endsection
