@extends('layouts.frontend')

@section('title', 'Galeri - ' . $schoolName)

@section('page-header')
    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-3">Galeri Foto & Video</h1>
    <p class="text-xl text-blue-100 max-w-3xl mx-auto">
        Dokumentasi visual kegiatan, prestasi, dan momen berharga di {{ $profile->nama_sekolah ?? $schoolName }}
    </p>
@endsection

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search and Sort Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <form action="{{ route('galeri') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Cari galeri..." 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
                    </div>
                </div>
                <div class="flex gap-3">
                    <select name="sort" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 text-gray-900 bg-white">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    </select>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-all duration-200 font-medium">
                        <i class="fas fa-search mr-2"></i>
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Featured Galeri -->
        @if($galeri->count() > 0)
        <div class="mb-8">
            <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-2xl shadow-lg overflow-hidden border border-green-100">
                <div class="md:flex">
                    <div class="md:w-1/2">
                        @if($galeri->first()->thumbnailItem && $galeri->first()->thumbnailItem->preview_url)
                        <img src="{{ $galeri->first()->thumbnailItem->preview_url }}" 
                             alt="{{ $galeri->first()->judul }}" 
                             class="w-full h-64 object-cover">
                        @else
                        <div class="w-full h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div class="md:w-1/2 p-5">
                        <div class="flex items-center mb-2">
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold mr-2">
                                {{ ucfirst($galeri->first()->kategori) }}
                            </span>
                            <span class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $galeri->first()->jumlah_item }} item
                            </span>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900 mb-2 hover:text-green-600 transition-colors duration-200">
                            {{ $galeri->first()->judul }}
                        </h2>
                        <p class="text-gray-600 mb-3 leading-relaxed text-sm">{{ Str::limit(strip_tags($galeri->first()->deskripsi), 100) }}</p>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-calendar mr-2"></i>
                                <span>{{ $galeri->first()->created_at->format('d-m-Y') }}</span>
                            </div>
                            
                            <a href="{{ route('galeri.show', $galeri->first()->id) }}" 
                               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-all duration-200 font-medium text-sm">
                                <i class="fas fa-eye mr-1"></i>
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($galeri->skip(1) as $item)
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                <div class="relative overflow-hidden">
                    @if($item->thumbnailItem && $item->thumbnailItem->preview_url)
                    <img src="{{ $item->thumbnailItem->preview_url }}" 
                         alt="{{ $item->judul }}" 
                         class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Category and item count badges -->
                    <div class="absolute top-3 left-3 flex flex-col gap-2">
                        <span class="bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-lg">
                            {{ ucfirst($item->kategori) }}
                        </span>
                        <span class="bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-lg">
                            {{ $item->jumlah_item }} item
                        </span>
                    </div>
                    
                    <!-- View button overlay -->
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('galeri.show', $item->id) }}" 
                           class="bg-white text-gray-900 px-6 py-3 rounded-xl font-semibold shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-green-50">
                            <i class="fas fa-eye mr-2"></i>
                            Lihat Galeri
                        </a>
                    </div>
                </div>
                
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 mb-2 hover:text-green-600 transition-colors duration-200 line-clamp-2 text-lg">
                        <a href="{{ route('galeri.show', $item->id) }}">{{ $item->judul }}</a>
                    </h3>
                    
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 leading-relaxed">{{ Str::limit(strip_tags($item->deskripsi), 80) }}</p>
                    
                    <div class="flex items-center justify-between text-xs text-gray-500 border-t border-gray-100 pt-3">
                        <div class="flex items-center">
                            <i class="fas fa-calendar mr-1"></i>
                            <span>{{ $item->created_at->format('d-m-Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-images mr-1"></i>
                            <span>{{ $item->jumlah_item }} item</span>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($galeri->hasPages())
        <div class="mt-12 flex justify-center">
            <nav class="flex items-center space-x-2">
                @if($galeri->onFirstPage())
                    <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $galeri->previousPageUrl() }}" class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif

                @foreach($galeri->getUrlRange(1, $galeri->lastPage()) as $page => $url)
                    @if($page == $galeri->currentPage())
                        <span class="px-3 py-2 bg-blue-600 text-white rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">{{ $page }}</a>
                    @endif
                @endforeach

                @if($galeri->hasMorePages())
                    <a href="{{ $galeri->nextPageUrl() }}" class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                @endif
            </nav>
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.aspect-w-4 {
    position: relative;
    padding-bottom: 75%; /* 3/4 = 0.75 */
}

.aspect-w-4 > * {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}
</style>
@endpush
