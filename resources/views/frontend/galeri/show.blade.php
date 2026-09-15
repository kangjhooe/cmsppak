@extends('layouts.frontend')

@section('title', $galeri->judul . ' - ' . $schoolName)

@section('content')
<div class="bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('galeri') }}" class="text-gray-700 hover:text-blue-600 ml-1 md:ml-2">
                            Galeri
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500 ml-1 md:ml-2">{{ Str::limit($galeri->judul, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Galeri Header -->
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <header class="text-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $galeri->judul }}</h1>
                
                <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-gray-500">
                    @if($galeri->kategori)
                    <div class="flex items-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ ucfirst($galeri->kategori) }}
                        </span>
                    </div>
                    @endif
                    
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ $galeri->created_at->format('d-m-Y') }}</span>
                    </div>
                    
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ $galeri->jumlah_item }} item</span>
                    </div>
                </div>
            </header>

            <!-- Deskripsi Galeri -->
            @if($galeri->deskripsi)
            <div class="prose prose-lg max-w-none text-gray-700 text-center">
                <p class="text-lg leading-relaxed">{{ $galeri->deskripsi }}</p>
            </div>
            @endif
        </div>

        <!-- Media Grid -->
        @if($galeri->activeItems->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @php $fotoIndex = 0; @endphp
            @foreach($galeri->activeItems as $item)
            <article class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                @if($item->jenis == 'youtube' && $item->youtube_embed_url)
                    <div class="relative overflow-hidden bg-black">
                        <div class="aspect-video w-full">
                            <iframe
                                src="{{ $item->youtube_embed_url }}"
                                title="{{ $item->judul }}"
                                class="w-full h-full"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen
                                loading="lazy"
                                referrerpolicy="strict-origin-when-cross-origin"></iframe>
                        </div>
                        <div class="absolute top-3 right-3 pointer-events-none">
                            <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                YOUTUBE
                            </span>
                        </div>
                    </div>
                @elseif($item->jenis == 'video')
                    <!-- Video Item -->
                    <div class="relative overflow-hidden">
                        @if($item->preview_url)
                        <img src="{{ $item->preview_url }}" 
                            alt="{{ $item->judul }}" 
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                        <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-full p-4 shadow-lg transform scale-100 group-hover:scale-110 transition-all duration-300">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="absolute top-3 right-3">
                            <span class="bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                VIDEO
                            </span>
                        </div>
                    </div>
                @else
                    <!-- Foto Item -->
                    <div class="relative overflow-hidden cursor-pointer" onclick="openLightbox({{ $fotoIndex }}, 'foto')">
                        <img src="{{ $item->preview_url }}" 
                            alt="{{ $item->judul }}" 
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute top-3 right-3">
                            <span class="bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                FOTO
                            </span>
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="bg-white/90 rounded-full p-3 shadow-lg">
                                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif
                
                <div class="p-6 relative">
                    <!-- Decorative Element -->
                    <div class="absolute -top-2 left-6 w-12 h-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full"></div>
                    
                    <h3 class="font-bold text-gray-900 mb-3 line-clamp-2 text-lg group-hover:text-blue-600 transition-colors duration-300">
                        {{ $item->judul }}
                    </h3>
                    
                    @if($item->deskripsi)
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 leading-relaxed">{{ Str::limit($item->deskripsi, 80) }}</p>
                    @endif
                    
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 border border-purple-200">
                            {{ ucfirst($item->jenis) }}
                        </span>
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium">{{ $item->created_at->format('d-m-Y') }}</span>
                        </div>
                    </div>
                </div>
            </article>
            @if($item->jenis == 'foto')
                @php $fotoIndex++; @endphp
            @endif
            @endforeach
        </div>
        @else
        <div class="text-center py-16">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-images text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada media tersedia</h3>
            <p class="text-gray-500">Galeri ini belum memiliki foto atau video</p>
        </div>
        @endif

        <!-- Related Galeri -->
        @if($galeriLainnya->count() > 0)
        <div class="mt-16">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Galeri Lainnya</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($galeriLainnya as $item)
                <article class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                    @if($item->thumbnailItem && $item->thumbnailItem->preview_url)
                        <div class="relative overflow-hidden">
                            <img src="{{ $item->thumbnailItem->preview_url }}" 
                                alt="{{ $item->judul }}" 
                                class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <!-- Gallery Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
                                    GALERI
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif
                    
                    <div class="p-6 relative">
                        <!-- Decorative Element -->
                        <div class="absolute -top-2 left-6 w-12 h-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full"></div>
                        
                        <h3 class="font-bold text-gray-900 mb-3 line-clamp-2 text-lg group-hover:text-blue-600 transition-colors duration-300">
                            {{ $item->judul }}
                        </h3>
                        
                        @if($item->kategori)
                        <div class="mb-3">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 border border-blue-200">
                                <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                </svg>
                                {{ ucfirst($item->kategori) }}
                            </span>
                        </div>
                        @endif
                        
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium">{{ $item->jumlah_item }} item</span>
                            <span class="mx-2">•</span>
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium">{{ $item->created_at->format('d-m-Y') }}</span>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('galeri.show', $item->id) }}" 
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-full hover:from-blue-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                Lihat Detail
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightboxModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-7xl max-h-full w-full h-full flex items-center justify-center">
        <!-- Close Button -->
        <button onclick="closeLightbox()" class="absolute top-4 right-4 z-10 bg-white/20 hover:bg-white/30 text-white rounded-full p-3 transition-all duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <!-- Navigation Buttons -->
        <button id="prevBtn" onclick="changeImage(-1)" class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10 bg-white/20 hover:bg-white/30 text-white rounded-full p-3 transition-all duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        
        <button id="nextBtn" onclick="changeImage(1)" class="absolute right-4 top-1/2 transform -translate-y-1/2 z-10 bg-white/20 hover:bg-white/30 text-white rounded-full p-3 transition-all duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
        
        <!-- Image Container -->
        <div class="flex items-center justify-center w-full h-full">
            <img id="lightboxImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
        </div>
        
        <!-- Image Info -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black/50 text-white px-6 py-3 rounded-full">
            <h3 id="lightboxTitle" class="text-lg font-semibold"></h3>
            <p id="lightboxDescription" class="text-sm opacity-80"></p>
        </div>
        
        <!-- Image Counter -->
        <div class="absolute top-4 left-4 bg-black/50 text-white px-4 py-2 rounded-full">
            <span id="imageCounter">1 / 1</span>
        </div>
    </div>
</div>

<script>
// Data untuk lightbox
const lightboxData = {
    images: [],
    currentIndex: 0,
    isOpen: false
};

// Inisialisasi data gambar dari PHP
@foreach($galeri->activeItems as $item)
    @if($item->jenis == 'foto')
    lightboxData.images.push({
        src: "{{ asset('storage/' . $item->file_path) }}",
        title: "{{ $item->judul }}",
        description: "{{ $item->deskripsi ? Str::limit($item->deskripsi, 100) : '' }}"
    });
    @endif
@endforeach

function openLightbox(index, type) {
    if (type === 'foto' && lightboxData.images.length > 0) {
        lightboxData.currentIndex = index;
        lightboxData.isOpen = true;
        
        const modal = document.getElementById('lightboxModal');
        const image = document.getElementById('lightboxImage');
        const title = document.getElementById('lightboxTitle');
        const description = document.getElementById('lightboxDescription');
        const counter = document.getElementById('imageCounter');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
        // Tampilkan modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Update konten
        updateLightboxContent();
        
        // Tampilkan/sembunyikan tombol navigasi
        if (lightboxData.images.length > 1) {
            prevBtn.classList.remove('hidden');
            nextBtn.classList.remove('hidden');
        } else {
            prevBtn.classList.add('hidden');
            nextBtn.classList.add('hidden');
        }
    }
}

function closeLightbox() {
    const modal = document.getElementById('lightboxModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    lightboxData.isOpen = false;
}

function changeImage(direction) {
    if (lightboxData.images.length <= 1) return;
    
    lightboxData.currentIndex += direction;
    
    // Loop around
    if (lightboxData.currentIndex >= lightboxData.images.length) {
        lightboxData.currentIndex = 0;
    } else if (lightboxData.currentIndex < 0) {
        lightboxData.currentIndex = lightboxData.images.length - 1;
    }
    
    updateLightboxContent();
}

function updateLightboxContent() {
    const currentImage = lightboxData.images[lightboxData.currentIndex];
    const image = document.getElementById('lightboxImage');
    const title = document.getElementById('lightboxTitle');
    const description = document.getElementById('lightboxDescription');
    const counter = document.getElementById('imageCounter');
    
    // Fade out effect
    image.style.opacity = '0';
    
    setTimeout(() => {
        image.src = currentImage.src;
        image.alt = currentImage.title;
        title.textContent = currentImage.title;
        description.textContent = currentImage.description;
        counter.textContent = `${lightboxData.currentIndex + 1} / ${lightboxData.images.length}`;
        
        // Fade in effect
        image.style.opacity = '1';
    }, 150);
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (!lightboxData.isOpen) return;
    
    switch(e.key) {
        case 'Escape':
            closeLightbox();
            break;
        case 'ArrowLeft':
            changeImage(-1);
            break;
        case 'ArrowRight':
            changeImage(1);
            break;
    }
});

// Close on background click
document.getElementById('lightboxModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});

// Touch/swipe support untuk mobile
let touchStartX = 0;
let touchEndX = 0;

document.getElementById('lightboxModal').addEventListener('touchstart', function(e) {
    touchStartX = e.changedTouches[0].screenX;
});

document.getElementById('lightboxModal').addEventListener('touchend', function(e) {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
});

function handleSwipe() {
    const swipeThreshold = 50;
    const diff = touchStartX - touchEndX;
    
    if (Math.abs(diff) > swipeThreshold) {
        if (diff > 0) {
            // Swipe left - next image
            changeImage(1);
        } else {
            // Swipe right - previous image
            changeImage(-1);
        }
    }
}
</script>

@endsection
