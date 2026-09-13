@extends('layouts.frontend')

@section('title', $berita->judul . ' - ' . $schoolName)

@push('meta')
<meta name="description" content="{{ Str::limit(strip_tags($berita->konten), 160) }}">
<meta name="keywords" content="{{ $berita->kategori && $berita->kategori->count() > 0 ? $berita->kategori->first()->nama : 'berita' }}, {{ $schoolName }}, {{ $berita->judul }}">
<meta name="author" content="{{ $berita->user->name ?? $schoolName }}">
<meta name="robots" content="index, follow">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="article">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $berita->judul }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($berita->konten), 160) }}">
<meta property="og:image" content="{{ $berita->gambar_utama ? asset('storage/' . $berita->gambar_utama) : asset('images/og-image.jpg') }}">
<meta property="og:site_name" content="{{ $schoolName }}">
<meta property="article:published_time" content="{{ $berita->published_at->toISOString() }}">
<meta property="article:author" content="{{ $berita->user->name ?? $schoolName }}">

<!-- X (formerly Twitter) -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $berita->judul }}">
<meta property="twitter:description" content="{{ Str::limit(strip_tags($berita->konten), 160) }}">
<meta property="twitter:image" content="{{ $berita->gambar_utama ? asset('storage/' . $berita->gambar_utama) : asset('images/og-image.jpg') }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ url()->current() }}">
@endpush

@section('content')
<!-- Modern Hero Section with Gradient -->
<div class="relative py-16 overflow-hidden" style="background: linear-gradient(135deg, #006600 0%, #008000 50%, #004d00 100%);">
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
    
    <!-- Floating Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-white/10 rounded-full blur-xl animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-32 h-32 bg-white/5 rounded-full blur-2xl animate-pulse delay-1000"></div>
    <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-white/10 rounded-full blur-lg animate-pulse delay-500"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-white hover:text-green-200 transition-colors duration-200">
                        <i class="fas fa-home mr-2"></i>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-white/80 mx-2"></i>
                        <a href="{{ route('berita') }}" class="ml-1 text-sm font-medium text-white hover:text-green-200 transition-colors duration-200 md:ml-2">Berita</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-white/80 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-white/90 md:ml-2">{{ Str::limit($berita->judul, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <!-- Article Preview -->
        <div class="text-center">
            @if($berita->kategori && $berita->kategori->count() > 0)
            <div class="category-tag inline-flex items-center px-6 py-3 bg-white rounded-full text-gray-800 text-sm font-bold mb-6 shadow-xl border-2 border-white/20 backdrop-blur-sm">
                <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                <span class="text-gray-800 font-semibold">{{ $berita->kategori->first()->nama }}</span>
            </div>
            @endif
            
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight">
                {{ $berita->judul }}
            </h1>
            
            <div class="flex flex-wrap items-center justify-center text-white text-sm space-x-6">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-white/30 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-user text-xs text-white"></i>
                    </div>
                    <span class="text-white font-medium">{{ $berita->user->name ?? 'Admin' }}</span>
                </div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-white/30 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-calendar text-xs text-white"></i>
                    </div>
                    <span class="text-white font-medium">{{ $berita->published_at->format('d-m-Y') }}</span>
                </div>
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-white/30 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-eye text-xs text-white"></i>
                    </div>
                    <span class="text-white font-medium">{{ number_format($berita->view_count) }} kali dilihat</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 min-h-screen" style="background-color: #f0fff0;">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <article class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300 animate-fadeInUp">
                <!-- Featured Image with Modern Overlay -->
                @if($berita->gambar_utama)
                <div class="relative group">
                    <img src="{{ asset('storage/' . $berita->gambar_utama) }}" 
                         alt="{{ $berita->judul }}" 
                         class="w-full h-80 sm:h-96 lg:h-[28rem] object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center bg-white/90 backdrop-blur-sm rounded-full px-3 py-1 shadow-lg">
                                <i class="fas fa-clock mr-2 text-xs text-gray-600"></i>
                                <span class="text-sm font-medium text-gray-800">{{ $berita->published_at->format('H:i') }} WIB</span>
                            </div>
                            <div class="flex items-center bg-white/90 backdrop-blur-sm rounded-full px-3 py-1 shadow-lg">
                                <i class="fas fa-eye mr-2 text-xs text-gray-600"></i>
                                <span class="text-sm font-medium text-gray-800">{{ number_format($berita->view_count) }} views</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif


                <!-- Article Content -->
                <div class="p-8">

                    <!-- Main Content -->
                    <div class="prose prose-lg max-w-none prose-headings:text-gray-900 prose-p:text-gray-700 prose-p:leading-relaxed prose-a:text-green-600 prose-a:no-underline hover:prose-a:underline prose-strong:text-gray-900 prose-blockquote:border-l-green-500 prose-blockquote:bg-green-50 prose-blockquote:py-4 prose-blockquote:px-6 prose-blockquote:rounded-r-lg">
                        {!! $berita->konten !!}
                    </div>

                    <!-- Tags -->
                    @if($berita->tags)
                    <div class="mt-8 pt-6 border-t">
                        <h3 class="text-sm font-medium text-gray-900 mb-3">Tag:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $berita->tags) as $tag)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                #{{ trim($tag) }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Share Buttons -->
                <div class="px-4 sm:px-8 py-6 bg-gradient-to-r from-gray-50 to-green-50 border-t border-gray-100">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                        <div class="text-center lg:text-left">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">Bagikan artikel ini</h3>
                            <p class="text-sm text-gray-600">Bantu sebarkan informasi bermanfaat ini</p>
                        </div>
                        <div class="share-buttons flex flex-col sm:flex-row gap-3 justify-center lg:justify-end">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                               target="_blank" 
                               class="group inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                <i class="fab fa-facebook-f mr-2 text-white"></i>
                                <span class="font-medium text-white">Facebook</span>
                            </a>
                            <a href="https://x.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul) }}" 
                               target="_blank" 
                               class="group inline-flex items-center justify-center px-4 py-2 bg-black hover:bg-gray-800 text-white rounded-xl transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                <i class="fab fa-x-twitter mr-2 text-white"></i>
                                <span class="font-medium text-white">X (Twitter)</span>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . url()->current()) }}" 
                               target="_blank" 
                               class="group inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl transition-all duration-200 hover:scale-105 hover:shadow-lg">
                                <i class="fab fa-whatsapp mr-2 text-white"></i>
                                <span class="font-medium text-white">WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Comments Section -->
            <div class="mt-8 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                    <h3 class="text-2xl font-bold text-white flex items-center">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-comments text-white"></i>
                        </div>
                        Komentar ({{ $berita->comments->count() }})
                    </h3>
                    <p class="text-green-100 mt-2">Bagikan pendapat Anda tentang artikel ini</p>
                </div>
                
                <div class="p-8">

                <!-- Comment Form -->
                <div class="bg-gradient-to-br from-gray-50 to-green-50 rounded-xl p-6 mb-8 border border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-edit text-white text-sm"></i>
                        </div>
                        Tulis Komentar
                    </h4>
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="berita_id" value="{{ $berita->id }}">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama *</label>
                                <input type="text" 
                                       id="nama" 
                                       name="nama" 
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 hover:border-gray-400">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 hover:border-gray-400">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="komentar" class="block text-sm font-medium text-gray-700 mb-2">Komentar *</label>
                            <textarea id="komentar" 
                                      name="komentar" 
                                      rows="4" 
                                      required
                                      placeholder="Tulis komentar Anda di sini..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 hover:border-gray-400 resize-none"></textarea>
                        </div>
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-medium rounded-xl transition-all duration-200 hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Komentar
                        </button>
                    </form>
                </div>

                <!-- Comments List -->
                <div id="comments-list">
                    @forelse($berita->comments->where('status', 'approved') as $comment)
                    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-4 hover:shadow-md transition-all duration-200">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-700 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr($comment->nama, 0, 1) }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $comment->nama }}</h4>
                                    <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">{{ $comment->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <p class="text-gray-700 leading-relaxed">{{ $comment->komentar }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-comment-slash text-2xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada komentar</h3>
                        <p class="text-gray-500">Jadilah yang pertama memberikan komentar untuk artikel ini.</p>
                    </div>
                    @endforelse
                </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 animate-slideInRight">
            <!-- Related News -->
            @if($beritaTerbaru->count() > 0)
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-newspaper text-white"></i>
                        </div>
                        Berita Terkait
                    </h3>
                </div>
                <div class="p-6">
                <div class="space-y-4">
                    @foreach($beritaTerbaru as $related)
                    <div class="group bg-gray-50 hover:bg-green-50 rounded-xl p-4 transition-all duration-200 hover:shadow-md border border-transparent hover:border-green-200">
                        <div class="flex space-x-3">
                            @if($related->gambar_utama)
                            <div class="flex-shrink-0">
                                <img src="{{ asset('storage/' . $related->gambar_utama) }}" 
                                     alt="{{ $related->judul }}" 
                                     class="w-16 h-16 object-cover rounded-lg group-hover:scale-105 transition-transform duration-200">
                            </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('berita.show', $related->slug) }}" 
                                   class="text-sm font-semibold text-gray-900 hover:text-green-600 line-clamp-2 transition-colors duration-200">
                                    {{ $related->judul }}
                                </a>
                                <div class="flex items-center mt-2 text-xs text-gray-500">
                                    <i class="fas fa-calendar mr-1"></i>
                                    <span>{{ $related->published_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                </div>
            </div>
            @endif

            <!-- Popular Categories -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 px-6 py-4">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-tags text-white"></i>
                        </div>
                        Kategori Populer
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @if($kategorisPopuler->count() > 0)
                            @foreach($kategorisPopuler as $kategori)
                            <a href="{{ route('berita', ['kategori' => $kategori->nama]) }}" 
                               class="sidebar-category-item group flex items-center justify-between p-4 rounded-xl bg-gray-50 hover:bg-gradient-to-r hover:from-gray-50 hover:to-gray-100 transition-all duration-200 border border-gray-200 hover:border-gray-300 hover:shadow-lg">
                                <div class="flex items-center">
                                    <div class="w-4 h-4 rounded-full mr-3 shadow-sm" style="background-color: {{ $kategori->warna }};"></div>
                                    <span class="text-sm font-semibold text-gray-900 group-hover:text-gray-700 transition-colors duration-200">{{ $kategori->nama }}</span>
                                </div>
                                <span class="text-xs font-bold text-white px-3 py-1.5 rounded-full shadow-md" style="background-color: {{ $kategori->warna }};">
                                    {{ $kategori->berita_count }}
                                </span>
                            </a>
                            @endforeach
                        @else
                            <!-- Default categories if no data -->
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-tags text-2xl text-gray-400"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada kategori</h3>
                                <p class="text-gray-500">Kategori akan muncul setelah ada berita yang dipublikasikan.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Back to News -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-6 py-4">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-arrow-left text-white"></i>
                        </div>
                        Navigasi
                    </h3>
                </div>
                <div class="p-6">
                    <a href="{{ route('berita') }}" 
                       class="group inline-flex items-center justify-center w-full px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-arrow-left mr-3 group-hover:-translate-x-1 transition-transform duration-200"></i>
                        Kembali ke Daftar Berita
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
html, body {
    background-color: #f0fff0 !important; /* Light green background sesuai brand */
}

/* Modern Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-fadeInUp {
    animation: fadeInUp 0.6s ease-out;
}

.animate-slideInRight {
    animation: slideInRight 0.6s ease-out;
}

/* Enhanced Prose Styling */
.prose {
    color: #374151;
    line-height: 1.75;
    font-size: 1.1rem;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #111827;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose h1 {
    font-size: 2.25rem;
}

.prose h2 {
    font-size: 1.875rem;
}

.prose h3 {
    font-size: 1.5rem;
}

.prose p {
    margin-bottom: 1.25rem;
}

.prose ul, .prose ol {
    margin-bottom: 1.25rem;
    padding-left: 1.5rem;
}

.prose li {
    margin-bottom: 0.5rem;
}

.prose blockquote {
    border-left: 4px solid #3b82f6;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #6b7280;
}

.prose img {
    border-radius: 0.5rem;
    margin: 1.5rem 0;
}

.prose a {
    color: #3b82f6;
    text-decoration: underline;
}

.prose a:hover {
    color: #1d4ed8;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Category Tag Styling */
.category-tag {
    position: relative;
    z-index: 10;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.category-tag::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    background: linear-gradient(45deg, rgba(255,255,255,0.3), rgba(255,255,255,0.1));
    border-radius: 50px;
    z-index: -1;
}

/* Sidebar Category Items */
.sidebar-category-item {
    position: relative;
    overflow: hidden;
}

.sidebar-category-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.sidebar-category-item:hover::before {
    left: 100%;
}

@media (max-width: 1024px) {
    .prose {
        font-size: 1.05rem;
        line-height: 1.75;
    }

    .px-8 {
        padding-left: 2rem;
        padding-right: 2rem;
    }

    .py-8 {
        padding-top: 2.5rem;
        padding-bottom: 2.5rem;
    }
}

@media (max-width: 640px) {
    .category-tag {
        padding: 0.5rem 1.25rem;
        font-size: 0.75rem;
    }

    .category-tag span {
        font-size: 0.8rem;
    }

    .prose {
        font-size: 0.98rem;
        line-height: 1.7;
    }

    .prose h1 {
        font-size: 1.7rem;
    }

    .prose h2 {
        font-size: 1.45rem;
    }

    .prose h3 {
        font-size: 1.25rem;
    }

    .prose p,
    .prose li {
        font-size: 0.98rem;
    }

    .prose blockquote {
        font-size: 0.9rem;
        padding: 0.9rem 1rem;
    }

    .px-8 {
        padding-left: 1.25rem;
        padding-right: 1.25rem;
    }

    .py-8 {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .share-buttons,
    .share-buttons a {
        width: 100%;
    }

    .share-buttons {
        flex-direction: column;
        gap: 0.75rem;
    }

    .share-buttons a {
        justify-content: center;
    }

    .bg-white.rounded-2xl.shadow-xl.border.border-gray-100.overflow-hidden.mb-8 .p-6 {
        padding: 1.5rem;
    }

    .grid.grid-cols-1.lg\:grid-cols-3.gap-8 {
        gap: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const commentForm = document.querySelector('form[action="{{ route('comments.store') }}"]');
    const submitButton = commentForm.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;

    commentForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Disable submit button and show loading
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
        
        // Clear previous alerts
        const existingAlerts = document.querySelectorAll('.comment-alert');
        existingAlerts.forEach(alert => alert.remove());
        
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                showAlert('success', data.message);
                
                // Reset form
                commentForm.reset();
                
                // Optionally reload comments section
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                // Show error message
                showAlert('error', data.message || 'Terjadi kesalahan saat mengirim komentar');
                
                // Show validation errors if any
                if (data.errors) {
                    let errorMsg = '';
                    Object.values(data.errors).forEach(error => {
                        errorMsg += error.join(' ') + '\n';
                    });
                    showAlert('error', errorMsg);
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'Terjadi kesalahan saat mengirim komentar. Silakan coba lagi.');
        })
        .finally(() => {
            // Re-enable submit button
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
        });
    });
    
    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `comment-alert mb-4 p-4 rounded-xl ${type === 'success' ? 'bg-green-100 border border-green-200 text-green-800' : 'bg-red-100 border border-red-200 text-red-800'}`;
        
        alertDiv.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle text-green-500' : 'fa-exclamation-triangle text-red-500'} mr-3"></i>
                <div class="flex-1">
                    <p class="font-medium">${message}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        commentForm.parentNode.insertBefore(alertDiv, commentForm);
    }
});
</script>
@endpush
