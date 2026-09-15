@extends('layouts.frontend')

@section('title', 'Download Area - ' . $schoolName)

@section('page-header')
    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-3">Download Area</h1>
    <p class="text-xl text-green-100 max-w-3xl mx-auto">
        Unduh dokumen penting, silabus, kurikulum, dan formulir yang diperlukan
    </p>
@endsection

@section('content')
<div class="bg-green-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search and Filter Section -->
        <div class="mb-8">
            <!-- Mobile Filter Toggle Button -->
            <button onclick="toggleFilterSection()" 
                    class="lg:hidden w-full mb-4 bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-4 rounded-2xl font-bold hover:from-green-700 hover:to-green-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-between">
                <span class="flex items-center">
                    <i class="fas fa-filter mr-3"></i>
                    <span>Filter & Pencarian</span>
                    @if(request('search') || request('kategori'))
                        <span class="ml-3 px-2 py-1 bg-white/30 rounded-full text-xs font-semibold">
                            Aktif
                        </span>
                    @endif
                </span>
                <i id="filterToggleIcon" class="fas fa-chevron-down transition-transform duration-300"></i>
            </button>
            
            <div id="filterSection" class="bg-white rounded-xl shadow-lg p-6 hidden lg:block">
                <form action="{{ route('downloads') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Cari dokumen..." 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
                    </div>
                </div>
                <div class="flex gap-3">
                    <select name="kategori" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 text-gray-900 bg-white">
                        <option value="" class="text-gray-900">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }} class="text-gray-900">
                                {{ ucfirst($kategori) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg transition-all duration-200 font-medium">
                        <i class="fas fa-search mr-2"></i>
                        Cari
                    </button>
                </div>
                </form>
            </div>
        </div>

        <!-- Downloads Grid -->
        @if($downloads->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($downloads as $download)
                <div class="group relative bg-gradient-to-br from-white via-green-50/30 to-green-50/50 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-white/20 backdrop-blur-sm flex flex-col h-full transform hover:-translate-y-2 hover:scale-[1.02]">
                    <!-- Decorative gradient overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 via-transparent to-green-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <!-- File type indicator bar -->
                    <div class="h-1 w-full 
                        @if($download->tipe_file == 'pdf') bg-gradient-to-r from-red-400 to-red-600
                        @elseif(in_array($download->tipe_file, ['doc', 'docx'])) bg-gradient-to-r from-blue-400 to-blue-600
                        @elseif(in_array($download->tipe_file, ['xls', 'xlsx'])) bg-gradient-to-r from-green-400 to-green-600
                        @elseif(in_array($download->tipe_file, ['ppt', 'pptx'])) bg-gradient-to-r from-orange-400 to-orange-600
                        @else bg-gradient-to-r from-gray-400 to-gray-600
                        @endif">
                    </div>
                    
                    <div class="p-6 flex flex-col flex-grow relative z-10">
                        <!-- Header dengan icon yang lebih menarik -->
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors duration-300 line-clamp-2 leading-tight">
                                    {{ $download->judul }}
                                </h3>
                                @if($download->deskripsi)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">{{ Str::limit($download->deskripsi, 120) }}</p>
                                @endif
                            </div>
                            <div class="flex-shrink-0 ml-4">
                                <div class="w-16 h-16 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-all duration-300
                                    @if($download->tipe_file == 'pdf') bg-gradient-to-br from-red-100 to-red-200
                                    @elseif(in_array($download->tipe_file, ['doc', 'docx'])) bg-gradient-to-br from-blue-100 to-blue-200
                                    @elseif(in_array($download->tipe_file, ['xls', 'xlsx'])) bg-gradient-to-br from-green-100 to-green-200
                                    @elseif(in_array($download->tipe_file, ['ppt', 'pptx'])) bg-gradient-to-br from-orange-100 to-orange-200
                                    @else bg-gradient-to-br from-gray-100 to-gray-200
                                    @endif">
                                    @if($download->tipe_file == 'pdf')
                                        <i class="fas fa-file-pdf text-red-500 text-2xl"></i>
                                    @elseif(in_array($download->tipe_file, ['doc', 'docx']))
                                        <i class="fas fa-file-word text-blue-500 text-2xl"></i>
                                    @elseif(in_array($download->tipe_file, ['xls', 'xlsx']))
                                        <i class="fas fa-file-excel text-green-500 text-2xl"></i>
                                    @elseif(in_array($download->tipe_file, ['ppt', 'pptx']))
                                        <i class="fas fa-file-powerpoint text-orange-500 text-2xl"></i>
                                    @else
                                        <i class="fas fa-file text-gray-500 text-2xl"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Info metadata dengan design yang lebih menarik -->
                        <div class="space-y-3 mb-6 flex-grow">
                            <div class="flex items-center justify-between p-3 bg-white/60 rounded-xl backdrop-blur-sm border border-white/40">
                                <span class="flex items-center text-sm font-medium text-gray-700">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center mr-3">
                                        <i class="fas fa-tag text-green-600 text-xs"></i>
                                    </div>
                                    {{ ucfirst($download->kategori) }}
                                </span>
                                <span class="flex items-center text-sm font-medium text-gray-700">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center mr-3">
                                        <i class="fas fa-download text-green-600 text-xs"></i>
                                    </div>
                                    {{ $download->jumlah_download }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-white/60 rounded-xl backdrop-blur-sm border border-white/40">
                                <span class="flex items-center text-sm font-medium text-gray-700">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center mr-3">
                                        <i class="fas fa-file text-purple-600 text-xs"></i>
                                    </div>
                                    {{ strtoupper($download->tipe_file) }}
                                </span>
                                <span class="flex items-center text-sm font-medium text-gray-700">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center mr-3">
                                        <i class="fas fa-weight-hanging text-orange-600 text-xs"></i>
                                    </div>
                                    {{ $download->ukuran_file_formatted }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Action buttons dengan design yang lebih menarik -->
                        <div class="flex space-x-3 mt-auto">
                            <a href="{{ route('downloads.download', $download) }}" 
                               class="flex-1 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white text-center py-3 px-4 rounded-xl transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center">
                                <i class="fas fa-download mr-2"></i>
                                Download
                            </a>
                            <a href="{{ route('downloads.show', $download) }}" 
                               class="w-12 h-12 bg-gradient-to-br from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-center">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($downloads->hasPages())
            <div class="mt-12">
                {{ $downloads->links() }}
            </div>
            @endif
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-file-download text-6xl"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada file download</h3>
                <p class="text-gray-600">File download akan ditampilkan di sini.</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
// Toggle filter section for mobile
function toggleFilterSection() {
    const filterSection = document.getElementById('filterSection');
    const toggleIcon = document.getElementById('filterToggleIcon');
    
    if (filterSection) {
        if (filterSection.classList.contains('hidden')) {
            filterSection.classList.remove('hidden');
            if (toggleIcon) {
                toggleIcon.classList.remove('fa-chevron-down');
                toggleIcon.classList.add('fa-chevron-up');
            }
        } else {
            if (window.innerWidth < 1024) {
                filterSection.classList.add('hidden');
                if (toggleIcon) {
                    toggleIcon.classList.remove('fa-chevron-up');
                    toggleIcon.classList.add('fa-chevron-down');
                }
            }
        }
    }
}

// Handle window resize for filter section
document.addEventListener('DOMContentLoaded', function() {
    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const filterSection = document.getElementById('filterSection');
            if (window.innerWidth >= 1024) {
                // Desktop: always show
                filterSection.classList.remove('hidden');
            }
            // Mobile: always hidden by default (user must click toggle to show)
        }, 250);
    });
});
</script>
@endpush
@endsection
