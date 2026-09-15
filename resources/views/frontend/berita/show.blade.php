@extends('layouts.frontend')

@section('title', $berita->judul . ' - ' . $schoolName)

@push('meta')
<meta name="description" content="{{ Str::limit(strip_tags($berita->ringkasan ?: $berita->konten), 160) }}">
<meta name="keywords" content="{{ $berita->hasKategori() ? $berita->kategori->first()->nama : 'berita' }}, {{ $schoolName }}, {{ $berita->judul }}">
<meta name="author" content="{{ $berita->user->name ?? $schoolName }}">
<meta name="robots" content="index, follow">
<meta property="og:type" content="article">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $berita->judul }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($berita->ringkasan ?: $berita->konten), 160) }}">
<meta property="og:image" content="{{ $berita->gambar_url }}">
<meta property="og:site_name" content="{{ $schoolName }}">
<meta property="article:published_time" content="{{ optional($berita->published_at)->toISOString() }}">
<meta property="article:author" content="{{ $berita->user->name ?? $schoolName }}">
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $berita->judul }}">
<meta property="twitter:description" content="{{ Str::limit(strip_tags($berita->ringkasan ?: $berita->konten), 160) }}">
<meta property="twitter:image" content="{{ $berita->gambar_url }}">
<link rel="canonical" href="{{ url()->current() }}">
@endpush

@push('styles')
<style>
    .berita-detail a:hover .bd-title {
        color: var(--color-primary, #008000);
    }

    .bd-thumb {
        width: 5.5rem;
        height: 4.25rem;
        flex-shrink: 0;
    }

    .bd-rank {
        width: 1.75rem;
        height: 1.75rem;
    }

    .bd-prose {
        color: #374151;
        font-size: 1.05rem;
        line-height: 1.8;
    }

    .bd-prose h1, .bd-prose h2, .bd-prose h3, .bd-prose h4 {
        color: #111827;
        font-weight: 700;
        margin-top: 1.75rem;
        margin-bottom: 0.75rem;
        line-height: 1.35;
    }

    .bd-prose h1 { font-size: 1.6rem; }
    .bd-prose h2 { font-size: 1.35rem; }
    .bd-prose h3 { font-size: 1.15rem; }

    .bd-prose p { margin-bottom: 1.15rem; }

    .bd-prose ul, .bd-prose ol {
        margin: 0 0 1.15rem 1.25rem;
    }

    .bd-prose li { margin-bottom: 0.4rem; }

    .bd-prose a {
        color: var(--color-primary, #008000);
        text-decoration: underline;
    }

    .bd-prose img {
        border-radius: 0.75rem;
        margin: 1.25rem 0;
        max-width: 100%;
        height: auto;
    }

    .bd-prose blockquote {
        border-left: 4px solid var(--color-primary, #008000);
        background: #f0fdf4;
        padding: 0.9rem 1rem;
        margin: 1.25rem 0;
        color: #4b5563;
        border-radius: 0 0.5rem 0.5rem 0;
    }

    .bd-cover {
        aspect-ratio: 16 / 9;
        max-height: 28rem;
    }
</style>
@endpush

@section('content')
@php
    $approvedComments = $berita->comments->where('status', 'approved');
@endphp

<div class="berita-detail bg-gray-50 min-h-screen">
    {{-- Top bar --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex flex-wrap items-center gap-2 text-sm text-gray-500" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-green-700 transition-colors">Beranda</a>
                <i class="fas fa-chevron-right text-[10px] text-gray-400"></i>
                <a href="{{ route('berita') }}" class="hover:text-green-700 transition-colors">Berita</a>
                <i class="fas fa-chevron-right text-[10px] text-gray-400"></i>
                <span class="text-gray-900 font-medium line-clamp-1">{{ Str::limit($berita->judul, 60) }}</span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            {{-- Main article --}}
            <div class="lg:col-span-8 space-y-6">
                <article class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                    <header class="px-5 sm:px-8 pt-6 sm:pt-8 pb-4">
                        @if($berita->hasKategori())
                            <div class="flex flex-wrap gap-2 mb-3">
                                @foreach($berita->kategori as $kat)
                                    <a href="{{ route('berita', ['kategori' => $kat->nama]) }}"
                                       class="text-xs font-bold uppercase tracking-wide text-green-700 hover:underline">
                                        {{ $kat->nama }}
                                    </a>
                                    @if(!$loop->last)<span class="text-gray-300">·</span>@endif
                                @endforeach
                            </div>
                        @endif

                        <h1 class="text-2xl sm:text-3xl lg:text-[2rem] font-bold text-gray-900 leading-snug tracking-tight">
                            {{ $berita->judul }}
                        </h1>

                        <div class="mt-4 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-gray-500">
                            <span class="font-medium text-gray-700">{{ $berita->user->name ?? 'Admin' }}</span>
                            <span>&middot;</span>
                            <time datetime="{{ optional($berita->published_at)->toDateString() }}">
                                {{ optional($berita->published_at)->translatedFormat('d M Y, H:i') ?? $berita->created_at->translatedFormat('d M Y') }} WIB
                            </time>
                            <span>&middot;</span>
                            <span>{{ number_format($berita->view_count ?? 0) }} dibaca</span>
                            <span>&middot;</span>
                            <span>{{ $berita->reading_time }} menit baca</span>
                        </div>
                    </header>

                    @if($berita->gambar_utama)
                        <figure class="bd-cover overflow-hidden bg-gray-100 mx-0 sm:mx-8 sm:rounded-lg">
                            <img src="{{ $berita->gambar_url }}"
                                 alt="{{ $berita->judul }}"
                                 class="w-full h-full object-cover"
                                 loading="eager">
                        </figure>
                    @endif

                    <div class="px-5 sm:px-8 py-6 sm:py-8">
                        @if(!empty($berita->ringkasan))
                            <p class="text-base sm:text-lg text-gray-700 font-medium leading-relaxed mb-6 pb-6 border-b border-gray-100">
                                {{ $berita->ringkasan }}
                            </p>
                        @endif

                        <div class="bd-prose">
                            {!! $berita->konten !!}
                        </div>
                    </div>

                    {{-- Share --}}
                    <div class="px-5 sm:px-8 py-5 border-t border-gray-100 bg-gray-50/70">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Bagikan artikel</p>
                                <p class="text-xs text-gray-500 mt-0.5">Sebarkan informasi ini ke orang lain</p>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                   target="_blank" rel="noopener"
                                   class="inline-flex items-center px-3.5 py-2 text-sm font-medium text-white bg-[#1877F2] hover:bg-[#166fe5] rounded-lg transition-colors">
                                    <i class="fab fa-facebook-f mr-2"></i>Facebook
                                </a>
                                <a href="https://x.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul) }}"
                                   target="_blank" rel="noopener"
                                   class="inline-flex items-center px-3.5 py-2 text-sm font-medium text-white bg-black hover:bg-gray-800 rounded-lg transition-colors">
                                    <i class="fab fa-x-twitter mr-2"></i>X
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . url()->current()) }}"
                                   target="_blank" rel="noopener"
                                   class="inline-flex items-center px-3.5 py-2 text-sm font-medium text-white bg-[#25D366] hover:bg-[#1ebe57] rounded-lg transition-colors">
                                    <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                {{-- Comments --}}
                <section class="bg-white border border-gray-200 rounded-xl overflow-hidden" id="komentar">
                    <div class="px-5 sm:px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-1 h-4 bg-green-700 rounded-full"></span>
                        <h2 class="text-base font-bold text-gray-900">
                            Komentar
                            <span class="text-gray-400 font-medium">({{ $approvedComments->count() }})</span>
                        </h2>
                    </div>

                    <div class="p-5 sm:p-6">
                        <form action="{{ route('comments.store') }}" method="POST" id="comment-form" class="mb-8">
                            @csrf
                            <input type="hidden" name="berita_id" value="{{ $berita->id }}">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                                <div>
                                    <label for="nama" class="block text-xs font-semibold text-gray-700 mb-1.5">Nama</label>
                                    <input type="text" id="nama" name="nama" required
                                           class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none">
                                </div>
                                <div>
                                    <label for="email" class="block text-xs font-semibold text-gray-700 mb-1.5">Email</label>
                                    <input type="email" id="email" name="email" required
                                           class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="komentar" class="block text-xs font-semibold text-gray-700 mb-1.5">Komentar</label>
                                <textarea id="komentar" name="komentar" rows="4" required
                                          placeholder="Tulis komentar Anda..."
                                          class="w-full px-3.5 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none resize-y"></textarea>
                            </div>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2.5 text-sm font-semibold text-white bg-green-700 hover:bg-green-800 rounded-lg transition-colors">
                                <i class="fas fa-paper-plane mr-2 text-xs"></i>
                                Kirim Komentar
                            </button>
                        </form>

                        <div id="comments-list" class="space-y-4">
                            @forelse($approvedComments as $comment)
                                <div class="flex gap-3 p-4 rounded-lg border border-gray-100 bg-gray-50/50">
                                    <div class="w-10 h-10 rounded-full bg-green-700 text-white flex items-center justify-center text-sm font-bold shrink-0">
                                        {{ strtoupper(substr($comment->nama, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex flex-wrap items-center gap-x-2 gap-y-0.5 mb-1">
                                            <h3 class="text-sm font-semibold text-gray-900">{{ $comment->nama }}</h3>
                                            <span class="text-xs text-gray-400">
                                                {{ $comment->created_at->translatedFormat('d M Y, H:i') }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-700 leading-relaxed">{{ $comment->komentar }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10">
                                    <i class="fas fa-comment-slash text-2xl text-gray-300 mb-3"></i>
                                    <p class="text-sm font-medium text-gray-900">Belum ada komentar</p>
                                    <p class="text-xs text-gray-500 mt-1">Jadilah yang pertama berkomentar.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </section>
            </div>

            {{-- Sidebar --}}
            <aside class="lg:col-span-4 space-y-6">
                @if(isset($beritaTerbaru) && $beritaTerbaru->isNotEmpty())
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                        <div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
                            <span class="w-1 h-4 bg-green-700 rounded-full"></span>
                            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Berita Lainnya</h2>
                        </div>
                        <div class="divide-y divide-gray-100">
                            @foreach($beritaTerbaru as $related)
                                <a href="{{ route('berita.show', $related->slug) }}" class="flex gap-3 p-4 group hover:bg-gray-50 transition-colors">
                                    <div class="bd-thumb overflow-hidden rounded-lg bg-gray-100">
                                        <img src="{{ $related->gambar_url }}"
                                             alt="{{ $related->judul }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                             loading="lazy">
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="bd-title text-sm font-semibold text-gray-900 leading-snug line-clamp-2 transition-colors">
                                            {{ $related->judul }}
                                        </h3>
                                        <time class="mt-1 block text-[11px] text-gray-500"
                                              datetime="{{ optional($related->published_at)->toDateString() }}">
                                            {{ optional($related->published_at)->translatedFormat('d M Y') }}
                                        </time>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($beritaPopuler) && $beritaPopuler->isNotEmpty())
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                        <div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
                            <span class="w-1 h-4 bg-green-700 rounded-full"></span>
                            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Paling Dibaca</h2>
                        </div>
                        <ol class="divide-y divide-gray-100">
                            @foreach($beritaPopuler->take(5) as $index => $populer)
                                <li>
                                    <a href="{{ route('berita.show', $populer->slug) }}"
                                       class="flex gap-3 p-4 group hover:bg-gray-50 transition-colors {{ $populer->id === $berita->id ? 'bg-green-50/60' : '' }}">
                                        <span class="bd-rank inline-flex items-center justify-center rounded-md text-xs font-bold shrink-0 {{ $index < 3 ? 'bg-green-700 text-white' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $index + 1 }}
                                        </span>
                                        <div class="min-w-0">
                                            <h3 class="bd-title text-sm font-semibold text-gray-900 leading-snug line-clamp-2 transition-colors">
                                                {{ $populer->judul }}
                                            </h3>
                                            <p class="mt-1 text-[11px] text-gray-500">
                                                {{ number_format($populer->view_count ?? 0) }} pembaca
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                @endif

                @if(isset($kategorisPopuler) && $kategorisPopuler->isNotEmpty())
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                        <div class="px-5 py-3.5 border-b border-gray-100 flex items-center gap-2">
                            <span class="w-1 h-4 bg-green-700 rounded-full"></span>
                            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Kategori</h2>
                        </div>
                        <ul class="p-3">
                            @foreach($kategorisPopuler as $kategori)
                                <li>
                                    <a href="{{ route('berita', ['kategori' => $kategori->nama]) }}"
                                       class="flex items-center justify-between px-3 py-2.5 rounded-lg text-sm hover:bg-green-50 transition-colors text-gray-700">
                                        <span class="flex items-center gap-2">
                                            @if($kategori->warna)
                                                <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background-color: {{ $kategori->warna }}"></span>
                                            @endif
                                            {{ $kategori->nama }}
                                        </span>
                                        <span class="text-xs text-gray-400 tabular-nums">{{ $kategori->berita_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <a href="{{ route('berita') }}"
                   class="flex items-center justify-center gap-2 w-full px-4 py-3 text-sm font-semibold text-green-800 bg-white border border-gray-200 rounded-xl hover:border-green-600 hover:bg-green-50 transition-colors">
                    <i class="fas fa-arrow-left text-xs"></i>
                    Kembali ke daftar berita
                </a>
            </aside>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const commentForm = document.getElementById('comment-form');
    if (!commentForm) return;

    const submitButton = commentForm.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;

    commentForm.addEventListener('submit', function (e) {
        e.preventDefault();

        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';

        commentForm.querySelectorAll('.comment-alert').forEach(el => el.remove());

        fetch(commentForm.action, {
            method: 'POST',
            body: new FormData(commentForm),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message || 'Komentar berhasil dikirim.');
                commentForm.reset();
                setTimeout(() => location.reload(), 1500);
            } else {
                let message = data.message || 'Terjadi kesalahan saat mengirim komentar.';
                if (data.errors) {
                    message = Object.values(data.errors).flat().join(' ');
                }
                showAlert('error', message);
            }
        })
        .catch(() => {
            showAlert('error', 'Terjadi kesalahan saat mengirim komentar. Silakan coba lagi.');
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = originalButtonText;
        });
    });

    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `comment-alert mb-4 p-3.5 rounded-lg text-sm ${type === 'success' ? 'bg-green-50 border border-green-200 text-green-800' : 'bg-red-50 border border-red-200 text-red-800'}`;
        alertDiv.innerHTML = `
            <div class="flex items-start gap-3">
                <i class="fas ${type === 'success' ? 'fa-check-circle text-green-600' : 'fa-exclamation-triangle text-red-500'} mt-0.5"></i>
                <p class="flex-1 font-medium">${message}</p>
                <button type="button" onclick="this.closest('.comment-alert').remove()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        commentForm.insertBefore(alertDiv, commentForm.firstChild);
    }
});
</script>
@endpush
