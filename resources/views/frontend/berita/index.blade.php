@extends('layouts.frontend')

@section('title', 'Berita & Artikel - ' . $schoolName)

@push('meta')
<meta name="description" content="Dapatkan informasi terbaru seputar kegiatan, prestasi, dan perkembangan {{ $schoolName }}. Baca artikel dan berita terkini dari sekolah kami.">
<meta name="keywords" content="berita {{ $schoolName }}, artikel sekolah, kegiatan madrasah, prestasi siswa, perkembangan pendidikan">
<meta name="author" content="{{ $schoolName }}">
<meta name="robots" content="index, follow">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="Berita & Artikel - {{ $schoolName }}">
<meta property="og:description" content="Dapatkan informasi terbaru seputar kegiatan, prestasi, dan perkembangan {{ $schoolName }}.">
<meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
<meta property="og:site_name" content="{{ $schoolName }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="Berita & Artikel - {{ $schoolName }}">
<meta property="twitter:description" content="Dapatkan informasi terbaru seputar kegiatan, prestasi, dan perkembangan {{ $schoolName }}.">
<meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ url()->current() }}">
@endpush

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-green-600 via-green-700 to-green-800 py-24 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                    <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#grid)" />
        </svg>
    </div>
    
    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <!-- Badge -->
            <div class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm font-semibold mb-8 shadow-lg">
                <i class="fas fa-newspaper mr-2"></i>
                {{ isset($berita) ? $berita->total() : 0 }} Artikel Tersedia
            </div>
            
            <!-- Main Title -->
            <h1 class="text-5xl lg:text-7xl font-black mb-6 text-white leading-tight tracking-tight hero-title">
                Berita & Artikel
            </h1>
            
            <!-- Subtitle -->
            <p class="text-xl lg:text-2xl text-green-100 max-w-4xl mx-auto leading-relaxed mb-12 hero-subtitle">
                Ikuti perkembangan terkini, prestasi membanggakan, dan kegiatan inspiratif dari {{ $schoolName }}
            </p>
            
        </div>
    </div>
</div>

<!-- Breadcrumb -->
<nav class="bg-white border-b border-gray-100" aria-label="Breadcrumb">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <ol class="flex items-center space-x-3 text-sm">
            <li>
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-green-600 transition-colors duration-200 flex items-center">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
            </li>
            <li>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            </li>
            <li>
                <span class="text-gray-900 font-semibold">Berita & Artikel</span>
            </li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<div class="min-h-screen bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Filter Section -->
        <div class="mb-12">
            <!-- Mobile Filter Toggle Button -->
            <button onclick="toggleFilterSection()" 
                    class="lg:hidden w-full mb-4 bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-4 rounded-2xl font-bold hover:from-green-700 hover:to-green-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-between">
                <span class="flex items-center">
                    <i class="fas fa-filter mr-3"></i>
                    <span>Filter & Pencarian</span>
                    @if(request('search') || request('kategori') || request('sort'))
                        <span class="ml-3 px-2 py-1 bg-white/30 rounded-full text-xs font-semibold">
                            Aktif
                        </span>
                    @endif
                </span>
                <i id="filterToggleIcon" class="fas fa-chevron-down transition-transform duration-300"></i>
            </button>
            
            <div id="filterSection" class="bg-white rounded-3xl shadow-xl border border-gray-100 p-4 sm:p-6 lg:p-8 filter-section hidden lg:block">
                <div class="space-y-6">
                    
                    <!-- Active Filters -->
                    <div class="flex flex-wrap items-center gap-3 active-filters">
                        <span class="text-sm font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-filter mr-2 text-green-500"></i>
                            Filter Aktif:
                        </span>
                        
                        @if(request('search'))
                            <span class="inline-flex items-center px-3 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium filter-tag">
                                <i class="fas fa-search mr-2"></i>
                                <span class="hidden sm:inline">"{{ request('search') }}"</span>
                                <span class="sm:hidden">{{ Str::limit(request('search'), 15) }}</span>
                                <a href="{{ route('berita', array_filter(request()->except('search'))) }}" 
                                   class="ml-2 text-green-600 hover:text-green-800 transition-colors duration-200">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                        
                        @if(request('kategori'))
                            <span class="inline-flex items-center px-3 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium filter-tag">
                                <i class="fas fa-tag mr-2"></i>
                                <span class="hidden sm:inline">{{ request('kategori') }}</span>
                                <span class="sm:hidden">{{ Str::limit(request('kategori'), 10) }}</span>
                                <a href="{{ route('berita', array_filter(request()->except('kategori'))) }}" 
                                   class="ml-2 text-green-600 hover:text-green-800 transition-colors duration-200">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                        
                        @if(!request('search') && !request('kategori'))
                            <span class="text-gray-500 text-sm">Tidak ada filter aktif</span>
                        @endif
                    </div>
                    
                    <!-- Filter Controls -->
                    <div class="space-y-4 filter-controls">
                        <!-- Search Bar -->
                        <div class="w-full search-bar">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                <i class="fas fa-search mr-2 text-green-500"></i>Cari:
                            </label>
                            <form method="GET" action="{{ route('berita') }}" class="w-full">
                                @if(request('kategori'))
                                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                @endif
                                @if(request('sort'))
                                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                                @endif
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <input type="text" 
                                           name="search"
                                           value="{{ request('search') }}"
                                           placeholder="Cari berita, artikel, atau topik yang menarik..." 
                                           class="w-full pl-10 pr-4 py-3 text-gray-900 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 shadow-sm hover:shadow-md text-base"
                                           autocomplete="off">
                                </div>
                            </form>
                        </div>
                        
                        <!-- Category and Sort Filters -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 category-sort-grid">
                            <!-- Category Filter -->
                            <div class="w-full">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    <i class="fas fa-tag mr-2 text-green-500"></i>Kategori:
                                </label>
                                <form method="GET" action="{{ route('berita') }}" class="w-full">
                                    @if(request('search'))
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif
                                    @if(request('sort'))
                                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                                    @endif
                                    <select name="kategori" 
                                            onchange="this.form.submit()" 
                                            class="w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 bg-white text-gray-900 shadow-sm hover:shadow-md text-base">
                                        <option value="">Semua Kategori</option>
                                        @if(isset($kategoris))
                                            @foreach($kategoris as $kategori)
                                                <option value="{{ $kategori->nama }}" {{ request('kategori') == $kategori->nama ? 'selected' : '' }}>
                                                    {{ $kategori->nama }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </form>
                            </div>
                            
                            <!-- Sort Filter -->
                            <div class="w-full">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    <i class="fas fa-sort mr-2 text-purple-500"></i>Urutkan:
                                </label>
                                <form method="GET" action="{{ route('berita') }}" class="w-full">
                                    @if(request('search'))
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    @endif
                                    @if(request('kategori'))
                                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                                    @endif
                                    <select name="sort" 
                                            onchange="this.form.submit()" 
                                            class="w-full px-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300 bg-white text-gray-900 shadow-sm hover:shadow-md text-base">
                                        <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Article -->
        @if(isset($berita) && $berita->isNotEmpty())
            @php $featuredNews = $berita->first(); @endphp
            <div class="mb-16">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-4xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-star text-yellow-500 mr-4 text-3xl"></i>
                        Berita Utama
                    </h2>
                    <div class="text-sm text-gray-500 flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        Diperbarui {{ $featuredNews->updated_at->diffForHumans() }}
                    </div>
                </div>
                
                <article class="bg-white rounded-3xl shadow-news overflow-hidden group hover:shadow-3xl transition-all duration-500 border border-gray-100 hover:border-green-200 transform hover:-translate-y-1 glow-on-hover featured-article">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                        <!-- Image Section -->
                        <div class="relative overflow-hidden h-80 lg:h-auto featured-image">
                            <img src="{{ $featuredNews->gambar_url ?? asset('images/default-news.jpg') }}" 
                                 alt="{{ $featuredNews->judul }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent group-hover:from-black/60 transition-all duration-500"></div>
                            
                            <!-- Category Badge -->
                            <div class="absolute top-6 left-6">
                                @if($featuredNews->hasKategori())
                                    <span class="bg-gradient-to-r from-green-600 to-green-700 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg backdrop-blur-sm hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105">
                                        <i class="fas fa-tag mr-1"></i>{{ $featuredNews->kategori_display }}
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Featured Badge -->
                            <div class="absolute top-6 right-6">
                                <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg backdrop-blur-sm pulse-glow">
                                    <i class="fas fa-star mr-1"></i>Utama
                                </span>
                            </div>
                            
                            <!-- Meta Info Overlay -->
                            <div class="absolute bottom-6 left-6 right-6">
                                <div class="flex items-center text-white text-sm font-medium space-x-3">
                                    <div class="flex items-center bg-black/40 backdrop-blur-sm rounded-full px-4 py-2 hover:bg-black/50 transition-all duration-300">
                                        <i class="fas fa-calendar-alt mr-2"></i>
                                        {{ $featuredNews->published_at ? $featuredNews->published_at->format('d-m-Y') : $featuredNews->created_at->format('d-m-Y') }}
                                    </div>
                                    <div class="flex items-center bg-black/40 backdrop-blur-sm rounded-full px-4 py-2 hover:bg-black/50 transition-all duration-300">
                                        <i class="fas fa-eye mr-2"></i>
                                        {{ number_format($featuredNews->view_count ?? 0) }}
                                    </div>
                                    <div class="flex items-center bg-black/40 backdrop-blur-sm rounded-full px-4 py-2 hover:bg-black/50 transition-all duration-300">
                                        <i class="fas fa-user mr-2"></i>
                                        {{ $featuredNews->user->name ?? 'Admin' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Content Section -->
                        <div class="p-8 lg:p-12 flex flex-col justify-center bg-gradient-to-br from-gray-50 to-white">
                            <div class="mb-4 flex items-center gap-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    <i class="fas fa-newspaper mr-1"></i>Berita Terbaru
                                </span>
                                @if($featuredNews->hasKategori())
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-tag mr-1"></i>{{ $featuredNews->kategori_display }}
                                    </span>
                                @endif
                            </div>
                            
                            <h3 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6 group-hover:text-green-600 transition-colors duration-300 leading-tight">
                                <a href="{{ route('berita.show', $featuredNews->slug) }}" class="hover:text-green-600 transition-colors duration-300 block">
                                    {{ $featuredNews->judul }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 leading-relaxed mb-8 text-lg line-clamp-3">
                                {{ $featuredNews->excerpt ?? Str::limit(strip_tags($featuredNews->konten), 200) }}
                            </p>
                            
                            <div class="flex items-center text-sm text-gray-500 mb-8 space-x-6">
                                <div class="flex items-center bg-gray-100 rounded-full px-4 py-2 hover:bg-gray-200 transition-colors duration-300">
                                    <i class="fas fa-clock mr-2 text-green-500"></i>
                                    <span class="font-medium">{{ $featuredNews->reading_time ?? 5 }} menit baca</span>
                                </div>
                                <div class="flex items-center bg-gray-100 rounded-full px-4 py-2 hover:bg-gray-200 transition-colors duration-300">
                                    <i class="fas fa-comments mr-2 text-yellow-500"></i>
                                    <span class="font-medium">{{ $featuredNews->comments->count() ?? 0 }} komentar</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <a href="{{ route('berita.show', $featuredNews->slug) }}" 
                                   class="group/btn bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-4 rounded-2xl font-bold hover:from-green-700 hover:to-green-800 transition-all duration-300 inline-flex items-center shadow-lg hover:shadow-xl transform hover:scale-105">
                                    <i class="fas fa-book-open mr-2"></i>
                                    Baca Selengkapnya
                                    <i class="fas fa-arrow-right ml-3 group-hover/btn:translate-x-1 transition-transform duration-300"></i>
                                </a>
                                
                                <div class="flex items-center space-x-3">
                                    <button onclick="shareArticle('{{ route('berita.show', $featuredNews->slug) }}', '{{ $featuredNews->judul }}')" 
                                            class="w-12 h-12 bg-gradient-to-r from-green-100 to-green-200 hover:from-green-200 hover:to-green-300 rounded-full flex items-center justify-center transition-all duration-300 group/share transform hover:scale-110">
                                        <i class="fas fa-share text-green-600 group-hover/share:text-green-700"></i>
                                    </button>
                                    <button onclick="likeArticle({{ $featuredNews->id }})" 
                                            class="w-12 h-12 bg-gradient-to-r from-red-100 to-pink-100 hover:from-red-200 hover:to-pink-200 rounded-full flex items-center justify-center transition-all duration-300 group/like transform hover:scale-110">
                                        <i class="fas fa-heart text-red-600 group-hover/like:text-red-700"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        @endif

        <!-- Articles Grid -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 flex items-center">
                <i class="fas fa-newspaper text-green-500 mr-4"></i>
                Semua Berita
                <span class="ml-4 px-4 py-2 bg-green-100 text-green-800 rounded-full text-base font-semibold">
                    {{ isset($berita) ? $berita->total() : 0 }} artikel
                </span>
            </h2>
        </div>

        <!-- News Grid -->
        @if(isset($berita) && $berita->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12 news-grid">
                @foreach($berita->count() > 1 ? $berita->skip(1) : $berita as $news)
                    <article class="bg-white rounded-3xl shadow-news overflow-hidden group hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-green-200 transform hover:-translate-y-3 hover:scale-[1.02] glow-on-hover">
                        <!-- Image -->
                        <div class="relative overflow-hidden h-64">
                            <img src="{{ $news->gambar_url ?? asset('images/default-news.jpg') }}" 
                                 alt="{{ $news->judul }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent group-hover:from-black/50 transition-all duration-500"></div>
                            
                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4">
                                @if($news->hasKategori())
                                    <span class="bg-gradient-to-r from-green-600 to-green-700 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg backdrop-blur-sm hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105">
                                        <i class="fas fa-tag mr-1"></i>{{ $news->kategori_display }}
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Date & Views -->
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="flex items-center justify-between text-white text-xs space-x-2">
                                    <div class="flex items-center bg-black/40 backdrop-blur-sm rounded-full px-3 py-1 hover:bg-black/50 transition-all duration-300">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        {{ $news->published_at ? $news->published_at->format('d-m-Y') : $news->created_at->format('d-m-Y') }}
                                    </div>
                                    <div class="flex items-center bg-black/40 backdrop-blur-sm rounded-full px-3 py-1 hover:bg-black/50 transition-all duration-300">
                                        <i class="fas fa-eye mr-1"></i>
                                        {{ number_format($news->view_count ?? 0) }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-green-600/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6 bg-gradient-to-br from-white to-gray-50">
                            <div class="mb-3 flex items-center gap-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    <i class="fas fa-newspaper mr-1"></i>Artikel
                                </span>
                                @if($news->hasKategori())
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-tag mr-1"></i>{{ $news->kategori_display }}
                                    </span>
                                @endif
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors duration-300 line-clamp-2 leading-tight">
                                <a href="{{ route('berita.show', $news->slug) }}" class="hover:text-green-600 transition-colors duration-300 block">
                                    {{ $news->judul }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed text-sm">
                                {{ $news->short_excerpt ?? Str::limit(strip_tags($news->konten), 120) }}
                            </p>
                            
                            <div class="flex items-center text-xs text-gray-500 mb-6 space-x-4">
                                <div class="flex items-center bg-gray-100 rounded-full px-3 py-1 hover:bg-gray-200 transition-colors duration-300">
                                    <i class="fas fa-clock mr-1 text-green-500"></i>
                                    <span class="font-medium">{{ $news->reading_time ?? 3 }} menit</span>
                                </div>
                                <div class="flex items-center bg-gray-100 rounded-full px-3 py-1 hover:bg-gray-200 transition-colors duration-300">
                                    <i class="fas fa-user mr-1 text-yellow-500"></i>
                                    <span class="font-medium">{{ $news->user->name ?? 'Admin' }}</span>
                                </div>
                                <div class="flex items-center bg-gray-100 rounded-full px-3 py-1 hover:bg-gray-200 transition-colors duration-300">
                                    <i class="fas fa-comments mr-1 text-green-500"></i>
                                    <span class="font-medium">{{ $news->comments->count() ?? 0 }}</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <a href="{{ route('berita.show', $news->slug) }}" 
                                   class="group/btn bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-3 rounded-xl font-bold hover:from-green-700 hover:to-green-800 transition-all duration-300 inline-flex items-center shadow-lg hover:shadow-xl transform hover:scale-105 text-sm">
                                    <i class="fas fa-book-open mr-2"></i>
                                    Baca
                                    <i class="fas fa-arrow-right ml-2 text-xs group-hover/btn:translate-x-1 transition-transform duration-300"></i>
                                </a>
                                
                                <div class="flex items-center space-x-2">
                                    <button onclick="shareArticle('{{ route('berita.show', $news->slug) }}', '{{ $news->judul }}')" 
                                            class="w-10 h-10 bg-gradient-to-r from-green-100 to-green-200 hover:from-green-200 hover:to-green-300 rounded-full flex items-center justify-center transition-all duration-300 group/share transform hover:scale-110">
                                        <i class="fas fa-share text-green-600 group-hover/share:text-green-700 text-sm"></i>
                                    </button>
                                    <button onclick="likeArticle({{ $news->id }})" 
                                            class="w-10 h-10 bg-gradient-to-r from-red-100 to-pink-100 hover:from-red-200 hover:to-pink-200 rounded-full flex items-center justify-center transition-all duration-300 group/like transform hover:scale-110">
                                        <i class="fas fa-heart text-red-600 group-hover/like:text-red-700 text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="w-32 h-32 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center mx-auto mb-8">
                    <i class="fas fa-newspaper text-green-400 text-5xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Belum Ada Berita</h3>
                <p class="text-gray-600 mb-8 text-lg max-w-md mx-auto">
                    Belum ada berita yang tersedia saat ini. Berita terbaru akan segera hadir di sini.
                </p>
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center px-8 py-4 bg-green-600 text-white rounded-2xl hover:bg-green-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">
                    <i class="fas fa-home mr-3"></i>
                    Kembali ke Beranda
                </a>
            </div>
        @endif

        <!-- Pagination -->
        @if(isset($berita) && $berita->hasPages())
            <div class="mt-16 flex justify-center">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <nav class="flex items-center space-x-2 pagination" aria-label="Pagination">
                        {{-- Previous Page Link --}}
                        @if($berita->onFirstPage())
                            <span class="px-4 py-3 rounded-xl text-sm font-medium bg-gray-100 text-gray-400 cursor-not-allowed">
                                <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                            </span>
                        @else
                            <a href="{{ $berita->previousPageUrl() }}" 
                               class="px-4 py-3 rounded-xl text-sm font-medium bg-white border border-gray-300 text-gray-700 hover:bg-green-50 hover:border-green-200 hover:text-green-700 transition-all duration-300 shadow-sm hover:shadow-md">
                                <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                            </a>
                        @endif

                        {{-- Pagination Elements --}}
                        @php
                            $currentPage = $berita->currentPage();
                            $lastPage = $berita->lastPage();
                            $start = max(1, $currentPage - 2);
                            $end = min($lastPage, $currentPage + 2);
                        @endphp

                        @if($start > 1)
                            <a href="{{ $berita->url(1) }}" 
                               class="px-4 py-3 rounded-xl text-sm font-medium bg-white border border-gray-300 text-gray-700 hover:bg-green-50 hover:border-green-200 hover:text-green-700 transition-all duration-300 shadow-sm hover:shadow-md">1</a>
                            @if($start > 2)
                                <span class="px-4 py-3 text-gray-400">...</span>
                            @endif
                        @endif

                        @for($page = $start; $page <= $end; $page++)
                            @if($page == $currentPage)
                                <span class="px-4 py-3 rounded-xl text-sm font-medium bg-gradient-to-r from-green-600 to-green-700 text-white shadow-lg">{{ $page }}</span>
                            @else
                                <a href="{{ $berita->url($page) }}" 
                                   class="px-4 py-3 rounded-xl text-sm font-medium bg-white border border-gray-300 text-gray-700 hover:bg-green-50 hover:border-green-200 hover:text-green-700 transition-all duration-300 shadow-sm hover:shadow-md">{{ $page }}</a>
                            @endif
                        @endfor

                        @if($end < $lastPage)
                            @if($end < $lastPage - 1)
                                <span class="px-4 py-3 text-gray-400">...</span>
                            @endif
                            <a href="{{ $berita->url($lastPage) }}" 
                               class="px-4 py-3 rounded-xl text-sm font-medium bg-white border border-gray-300 text-gray-700 hover:bg-green-50 hover:border-green-200 hover:text-green-700 transition-all duration-300 shadow-sm hover:shadow-md">{{ $lastPage }}</a>
                        @endif

                        {{-- Next Page Link --}}
                        @if($berita->hasMorePages())
                            <a href="{{ $berita->nextPageUrl() }}" 
                               class="px-4 py-3 rounded-xl text-sm font-medium bg-white border border-gray-300 text-gray-700 hover:bg-green-50 hover:border-green-200 hover:text-green-700 transition-all duration-300 shadow-sm hover:shadow-md">
                                Selanjutnya<i class="fas fa-chevron-right ml-2"></i>
                            </a>
                        @else
                            <span class="px-4 py-3 rounded-xl text-sm font-medium bg-gray-100 text-gray-400 cursor-not-allowed">
                                Selanjutnya<i class="fas fa-chevron-right ml-2"></i>
                            </span>
                        @endif
                    </nav>
                    
                    <!-- Pagination Info -->
                    <div class="text-center mt-4 text-sm text-gray-600">
                        Menampilkan {{ $berita->firstItem() ?? 0 }} - {{ $berita->lastItem() ?? 0 }} dari {{ $berita->total() }} artikel
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Newsletter Section -->
<section class="relative bg-gradient-to-br from-green-600 via-green-700 to-green-800 py-24 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="newsletter-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <circle cx="10" cy="10" r="2" fill="white" opacity="0.3"/>
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#newsletter-grid)" />
        </svg>
    </div>
    
    <div class="relative max-w-5xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <!-- Badge -->
        <div class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm font-semibold mb-8 shadow-lg">
            <i class="fas fa-bell mr-2"></i>
            Newsletter
        </div>
        
        <!-- Title -->
        <h2 class="text-4xl lg:text-6xl font-black text-white mb-6 leading-tight">
            Jangan Lewatkan
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-300">
                Update Terbaru
            </span>
        </h2>
        
        <!-- Description -->
        <p class="text-xl text-green-100 mb-12 max-w-3xl mx-auto leading-relaxed">
            Berlangganan newsletter kami untuk mendapatkan berita terkini, pengumuman penting, dan update kegiatan sekolah langsung di email Anda
        </p>
        
        <!-- Newsletter Form -->
        <form class="flex flex-col sm:flex-row gap-4 max-w-2xl mx-auto mb-8" onsubmit="subscribeNewsletter(event)">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <input type="email" 
                       placeholder="Masukkan alamat email Anda" 
                       class="w-full pl-12 pr-4 py-4 text-gray-900 bg-white/95 backdrop-blur-sm rounded-2xl focus:outline-none focus:ring-4 focus:ring-white/30 text-lg border-0 transition-all duration-300"
                       required>
            </div>
            <button type="submit" 
                    class="bg-white text-green-600 px-8 py-4 rounded-2xl font-bold hover:bg-green-50 transition-all duration-300 whitespace-nowrap shadow-lg hover:shadow-xl transform hover:scale-105">
                <i class="fas fa-paper-plane mr-2"></i>
                Berlangganan Sekarang
            </button>
        </form>
        
        <!-- Privacy Notice -->
        <p class="text-green-100 text-sm flex items-center justify-center">
            <i class="fas fa-shield-alt mr-2"></i>
            Privasi Anda terjamin. Tidak ada spam, hanya berita penting yang relevan.
        </p>
    </div>
</section>

<style>
/* Line Clamp Utilities */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.5;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.5;
}

/* Enhanced Shadows */
.shadow-3xl {
    box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
}

/* Smooth Transitions */
* {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Focus States for Accessibility */
button:focus,
input:focus,
select:focus,
a:focus {
    outline: 2px solid #008000;
    outline-offset: 2px;
}

/* Mobile Optimizations */
@media (max-width: 640px) {
    .grid {
        gap: 1rem;
    }
    
    button, a, input, select {
        min-height: 44px;
        min-width: 44px;
    }
    
    .line-clamp-2, .line-clamp-3 {
        line-height: 1.6;
    }
    
    /* Filter section mobile improvements */
    .filter-section {
        padding: 1rem;
        margin-top: 0.5rem;
    }
    
    .filter-controls {
        flex-direction: column;
        gap: 1rem;
    }
    
    .search-bar {
        width: 100%;
    }
    
    .search-bar label {
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
    
    .category-sort-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .category-sort-grid label {
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
    
    /* Active filters mobile */
    .active-filters {
        flex-wrap: wrap;
        gap: 0.5rem;
        font-size: 0.875rem;
    }
    
    .active-filters > span:first-child {
        width: 100%;
        margin-bottom: 0.25rem;
    }
    
    .filter-tag {
        font-size: 0.75rem;
        padding: 0.375rem 0.625rem;
    }
    
    /* Compact form elements on mobile */
    input[name="search"],
    select[name="kategori"],
    select[name="sort"] {
        padding: 0.625rem 0.75rem;
        font-size: 0.875rem;
    }
    
    /* Form elements mobile */
    input, select {
        font-size: 16px; /* Prevents zoom on iOS */
        padding: 0.75rem;
    }
    
    /* Hero section mobile */
    .hero-title {
        font-size: 2.5rem;
        line-height: 1.2;
    }
    
    .hero-subtitle {
        font-size: 1.125rem;
        line-height: 1.5;
    }
    
    /* Card grid mobile */
    .news-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    /* Featured article mobile */
    .featured-article {
        flex-direction: column;
    }
    
    .featured-image {
        height: 200px;
    }
    
    /* Pagination mobile */
    .pagination {
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .pagination a, .pagination span {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
    }
}

/* Tablet optimizations */
@media (min-width: 641px) and (max-width: 1024px) {
    .category-sort-grid {
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    
    .news-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    
    .hero-title {
        font-size: 3.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.25rem;
    }
}

/* Loading Animation */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Hover Effects */
.hover-lift:hover {
    transform: translateY(-4px);
}

/* Background Gradient Animation */
@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

.bg-gradient-animated {
    background-size: 200% 200%;
    animation: gradient 15s ease infinite;
}

/* Enhanced Card Animations */
@keyframes cardFloat {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-5px);
    }
}

.card-float {
    animation: cardFloat 6s ease-in-out infinite;
}

/* Search Bar Styling */
input[name="search"] {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

input[name="search"]:focus {
    transform: translateY(-1px);
    box-shadow: 0 0 0 3px rgba(0, 128, 0, 0.1), 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

input[name="search"]:hover {
    box-shadow: 0 5px 15px -3px rgba(0, 0, 0, 0.1);
}

/* Glow Effect */
.glow-on-hover {
    position: relative;
    overflow: hidden;
}

.glow-on-hover::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.glow-on-hover:hover::before {
    left: 100%;
}

/* Enhanced Shadows */
.shadow-news {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.shadow-news:hover {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Pulse Animation for Featured Badge */
@keyframes pulse-glow {
    0%, 100% {
        box-shadow: 0 0 5px rgba(251, 191, 36, 0.5);
    }
    50% {
        box-shadow: 0 0 20px rgba(251, 191, 36, 0.8), 0 0 30px rgba(251, 191, 36, 0.6);
    }
}

.pulse-glow {
    animation: pulse-glow 2s ease-in-out infinite;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize page functionality
    initializeAnimations();
    initializeInteractions();
});

// Initialize animations on scroll
function initializeAnimations() {
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
            }
        });
    }, observerOptions);
    
    // Observe articles
    document.querySelectorAll('article').forEach(article => {
        observer.observe(article);
    });
}

// Initialize user interactions
function initializeInteractions() {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Share article function
function shareArticle(url, title) {
    if (navigator.share) {
        navigator.share({
            title: title,
            url: url
        }).catch(console.error);
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(url).then(() => {
            showNotification('Link berhasil disalin ke clipboard!', 'success');
        }).catch(() => {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = url;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            showNotification('Link berhasil disalin!', 'success');
        });
    }
}

// Like article function
function likeArticle(id) {
    // Here you would typically make an AJAX call to save the like
    console.log('Liked article:', id);
    showNotification('Terima kasih! Artikel telah Anda sukai.', 'success');
}

// Newsletter subscription
function subscribeNewsletter(event) {
    event.preventDefault();
    const email = event.target.querySelector('input[type="email"]').value;
    
    if (email) {
        // Here you would typically make an AJAX call to save the subscription
        console.log('Newsletter subscription:', email);
        showNotification('Terima kasih! Anda telah berlangganan newsletter kami.', 'success');
        event.target.reset();
    }
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-xl shadow-lg text-white transform transition-all duration-300 translate-x-full max-w-sm`;
    
    const bgColor = {
        'success': 'bg-green-500',
        'error': 'bg-red-500',
        'warning': 'bg-yellow-500',
        'info': 'bg-blue-500'
    }[type] || 'bg-blue-500';
    
    const icon = {
        'success': 'fa-check-circle',
        'error': 'fa-times-circle',
        'warning': 'fa-exclamation-triangle',
        'info': 'fa-info-circle'
    }[type] || 'fa-info-circle';
    
    notification.classList.add(bgColor);
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas ${icon} mr-3 text-xl"></i>
            <span class="font-medium">${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Auto remove
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentNode) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 4000);
}

// Toggle filter section for mobile
function toggleFilterSection() {
    const filterSection = document.getElementById('filterSection');
    const toggleIcon = document.getElementById('filterToggleIcon');
    
    if (filterSection) {
        // Toggle hidden class, but respect lg:block for desktop
        if (filterSection.classList.contains('hidden')) {
            filterSection.classList.remove('hidden');
            if (toggleIcon) {
                toggleIcon.classList.remove('fa-chevron-down');
                toggleIcon.classList.add('fa-chevron-up');
            }
        } else {
            // Only add hidden on mobile (screen width < 1024px)
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

// Search functionality enhancement
document.addEventListener('DOMContentLoaded', function() {
    // Handle window resize to maintain proper state
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const filterSection = document.getElementById('filterSection');
            if (window.innerWidth >= 1024) {
                // Desktop: always show
                filterSection.classList.remove('hidden');
            } else {
                // Mobile: always hidden by default (user must click toggle to show)
                // Don't auto-hide if user has manually opened it
            }
        }, 250);
    });
    
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        // Debounced search function
        let searchTimeout;
        
        // Handle search input with debouncing
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                // Auto-submit form after 1 second of no typing
                if (this.value.length > 2 || this.value.length === 0) {
                    this.form.submit();
                }
            }, 1000);
        });
        
        // Handle form submission on Enter
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                clearTimeout(searchTimeout);
                this.form.submit();
            }
        });
        
        // Auto-focus search input when page loads if there's a search term
        if (searchInput.value) {
            searchInput.focus();
        }
    }
});

// Back to top functionality
window.addEventListener('scroll', function() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    // Removed parallax effect that was causing navbar movement
    // The hero section will now stay fixed in position
});

// Performance optimization: Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Lazy loading for images
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                img.classList.remove('animate-pulse');
                observer.unobserve(img);
            }
        });
    });
    
    document.querySelectorAll('img').forEach(img => {
        img.classList.add('animate-pulse');
        imageObserver.observe(img);
    });
}
</script>
@endsection
