@extends('layouts.frontend')

@section('title', 'Beranda - ' . $schoolName)

@section('content')
<!-- Hero Section -->
<div class="text-white relative overflow-hidden" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 50%, var(--color-secondary) 100%);">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full animate-bounce"></div>
    <div class="absolute top-40 right-20 w-16 h-16 bg-white/10 rounded-full animate-bounce" style="animation-delay: 1s;"></div>
    <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white/10 rounded-full animate-bounce" style="animation-delay: 2s;"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl lg:text-7xl font-bold mb-6 drop-shadow-lg leading-tight">
                    Membentuk Generasi
                    <span class="bg-gradient-to-r from-white to-green-100 bg-clip-text text-transparent">
                        Unggul
                    </span>
                </h1>
                <p class="text-xl lg:text-2xl text-green-100 mb-8 leading-relaxed">
                    {{ $profile->nama_sekolah ?? $schoolName }} yang berkomitmen untuk memberikan pendidikan berkualitas dan membentuk karakter santri yang unggul dalam prestasi dan akhlak.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('profil') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-info-circle mr-2"></i>
                        Pelajari Lebih Lanjut
                    </a>
                    <a href="{{ route('kontak') }}" class="bg-white text-green-600 hover:bg-green-50 hover:text-green-700 px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-200 border-2 border-white hover:border-green-200">
                        <i class="fas fa-phone mr-2"></i>
                        Hubungi Kami
                    </a>
                </div>
            </div>
            
            <div class="relative">
                <div class="w-full h-96 lg:h-[500px] bg-gradient-to-br from-green-500/20 via-yellow-400/20 to-green-600/20 backdrop-blur-sm rounded-3xl flex items-center justify-center border border-yellow-300/30 overflow-hidden shadow-2xl">
                    <!-- Foto {{ __('school') }} dengan Fallback -->
                    <div class="w-full h-full relative">
                        <!-- Gambar hero dari database atau default -->
                        <img src="{{ $profile->hero_image_url ?? asset('images/hero/hero-main.jpg') }}" 
                             alt="{{ $profile->nama_sekolah ?? $schoolName }} - Hero Image"
                             class="w-full h-full object-cover rounded-3xl"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        
                        <!-- Fallback foto berita akademik -->
                        <img src="{{ asset('images/berita/berita-akademik-1.jpg') }}" 
                             alt="{{ $profile->nama_sekolah ?? $schoolName }} - Kegiatan Belajar Mengajar"
                             class="w-full h-full object-cover rounded-3xl"
                             style="display: none;"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        
                        <!-- Fallback foto berita prestasi -->
                        <img src="{{ asset('images/berita/berita-prestasi-1.jpg') }}" 
                             alt="{{ $profile->nama_sekolah ?? $schoolName }} - Prestasi Santri"
                             class="w-full h-full object-cover rounded-3xl"
                             style="display: none;"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        
                        <!-- Fallback foto berita kegiatan -->
                        <img src="{{ asset('images/berita/berita-kegiatan-1.jpg') }}" 
                             alt="{{ $profile->nama_sekolah ?? $schoolName }} - Kegiatan Santri"
                             class="w-full h-full object-cover rounded-3xl"
                             style="display: none;"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        
                        <!-- Fallback Content jika semua foto tidak tersedia -->
                        <div class="w-full h-full flex items-center justify-center text-center" style="display: none;">
                            <div class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                                <i class="fas fa-graduation-cap text-white text-6xl"></i>
                            </div>
                            <div class="absolute bottom-8 left-0 right-0 text-center">
                                <h3 class="text-2xl font-bold text-white mb-2">{{ $profile->nama_sekolah ?? $schoolName }}</h3>
                                <p class="text-blue-100">Pendidikan Berkualitas untuk Masa Depan Cemerlang</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Overlay dengan informasi {{ __('school') }} -->
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-r from-green-600 via-yellow-500 to-green-700 p-6 rounded-b-3xl">
                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-white mb-2">{{ $profile->nama_sekolah ?? $schoolName }}</h3>
                            <p class="text-green-100">Pendidikan Berkualitas untuk Masa Depan Cemerlang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Program Unggulan Section -->
<div class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                Program Unggulan Kami
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Program-program khusus yang dirancang untuk mengembangkan potensi siswa secara optimal
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($programUnggulan as $program)
            @php
                $warnaClasses = $program->warna_classes;
            @endphp
            <div class="group relative h-full">
                <div class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 hover:{{ $warnaClasses['border'] }} overflow-hidden h-full flex flex-col">
                    <!-- Background Pattern -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br {{ $warnaClasses['bg-light'] }} rounded-full -translate-y-16 translate-x-16 opacity-20 group-hover:opacity-30 transition-opacity duration-500"></div>
                    
                    <!-- Icon Container -->
                    <div class="relative z-10 w-20 h-20 bg-gradient-to-br {{ $warnaClasses['bg'] }} rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                        <i class="{{ $program->icon }} text-white text-3xl group-hover:scale-110 transition-transform duration-300"></i>
                    </div>
                    
                    <!-- Content -->
                    <div class="relative z-10 text-center flex-1 flex flex-col">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:{{ $warnaClasses['text'] }} transition-colors duration-300">{{ $program->judul }}</h3>
                        <p class="text-gray-600 leading-relaxed text-sm flex-1">
                            {{ $program->deskripsi }}
                        </p>
                    </div>
                    
                    <!-- Hover Effect Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-br {{ $warnaClasses['bg-overlay'] }} opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl"></div>
                </div>
            </div>
            @empty
            <!-- Default Program jika belum ada data -->
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Program unggulan akan segera hadir</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="bg-gradient-to-br from-slate-50 to-blue-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                Mengapa Memilih Kami?
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Kami berkomitmen memberikan pendidikan terbaik dengan berbagai keunggulan yang membedakan kami dari yang lain.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($features as $feature)
            @php
                $warnaClasses = $feature->warna_classes;
            @endphp
            <div class="card-modern text-center p-8 group hover:scale-105 transition-all duration-300">
                <div class="w-20 h-20 bg-gradient-to-br {{ $warnaClasses['bg'] }} rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="{{ $feature->icon }} text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">{{ $feature->judul }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ $feature->deskripsi }}
                </p>
            </div>
            @empty
            <!-- Default Features jika belum ada data -->
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500">Fitur akan segera hadir</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Latest News Section -->
<div class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Berita Terbaru
                </h2>
                <p class="text-xl text-gray-600">
                                            Dapatkan informasi terbaru seputar kegiatan dan prestasi pondok pesantren kami.
                </p>
            </div>
            <a href="{{ route('berita') }}" class="btn-modern btn-modern-primary bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700">
                Lihat Semua Berita
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        
        @if(isset($berita) && $berita->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($berita->take(3) as $news)
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
                                    <span class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg backdrop-blur-sm hover:from-green-700 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105">
                                        <i class="fas fa-tag mr-1"></i>{{ $news->kategori_display }}
                                    </span>
                                @else
                                    <span class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg backdrop-blur-sm hover:from-green-700 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105">
                                        <i class="fas fa-tag mr-1"></i>Berita
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
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
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
                                    <i class="fas fa-user mr-1 text-emerald-500"></i>
                                    <span class="font-medium">{{ $news->user->name ?? 'Admin' }}</span>
                                </div>
                                <div class="flex items-center bg-gray-100 rounded-full px-3 py-1 hover:bg-gray-200 transition-colors duration-300">
                                    <i class="fas fa-comments mr-1 text-green-500"></i>
                                    <span class="font-medium">{{ $news->comments->count() ?? 0 }}</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <a href="{{ route('berita.show', $news->slug) }}" 
                                   class="group/btn bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl font-bold hover:from-green-700 hover:to-emerald-700 transition-all duration-300 inline-flex items-center shadow-lg hover:shadow-xl transform hover:scale-105 text-sm">
                                    <i class="fas fa-book-open mr-2"></i>
                                    Baca
                                    <i class="fas fa-arrow-right ml-2 text-xs group-hover/btn:translate-x-1 transition-transform duration-300"></i>
                                </a>
                                
                                <div class="flex items-center space-x-2">
                                    <button onclick="shareArticle('{{ route('berita.show', $news->slug) }}', '{{ $news->judul }}')" 
                                            class="w-10 h-10 bg-gradient-to-r from-green-100 to-emerald-100 hover:from-green-200 hover:to-emerald-200 rounded-full flex items-center justify-center transition-all duration-300 group/share transform hover:scale-110">
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
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Berita</h3>
                <p class="text-gray-600">Berita akan segera hadir di sini.</p>
            </div>
        @endif
    </div>
</div>

<!-- Latest Gallery Section -->
<div class="bg-gradient-to-br from-slate-50 to-blue-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Galeri Terbaru
                </h2>
                <p class="text-xl text-gray-600">
                    Dokumentasi visual kegiatan dan momen berharga pondok pesantren kami.
                </p>
            </div>
            <a href="{{ route('galeri') }}" class="btn-modern btn-modern-primary bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700">
                Lihat Semua Galeri
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        
        @if(isset($galeri) && $galeri->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($galeri->take(3) as $item)
                    <article class="bg-white rounded-3xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-green-200 transform hover:-translate-y-3 hover:scale-[1.02]">
                        <!-- Image -->
                        <div class="relative overflow-hidden h-64">
                            @if($item->thumbnailItem)
                                <img src="{{ asset('storage/' . $item->thumbnailItem->file_path) }}" 
                                     alt="{{ $item->judul }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <i class="fas fa-images text-gray-400 text-6xl"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent group-hover:from-black/50 transition-all duration-500"></div>
                            
                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg backdrop-blur-sm hover:from-green-700 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-folder mr-1"></i>{{ ucfirst($item->kategori ?? 'Galeri') }}
                                </span>
                            </div>
                            
                            <!-- Item Count & Date -->
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="flex items-center justify-between text-white text-xs space-x-2">
                                    <div class="flex items-center bg-black/40 backdrop-blur-sm rounded-full px-3 py-1 hover:bg-black/50 transition-all duration-300">
                                        <i class="fas fa-images mr-1"></i>
                                        {{ $item->jumlah_item }} item
                                    </div>
                                    <div class="flex items-center bg-black/40 backdrop-blur-sm rounded-full px-3 py-1 hover:bg-black/50 transition-all duration-300">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        {{ $item->created_at->format('d-m-Y') }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-green-600/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6 bg-gradient-to-br from-white to-gray-50">
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors duration-300 line-clamp-2 leading-tight">
                                <a href="{{ route('galeri.show', $item->id) }}" class="hover:text-green-600 transition-colors duration-300 block">
                                    {{ $item->judul }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed text-sm">
                                {{ Str::limit(strip_tags($item->deskripsi), 120) }}
                            </p>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                <a href="{{ route('galeri.show', $item->id) }}" 
                                   class="group/btn bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-3 rounded-xl font-bold hover:from-green-700 hover:to-emerald-700 transition-all duration-300 inline-flex items-center shadow-lg hover:shadow-xl transform hover:scale-105 text-sm">
                                    <i class="fas fa-eye mr-2"></i>
                                    Lihat Galeri
                                    <i class="fas fa-arrow-right ml-2 text-xs group-hover/btn:translate-x-1 transition-transform duration-300"></i>
                                </a>
                                
                                <div class="flex items-center text-xs text-gray-500">
                                    <i class="fas fa-images mr-1 text-green-500"></i>
                                    <span class="font-medium">{{ $item->jumlah_item }} foto</span>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-images text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Galeri</h3>
                <p class="text-gray-600">Galeri akan segera hadir di sini.</p>
            </div>
        @endif
    </div>
</div>

<!-- Upcoming Events Section -->
<div class="bg-gradient-to-br from-slate-50 to-blue-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Agenda Terkini
                </h2>
                <p class="text-xl text-gray-600">
                    Lihat kegiatan dan acara penting yang akan datang dan yang sudah selesai.
                </p>
            </div>
            <a href="{{ route('agenda') }}" class="btn-modern btn-modern-primary bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700">
                Lihat Semua Agenda
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        
        @if(isset($agenda) && $agenda->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($agenda->take(3) as $event)
                    <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden {{ $event->auto_status === 'completed' ? 'opacity-75' : '' }}">
                        <!-- Status Indicator Bar -->
                        <div class="h-2 w-full 
                            @switch($event->auto_status)
                                @case('upcoming') bg-green-500 @break
                                @case('ongoing') bg-blue-500 @break
                                @case('completed') bg-gray-400 @break
                                @case('cancelled') bg-red-500 @break
                                @default bg-green-500
                            @endswitch
                        "></div>
                        
                        <div class="relative p-6">
                            <!-- Header Section -->
                            <div class="flex items-start justify-between mb-5">
                                <div class="flex items-center space-x-3">
                                    <div class="w-14 h-14 bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                                        <i class="fas fa-calendar-alt text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium
                                            @if($event->jenis == 'akademik')
                                                bg-green-100 text-green-800
                                            @elseif($event->jenis == 'non-akademik')
                                                bg-emerald-100 text-emerald-800
                                            @else
                                                bg-green-100 text-green-800
                                            @endif
                                        ">
                                            <i class="fas fa-{{ $event->jenis == 'akademik' ? 'graduation-cap' : ($event->jenis == 'non-akademik' ? 'users' : 'star') }} mr-2"></i>
                                            {{ ucfirst($event->jenis ?? 'Event') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Status Badge -->
                                <div class="flex flex-col items-end">
                                    @switch($event->auto_status)
                                        @case('upcoming')
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-green-100 text-green-800">
                                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                                Akan Datang
                                            </span>
                                            @break
                                        @case('ongoing')
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-blue-100 text-blue-800">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                                                Sedang Berlangsung
                                            </span>
                                            @break
                                        @case('completed')
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-gray-100 text-gray-600">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                Selesai
                                            </span>
                                            @break
                                        @case('cancelled')
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-2"></i>
                                                Dibatalkan
                                            </span>
                                            @break
                                        @default
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-green-100 text-green-800">
                                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                                {{ ucfirst($event->status ?? 'Akan Datang') }}
                                            </span>
                                    @endswitch
                                </div>
                            </div>
                            
                            <!-- Title -->
                            <h3 class="text-xl font-bold text-gray-900 mb-4 leading-tight">
                                {{ $event->judul }}
                            </h3>
                            
                            <!-- Event Details -->
                            <div class="space-y-3 mb-5">
                                <!-- Date & Time -->
                                <div class="flex items-center text-gray-700 bg-gray-50 rounded-lg p-3">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-calendar-day text-green-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 text-sm">
                                            {{ $event->tanggal_mulai ? $event->tanggal_mulai->format('d-m-Y') : 'Tanggal belum ditentukan' }}
                                        </div>
                                        @if($event->waktu_mulai)
                                            <div class="text-xs text-gray-600">
                                                {{ $event->waktu_mulai }} 
                                                @if($event->waktu_selesai)
                                                    - {{ $event->waktu_selesai }}
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Location -->
                                @if($event->lokasi)
                                <div class="flex items-center text-gray-700 bg-gray-50 rounded-lg p-3">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-map-marker-alt text-emerald-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 text-sm">Lokasi</div>
                                        <div class="text-xs text-gray-600">{{ $event->lokasi }}</div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Description -->
                            <div class="mb-5">
                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                                    {{ Str::limit($event->deskripsi, 100) }}
                                </p>
                            </div>
                            
                            <!-- Action Button -->
                            <div class="flex items-center justify-between">
                                <a href="{{ route('agenda.show', $event->id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-medium rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-200 text-sm shadow-md hover:shadow-lg transform hover:scale-105">
                                    <span>Lihat Detail</span>
                                    <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </a>
                                
                                <!-- Additional Info -->
                                @if($event->peserta)
                                <div class="text-right">
                                    <div class="text-xs text-gray-500 font-medium">Peserta</div>
                                    <div class="text-sm font-semibold text-gray-800">{{ $event->peserta }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-calendar-alt text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Agenda</h3>
                <p class="text-gray-600">Agenda akan segera hadir di sini.</p>
            </div>
        @endif
    </div>
</div>

<!-- Call to Action Section -->
<div class="text-white py-20" style="background: linear-gradient(135deg, var(--color-primary) 0%, #6366f1 50%, var(--color-secondary) 100%);">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl lg:text-5xl font-bold mb-6">
            Bergabunglah Bersama Kami
        </h2>
        <p class="text-xl text-green-100 mb-8 leading-relaxed">
            Mari bergabung dengan {{ $profile->nama_sekolah ?? $schoolName }} dan wujudkan impian Anda untuk menjadi generasi unggul yang berakhlak mulia.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('kontak') }}" class="btn-modern bg-white text-green-600 hover:bg-green-50 hover:text-green-700 text-lg px-8 py-4">
                <i class="fas fa-phone mr-2"></i>
                Daftar Sekarang
            </a>
            <a href="{{ route('profil') }}" class="btn-modern bg-transparent border-2 border-white text-white hover:bg-white hover:text-green-600 text-lg px-8 py-4">
                <i class="fas fa-info-circle mr-2"></i>
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</div>

<!-- Newsletter Section -->
<div class="bg-white py-20">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Dapatkan Update Terbaru</h2>
                                <p class="text-xl text-gray-600 mb-8">Berlangganan newsletter kami untuk mendapatkan informasi terbaru seputar kegiatan pondok pesantren</p>
        
        <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            <input type="email" 
                   placeholder="Masukkan email Anda" 
                   class="form-input-modern flex-1">
            <button class="btn-modern btn-modern-primary whitespace-nowrap">
                Berlangganan
            </button>
        </div>
        
        <p class="text-sm text-gray-500 mt-4">Kami tidak akan mengirim spam. Hanya informasi penting yang relevan.</p>
    </div>
</div>

<style>
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

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

/* Enhanced Shadows */
.shadow-news {
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.shadow-news:hover {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
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

/* Smooth Transitions */
* {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Focus States for Accessibility */
button:focus,
input:focus,
select:focus,
a:focus {
    outline: 2px solid #3b82f6;
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
document.querySelectorAll('.btn-modern').forEach(btn => {
    if (btn.textContent.includes('Berlangganan')) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const emailInput = this.parentElement.querySelector('input[type="email"]');
            if (emailInput && emailInput.value) {
                showNotification('Terima kasih telah berlangganan newsletter kami!', 'success');
                emailInput.value = '';
            } else {
                showNotification('Silakan masukkan email Anda terlebih dahulu.', 'warning');
            }
        });
    }
});

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
