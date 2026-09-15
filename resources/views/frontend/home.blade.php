@extends('layouts.frontend')

@section('title', 'Beranda - ' . $schoolName)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home-cards.css') }}">
@endpush

@section('content')
@include('frontend.partials.hero-slider')

<section class="relative py-12 lg:py-16" style="background: linear-gradient(180deg, #f4faf4 0%, #ffffff 40%, #f9fff9 100%);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12">
            {{-- Main --}}
            <div class="lg:col-span-8 space-y-14">

                {{-- Program Unggulan --}}
                <section>
                    <div class="mb-7 sm:mb-8">
                        <p class="text-[11px] font-semibold tracking-[0.16em] uppercase text-[var(--color-primary)] mb-2">Program</p>
                        <h2 class="font-display text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Program Unggulan</h2>
                        <p class="text-sm text-gray-600 max-w-xl leading-relaxed">{{ __('program_subtitle') }}</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @forelse($programUnggulan as $program)
                            @php $warnaClasses = $program->warna_classes; @endphp
                            <article class="home-program-card"
                                     style="--card-accent: {{ $warnaClasses['accent'] }}; --card-accent-bright: {{ $warnaClasses['accent-bright'] }}; --card-soft: {{ $warnaClasses['soft'] }}; --card-ink: {{ $warnaClasses['ink'] }}; --card-shadow: {{ $warnaClasses['shadow'] }}; --card-delay: {{ $loop->index * 90 }}ms;">
                                <span class="home-program-card__blob" aria-hidden="true"></span>
                                <span class="home-program-card__shine" aria-hidden="true"></span>
                                <div class="home-program-card__bar"></div>
                                <div class="home-program-card__body">
                                    <div class="home-program-card__top">
                                        <div class="home-program-card__icon" aria-hidden="true">
                                            <i class="{{ $program->icon }}"></i>
                                        </div>
                                        <span class="home-program-card__num">
                                            {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </div>
                                    <h3>{{ $program->judul }}</h3>
                                    <p class="line-clamp-4">{{ $program->deskripsi }}</p>
                                </div>
                            </article>
                        @empty
                            <div class="sm:col-span-2 rounded-2xl border border-dashed border-green-900/15 bg-white/70 px-6 py-10 text-center">
                                <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-[var(--color-primary)]/10 text-[var(--color-primary)]">
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="mb-1 text-sm font-medium text-gray-700">Program unggulan belum ditampilkan</p>
                                <p class="text-xs text-gray-500">Tambahkan lewat menu Admin → Program Unggulan.</p>
                            </div>
                        @endforelse
                    </div>
                </section>

                {{-- Features / Keunggulan --}}
                @if(isset($features) && $features->count() > 0)
                <section>
                    <div class="mb-7 sm:mb-8">
                        <p class="text-[11px] font-semibold tracking-[0.16em] uppercase text-[var(--color-primary)] mb-2">Keunggulan</p>
                        <h2 class="font-display text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Mengapa Memilih Kami?</h2>
                        <p class="text-sm text-gray-600 max-w-xl leading-relaxed">{{ __('keunggulan_subtitle') }}</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($features->take(6) as $feature)
                            @php $warnaClasses = $feature->warna_classes; @endphp
                            <div class="home-feature-card"
                                 style="--card-accent: {{ $warnaClasses['accent'] }}; --card-accent-bright: {{ $warnaClasses['accent-bright'] }}; --card-soft: {{ $warnaClasses['soft'] }}; --card-ink: {{ $warnaClasses['ink'] }}; --card-shadow: {{ $warnaClasses['shadow'] }}; --card-delay: {{ $loop->index * 80 }}ms;">
                                <span class="home-feature-card__shine" aria-hidden="true"></span>
                                <div class="home-feature-card__icon" aria-hidden="true">
                                    <i class="{{ $feature->icon }}"></i>
                                </div>
                                <div class="min-w-0 pt-0.5">
                                    <h3>{{ $feature->judul }}</h3>
                                    <p class="line-clamp-3">{{ $feature->deskripsi }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                @endif

                {{-- Berita --}}
                <section>
                    <div class="flex items-end justify-between gap-4 mb-7">
                        <div>
                            <p class="text-[11px] font-semibold tracking-[0.16em] uppercase text-[var(--color-primary)] mb-2">Berita</p>
                            <h2 class="font-display text-2xl sm:text-3xl font-bold text-gray-900">{{ __('berita_heading') }}</h2>
                        </div>
                        <a href="{{ route('berita') }}" class="hidden sm:inline-flex items-center gap-2 text-sm font-semibold text-[var(--color-primary)] hover:text-[var(--color-primary-dark)]">
                            Lihat semua <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>

                    @if(isset($berita) && $berita->count() > 0)
                        @php $featured = $berita->first(); $rest = $berita->slice(1, 3); @endphp
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-5">
                            <article class="md:col-span-3 group">
                                <a href="{{ route('berita.show', $featured->slug) }}" class="block overflow-hidden rounded-2xl mb-4 aspect-[16/10]">
                                    <img src="{{ $featured->gambar_url ?? asset('images/default-news.jpg') }}"
                                         alt="{{ $featured->judul }}"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                </a>
                                <div class="text-xs text-gray-500 mb-2">
                                    {{ $featured->published_at ? $featured->published_at->format('d M Y') : $featured->created_at->format('d M Y') }}
                                    @if($featured->hasKategori())
                                        <span class="mx-1">·</span>
                                        <span class="text-[var(--color-primary)]">{{ $featured->kategori_display }}</span>
                                    @endif
                                </div>
                                <h3 class="font-display text-xl font-bold text-gray-900 leading-snug mb-2 group-hover:text-[var(--color-primary-dark)] transition-colors">
                                    <a href="{{ route('berita.show', $featured->slug) }}">{{ $featured->judul }}</a>
                                </h3>
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    {{ $featured->short_excerpt ?? Str::limit(strip_tags($featured->konten), 120) }}
                                </p>
                            </article>

                            <div class="md:col-span-2 flex flex-col gap-4">
                                @forelse($rest as $news)
                                    <article class="group flex gap-3">
                                        <a href="{{ route('berita.show', $news->slug) }}" class="shrink-0 w-24 h-20 rounded-xl overflow-hidden">
                                            <img src="{{ $news->gambar_url ?? asset('images/default-news.jpg') }}"
                                                 alt="{{ $news->judul }}"
                                                 loading="lazy"
                                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        </a>
                                        <div class="min-w-0">
                                            <div class="text-[11px] text-gray-500 mb-1">
                                                {{ $news->published_at ? $news->published_at->format('d M Y') : $news->created_at->format('d M Y') }}
                                            </div>
                                            <h3 class="text-sm font-semibold text-gray-900 leading-snug line-clamp-3 group-hover:text-[var(--color-primary-dark)] transition-colors">
                                                <a href="{{ route('berita.show', $news->slug) }}">{{ $news->judul }}</a>
                                            </h3>
                                        </div>
                                    </article>
                                @empty
                                    <p class="text-sm text-gray-500">Belum ada berita lain.</p>
                                @endforelse

                                <a href="{{ route('berita') }}" class="sm:hidden inline-flex items-center gap-2 text-sm font-semibold text-[var(--color-primary)] mt-2">
                                    Lihat semua berita <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 py-8">Belum ada berita.</p>
                    @endif
                </section>

                {{-- Galeri — pola sama seperti Berita --}}
                <section>
                    <div class="flex items-end justify-between gap-4 mb-7">
                        <div>
                            <p class="text-[11px] font-semibold tracking-[0.16em] uppercase text-[var(--color-primary)] mb-2">Galeri</p>
                            <h2 class="font-display text-2xl sm:text-3xl font-bold text-gray-900">Dokumentasi Kegiatan</h2>
                        </div>
                        <a href="{{ route('galeri') }}" class="hidden sm:inline-flex items-center gap-2 text-sm font-semibold text-[var(--color-primary)] hover:text-[var(--color-primary-dark)]">
                            Lihat semua <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>

                    @if(isset($galeri) && $galeri->count() > 0)
                        @php
                            $galeriFeatured = $galeri->first();
                            $galeriRest = $galeri->slice(1, 3);
                            $galeriFeaturedThumb = optional($galeriFeatured->thumbnailItem)->preview_url
                                ?? $galeriFeatured->thumbnail_url
                                ?? asset('images/default-galeri.jpg');
                        @endphp
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-5">
                            <article class="md:col-span-3 group">
                                <a href="{{ route('galeri.show', $galeriFeatured->id) }}"
                                   class="block overflow-hidden rounded-2xl mb-4 bg-green-50"
                                   style="height: 220px;">
                                    <img src="{{ $galeriFeaturedThumb }}"
                                         alt="{{ $galeriFeatured->judul }}"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                         style="height: 220px; width: 100%; object-fit: cover;">
                                </a>
                                <div class="text-xs text-gray-500 mb-2">
                                    {{ $galeriFeatured->created_at->format('d M Y') }}
                                    @if(!empty($galeriFeatured->kategori))
                                        <span class="mx-1">·</span>
                                        <span class="text-[var(--color-primary)]">{{ ucfirst($galeriFeatured->kategori) }}</span>
                                    @endif
                                    <span class="mx-1">·</span>
                                    {{ $galeriFeatured->activeItems->count() }} foto
                                </div>
                                <h3 class="font-display text-xl font-bold text-gray-900 leading-snug mb-2 group-hover:text-[var(--color-primary-dark)] transition-colors">
                                    <a href="{{ route('galeri.show', $galeriFeatured->id) }}">{{ $galeriFeatured->judul }}</a>
                                </h3>
                                @if(!empty($galeriFeatured->deskripsi))
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ Str::limit(strip_tags($galeriFeatured->deskripsi), 120) }}
                                    </p>
                                @endif
                            </article>

                            <div class="md:col-span-2 flex flex-col gap-4">
                                @forelse($galeriRest as $item)
                                    @php
                                        $thumb = optional($item->thumbnailItem)->preview_url
                                            ?? $item->thumbnail_url
                                            ?? asset('images/default-galeri.jpg');
                                    @endphp
                                    <article class="group flex gap-3">
                                        <a href="{{ route('galeri.show', $item->id) }}"
                                           class="shrink-0 rounded-xl overflow-hidden bg-green-50"
                                           style="width: 96px; height: 80px;">
                                            <img src="{{ $thumb }}"
                                                 alt="{{ $item->judul }}"
                                                 loading="lazy"
                                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                                 style="width: 96px; height: 80px; object-fit: cover;">
                                        </a>
                                        <div class="min-w-0">
                                            <div class="text-[11px] text-gray-500 mb-1">
                                                {{ $item->created_at->format('d M Y') }}
                                                @if(!empty($item->kategori))
                                                    · {{ ucfirst($item->kategori) }}
                                                @endif
                                            </div>
                                            <h3 class="text-sm font-semibold text-gray-900 leading-snug line-clamp-3 group-hover:text-[var(--color-primary-dark)] transition-colors">
                                                <a href="{{ route('galeri.show', $item->id) }}">{{ $item->judul }}</a>
                                            </h3>
                                        </div>
                                    </article>
                                @empty
                                    <div class="flex-1 flex flex-col justify-center rounded-2xl border border-dashed border-green-900/15 bg-white/70 px-4 py-6 text-center">
                                        <i class="fas fa-images text-green-300 text-xl mb-2"></i>
                                        <p class="text-sm text-gray-500">Tambah album lain agar tampil di sini.</p>
                                        <a href="{{ route('galeri') }}" class="mt-3 text-sm font-semibold text-[var(--color-primary)]">
                                            Lihat semua galeri
                                        </a>
                                    </div>
                                @endforelse

                                <a href="{{ route('galeri') }}" class="sm:hidden inline-flex items-center gap-2 text-sm font-semibold text-[var(--color-primary)] mt-2">
                                    Lihat semua galeri <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-gray-500 py-8">Belum ada galeri.</p>
                    @endif
                </section>
            </div>

            {{-- Widgets --}}
            {{-- Widgets: di desktop kanan, di HP paling bawah (urutan DOM) --}}
            <div class="lg:col-span-4">
                @include('frontend.partials.homepage-widgets')
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="relative overflow-hidden text-white py-14 lg:py-20"
         style="background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 45%, #004d00 100%);">
    <div class="absolute inset-0 opacity-30 pointer-events-none"
         style="background-image: radial-gradient(circle at 15% 20%, #CCFF99 0, transparent 35%), radial-gradient(circle at 85% 80%, rgba(255,255,0,0.35) 0, transparent 30%);"></div>
    <div class="relative max-w-3xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <p class="text-[11px] font-semibold tracking-[0.16em] uppercase text-[#CCFF99] mb-3">Bergabung</p>
        <h2 class="font-display text-2xl sm:text-3xl lg:text-4xl font-bold mb-4">Mari Menjadi Bagian dari Kami</h2>
        <p class="text-base text-green-50/90 mb-8 max-w-xl mx-auto leading-relaxed">
            {{ __('cta_join', ['name' => $profile?->nama_sekolah ?? $schoolName]) }}
        </p>
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('kontak') }}"
               class="inline-flex items-center justify-center bg-white text-[var(--color-primary-dark)] hover:bg-[#CCFF99] px-7 py-3.5 rounded-full font-semibold transition-colors">
                Hubungi Kami
            </a>
            <a href="{{ route('profil') }}"
               class="inline-flex items-center justify-center border border-white/40 text-white hover:bg-white/10 px-7 py-3.5 rounded-full font-semibold transition-colors">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</section>
@endsection
