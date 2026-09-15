@extends('layouts.frontend')

@section('title', 'Berita & Artikel - ' . $schoolName)

@push('meta')
<meta name="description" content="Dapatkan informasi terbaru seputar kegiatan, prestasi, dan perkembangan {{ $schoolName }}. Baca artikel dan berita terkini dari sekolah kami.">
<meta name="keywords" content="berita {{ $schoolName }}, artikel sekolah, kegiatan {{ __('school') }}, prestasi siswa, perkembangan pendidikan">
<meta name="author" content="{{ $schoolName }}">
<meta name="robots" content="index, follow">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="Berita & Artikel - {{ $schoolName }}">
<meta property="og:description" content="Dapatkan informasi terbaru seputar kegiatan, prestasi, dan perkembangan {{ $schoolName }}.">
<meta property="og:image" content="{{ asset('images/og-image.jpg') }}">
<meta property="og:site_name" content="{{ $schoolName }}">
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:title" content="Berita & Artikel - {{ $schoolName }}">
<meta property="twitter:description" content="Dapatkan informasi terbaru seputar kegiatan, prestasi, dan perkembangan {{ $schoolName }}.">
<link rel="canonical" href="{{ url()->current() }}">
@endpush

@push('styles')
<style>
    .berita-portal {
        --bp-accent: var(--color-primary, #008000);
        --bp-accent-dark: var(--color-primary-dark, #006600);
        --bp-border: #e5e7eb;
        --bp-muted: #6b7280;
        --bp-ink: #111827;
    }

    .berita-portal a:hover .bp-title {
        color: var(--bp-accent);
    }

    .bp-cat-link {
        white-space: nowrap;
        border-bottom: 2px solid transparent;
    }

    .bp-cat-link:hover,
    .bp-cat-link.is-active {
        color: var(--bp-accent);
        border-bottom-color: var(--bp-accent);
    }

    .bp-headline-img {
        aspect-ratio: 16 / 10;
    }

    .bp-side-thumb {
        width: 7.5rem;
        height: 5.5rem;
        flex-shrink: 0;
    }

    .bp-list-thumb {
        width: 11rem;
        height: 7.5rem;
        flex-shrink: 0;
    }

    @media (max-width: 640px) {
        .bp-list-thumb {
            width: 100%;
            height: 11rem;
        }
    }

    .bp-rank {
        width: 1.75rem;
        height: 1.75rem;
    }
</style>
@endpush

@section('content')
@php
    $items = isset($berita) ? $berita->getCollection() : collect();
    $isFirstPage = !isset($berita) || $berita->currentPage() === 1;
    $isFiltered = request()->filled('search') || request()->filled('kategori') || (request()->filled('sort') && request('sort') !== 'latest');
    $useHeadlineLayout = $isFirstPage && (!$isFiltered || request('sort', 'latest') === 'latest');
    $headline = $useHeadlineLayout ? $items->first() : null;
    $sideStories = $useHeadlineLayout ? $items->slice(1, 3) : collect();
    $listStories = $useHeadlineLayout ? $items->slice(4) : $items;
@endphp

<div class="berita-portal bg-gray-50 min-h-screen">
    {{-- Compact page header --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
            <nav class="flex items-center gap-2 text-sm text-gray-500 mb-3" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-green-700 transition-colors">Beranda</a>
                <i class="fas fa-chevron-right text-[10px] text-gray-400"></i>
                <span class="text-gray-900 font-medium">Berita</span>
            </nav>

            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Berita & Artikel</h1>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ isset($berita) ? $berita->total() : 0 }} artikel terbaru dari {{ $schoolName }}
                    </p>
                </div>

                <form method="GET" action="{{ route('berita') }}" class="w-full lg:w-[28rem]">
                    @if(request('kategori'))
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    @if(request('sort') && request('sort') !== 'latest')
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    <div class="relative">
                        <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="search"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari berita..."
                               class="w-full pl-10 pr-24 py-2.5 text-sm border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none"
                               autocomplete="off">
                        <button type="submit"
                                class="absolute right-1.5 top-1/2 -translate-y-1/2 px-3 py-1.5 text-xs font-semibold text-white bg-green-700 hover:bg-green-800 rounded-md transition-colors">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Category strip --}}
        <div class="border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-1 overflow-x-auto py-0 scrollbar-hide">
                    <a href="{{ route('berita', array_filter(request()->except('kategori', 'page'))) }}"
                       class="bp-cat-link px-3 py-3 text-sm font-semibold {{ !request('kategori') ? 'is-active text-green-700' : 'text-gray-600' }}">
                        Semua
                    </a>
                    @foreach($kategoris ?? [] as $kategori)
                        <a href="{{ route('berita', array_filter(array_merge(request()->except('page'), ['kategori' => $kategori->nama]))) }}"
                           class="bp-cat-link px-3 py-3 text-sm font-medium {{ request('kategori') == $kategori->nama ? 'is-active text-green-700 font-semibold' : 'text-gray-600' }}">
                            {{ $kategori->nama }}
                            <span class="text-gray-400 font-normal">({{ $kategori->berita_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if($isFiltered)
            <div class="flex flex-wrap items-center gap-2 mb-6 text-sm">
                <span class="text-gray-500">Filter:</span>
                @if(request('search'))
                    <span class="inline-flex items-center gap-2 px-2.5 py-1 bg-white border border-gray-200 rounded-full text-gray-700">
                        "{{ request('search') }}"
                        <a href="{{ route('berita', array_filter(request()->except('search', 'page'))) }}" class="text-gray-400 hover:text-red-600" aria-label="Hapus pencarian">&times;</a>
                    </span>
                @endif
                @if(request('kategori'))
                    <span class="inline-flex items-center gap-2 px-2.5 py-1 bg-white border border-gray-200 rounded-full text-gray-700">
                        {{ request('kategori') }}
                        <a href="{{ route('berita', array_filter(request()->except('kategori', 'page'))) }}" class="text-gray-400 hover:text-red-600" aria-label="Hapus kategori">&times;</a>
                    </span>
                @endif
                <a href="{{ route('berita') }}" class="text-green-700 hover:underline font-medium ml-1">Reset</a>
            </div>
        @endif

        @if($items->isEmpty())
            <div class="bg-white border border-gray-200 rounded-xl py-16 px-6 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-50 flex items-center justify-center">
                    <i class="fas fa-newspaper text-2xl text-green-600"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-900 mb-2">Belum ada berita</h2>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    @if($isFiltered)
                        Tidak ditemukan berita yang sesuai filter Anda. Coba ubah kata kunci atau kategori.
                    @else
                        Berita terbaru akan segera ditampilkan di sini.
                    @endif
                </p>
                @if($isFiltered)
                    <a href="{{ route('berita') }}" class="inline-flex items-center px-4 py-2 bg-green-700 text-white text-sm font-semibold rounded-lg hover:bg-green-800">
                        Lihat semua berita
                    </a>
                @else
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-green-700 text-white text-sm font-semibold rounded-lg hover:bg-green-800">
                        Kembali ke beranda
                    </a>
                @endif
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                {{-- Main column --}}
                <div class="lg:col-span-8 space-y-8">
                    {{-- Top stories / headline --}}
                    @if($useHeadlineLayout && $headline)
                        <section aria-label="Berita utama">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="w-1 h-5 bg-green-700 rounded-full inline-block"></span>
                                    Berita Utama
                                </h2>
                                <form method="GET" action="{{ route('berita') }}" class="hidden sm:block">
                                    @foreach(request()->except('sort', 'page') as $key => $value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endforeach
                                    <select name="sort" onchange="this.form.submit()"
                                            class="text-sm border border-gray-300 rounded-md px-2.5 py-1.5 bg-white text-gray-700 focus:ring-2 focus:ring-green-600/20 focus:border-green-600">
                                        <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                    </select>
                                </form>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-5 gap-5 bg-white border border-gray-200 rounded-xl overflow-hidden">
                                {{-- Headline --}}
                                <article class="md:col-span-3 group">
                                    <a href="{{ route('berita.show', $headline->slug) }}" class="block">
                                        <div class="bp-headline-img overflow-hidden bg-gray-100">
                                            <img src="{{ $headline->gambar_url }}"
                                                 alt="{{ $headline->judul }}"
                                                 class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500"
                                                 loading="eager">
                                        </div>
                                        <div class="p-5">
                                            @if($headline->hasKategori())
                                                <span class="text-xs font-bold uppercase tracking-wide text-green-700">
                                                    {{ $headline->kategori->first()->nama }}
                                                </span>
                                            @endif
                                            <h3 class="bp-title mt-1.5 text-xl sm:text-2xl font-bold text-gray-900 leading-snug transition-colors">
                                                {{ $headline->judul }}
                                            </h3>
                                            <p class="mt-2 text-sm text-gray-600 line-clamp-3 leading-relaxed">
                                                {{ $headline->excerpt }}
                                            </p>
                                            <div class="mt-3 flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-gray-500">
                                                <time datetime="{{ optional($headline->published_at)->toDateString() }}">
                                                    {{ optional($headline->published_at)->translatedFormat('d M Y') ?? $headline->created_at->translatedFormat('d M Y') }}
                                                </time>
                                                <span>&middot;</span>
                                                <span>{{ number_format($headline->view_count ?? 0) }} dibaca</span>
                                                <span>&middot;</span>
                                                <span>{{ $headline->reading_time }} menit</span>
                                            </div>
                                        </div>
                                    </a>
                                </article>

                                {{-- Side stories --}}
                                <div class="md:col-span-2 border-t md:border-t-0 md:border-l border-gray-200 divide-y divide-gray-200">
                                    @forelse($sideStories as $news)
                                        <article class="p-4 group">
                                            <a href="{{ route('berita.show', $news->slug) }}" class="flex gap-3">
                                                <div class="bp-side-thumb overflow-hidden rounded-lg bg-gray-100">
                                                    <img src="{{ $news->gambar_url }}"
                                                         alt="{{ $news->judul }}"
                                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                                         loading="lazy">
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    @if($news->hasKategori())
                                                        <span class="text-[11px] font-bold uppercase tracking-wide text-green-700">
                                                            {{ $news->kategori->first()->nama }}
                                                        </span>
                                                    @endif
                                                    <h3 class="bp-title text-sm font-bold text-gray-900 leading-snug line-clamp-3 transition-colors">
                                                        {{ $news->judul }}
                                                    </h3>
                                                    <time class="mt-1.5 block text-[11px] text-gray-500"
                                                          datetime="{{ optional($news->published_at)->toDateString() }}">
                                                        {{ optional($news->published_at)->translatedFormat('d M Y') ?? $news->created_at->translatedFormat('d M Y') }}
                                                    </time>
                                                </div>
                                            </a>
                                        </article>
                                    @empty
                                        <div class="p-6 text-sm text-gray-500">Belum ada berita lainnya.</div>
                                    @endforelse
                                </div>
                            </div>
                        </section>
                    @endif

                    {{-- Article list --}}
                    @php
                        $showFullFeed = !$useHeadlineLayout;
                        $feed = $showFullFeed ? $items : $listStories;
                    @endphp
                    @if($feed->isNotEmpty())
                        <section aria-label="Daftar berita">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                    <span class="w-1 h-5 bg-green-700 rounded-full inline-block"></span>
                                    {{ request('sort') === 'popular' ? 'Berita Terpopuler' : ($useHeadlineLayout ? 'Berita Lainnya' : 'Semua Berita') }}
                                </h2>
                                <form method="GET" action="{{ route('berita') }}" class="sm:hidden">
                                    @foreach(request()->except('sort', 'page') as $key => $value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endforeach
                                    <select name="sort" onchange="this.form.submit()"
                                            class="text-sm border border-gray-300 rounded-md px-2.5 py-1.5 bg-white text-gray-700">
                                        <option value="latest" {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                    </select>
                                </form>
                            </div>

                            <div class="bg-white border border-gray-200 rounded-xl divide-y divide-gray-100 overflow-hidden">
                                @foreach($feed as $news)
                                    <article class="group">
                                        <a href="{{ route('berita.show', $news->slug) }}"
                                           class="flex flex-col sm:flex-row gap-4 p-4 sm:p-5 hover:bg-gray-50/80 transition-colors">
                                            <div class="bp-list-thumb overflow-hidden rounded-lg bg-gray-100">
                                                <img src="{{ $news->gambar_url }}"
                                                     alt="{{ $news->judul }}"
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                                     loading="lazy">
                                            </div>
                                            <div class="min-w-0 flex-1 flex flex-col">
                                                <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                                    @if($news->hasKategori())
                                                        <span class="text-xs font-bold uppercase tracking-wide text-green-700">
                                                            {{ $news->kategori->first()->nama }}
                                                        </span>
                                                    @endif
                                                    <span class="text-xs text-gray-400">&middot;</span>
                                                    <time class="text-xs text-gray-500"
                                                          datetime="{{ optional($news->published_at)->toDateString() }}">
                                                        {{ optional($news->published_at)->translatedFormat('d M Y') ?? $news->created_at->translatedFormat('d M Y') }}
                                                    </time>
                                                </div>
                                                <h3 class="bp-title text-base sm:text-lg font-bold text-gray-900 leading-snug line-clamp-2 transition-colors">
                                                    {{ $news->judul }}
                                                </h3>
                                                <p class="mt-1.5 text-sm text-gray-600 line-clamp-2 leading-relaxed flex-1">
                                                    {{ $news->short_excerpt }}
                                                </p>
                                                <div class="mt-2 flex items-center gap-3 text-xs text-gray-500">
                                                    <span>{{ $news->user->name ?? 'Admin' }}</span>
                                                    <span>&middot;</span>
                                                    <span>{{ number_format($news->view_count ?? 0) }} dibaca</span>
                                                    @if(($news->comments_count ?? 0) > 0)
                                                        <span>&middot;</span>
                                                        <span>{{ $news->comments_count }} komentar</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    {{-- Pagination --}}
                    @if(isset($berita) && $berita->hasPages())
                        <div class="pt-2">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <p class="text-sm text-gray-500">
                                    Menampilkan {{ $berita->firstItem() }}–{{ $berita->lastItem() }} dari {{ $berita->total() }} artikel
                                </p>
                                <nav class="flex flex-wrap items-center gap-1" aria-label="Pagination">
                                    @if($berita->onFirstPage())
                                        <span class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-200 rounded-md cursor-not-allowed">Sebelumnya</span>
                                    @else
                                        <a href="{{ $berita->previousPageUrl() }}" class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-md hover:border-green-600 hover:text-green-700">Sebelumnya</a>
                                    @endif

                                    @php
                                        $currentPage = $berita->currentPage();
                                        $lastPage = $berita->lastPage();
                                        $start = max(1, $currentPage - 2);
                                        $end = min($lastPage, $currentPage + 2);
                                    @endphp

                                    @if($start > 1)
                                        <a href="{{ $berita->url(1) }}" class="px-3 py-2 text-sm bg-white border border-gray-200 rounded-md hover:border-green-600 hover:text-green-700">1</a>
                                        @if($start > 2)<span class="px-1 text-gray-400">…</span>@endif
                                    @endif

                                    @for($page = $start; $page <= $end; $page++)
                                        @if($page == $currentPage)
                                            <span class="px-3 py-2 text-sm font-semibold text-white bg-green-700 border border-green-700 rounded-md">{{ $page }}</span>
                                        @else
                                            <a href="{{ $berita->url($page) }}" class="px-3 py-2 text-sm bg-white border border-gray-200 rounded-md hover:border-green-600 hover:text-green-700">{{ $page }}</a>
                                        @endif
                                    @endfor

                                    @if($end < $lastPage)
                                        @if($end < $lastPage - 1)<span class="px-1 text-gray-400">…</span>@endif
                                        <a href="{{ $berita->url($lastPage) }}" class="px-3 py-2 text-sm bg-white border border-gray-200 rounded-md hover:border-green-600 hover:text-green-700">{{ $lastPage }}</a>
                                    @endif

                                    @if($berita->hasMorePages())
                                        <a href="{{ $berita->nextPageUrl() }}" class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-md hover:border-green-600 hover:text-green-700">Selanjutnya</a>
                                    @else
                                        <span class="px-3 py-2 text-sm text-gray-400 bg-white border border-gray-200 rounded-md cursor-not-allowed">Selanjutnya</span>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <aside class="lg:col-span-4 space-y-6">
                    {{-- Popular --}}
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                        <div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
                            <span class="w-1 h-4 bg-green-700 rounded-full"></span>
                            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Paling Dibaca</h2>
                        </div>
                        <ol class="divide-y divide-gray-100">
                            @forelse($beritaPopuler ?? [] as $index => $populer)
                                <li>
                                    <a href="{{ route('berita.show', $populer->slug) }}" class="flex gap-3 p-4 group hover:bg-gray-50 transition-colors">
                                        <span class="bp-rank inline-flex items-center justify-center rounded-md text-xs font-bold shrink-0 {{ $index < 3 ? 'bg-green-700 text-white' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $index + 1 }}
                                        </span>
                                        <div class="min-w-0">
                                            <h3 class="bp-title text-sm font-semibold text-gray-900 leading-snug line-clamp-2 transition-colors">
                                                {{ $populer->judul }}
                                            </h3>
                                            <p class="mt-1 text-[11px] text-gray-500">
                                                {{ number_format($populer->view_count ?? 0) }} pembaca
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="p-5 text-sm text-gray-500">Belum ada data popularitas.</li>
                            @endforelse
                        </ol>
                    </div>

                    {{-- Categories --}}
                    @if(isset($kategoris) && $kategoris->isNotEmpty())
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                            <div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
                                <span class="w-1 h-4 bg-green-700 rounded-full"></span>
                                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Kategori</h2>
                            </div>
                            <ul class="p-3">
                                @foreach($kategoris as $kategori)
                                    <li>
                                        <a href="{{ route('berita', ['kategori' => $kategori->nama]) }}"
                                           class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm hover:bg-green-50 transition-colors {{ request('kategori') == $kategori->nama ? 'bg-green-50 text-green-800 font-semibold' : 'text-gray-700' }}">
                                            <span>{{ $kategori->nama }}</span>
                                            <span class="text-xs text-gray-400 tabular-nums">{{ $kategori->berita_count }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Soft CTA --}}
                    <div class="rounded-xl overflow-hidden text-white p-5"
                         style="background: linear-gradient(135deg, var(--color-primary-dark, #006600), var(--color-primary, #008000));">
                        <h2 class="text-base font-bold mb-1">Ikuti update terbaru</h2>
                        <p class="text-sm text-white/85 mb-4 leading-relaxed">
                            Pantau kegiatan dan prestasi {{ $schoolName }} melalui kanal resmi kami.
                        </p>
                        <a href="{{ route('kontak') }}"
                           class="inline-flex items-center text-sm font-semibold bg-white text-green-800 px-3.5 py-2 rounded-lg hover:bg-green-50 transition-colors">
                            Hubungi kami
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </aside>
            </div>
        @endif
    </div>
</div>
@endsection
