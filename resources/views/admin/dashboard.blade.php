@extends('layouts.admin-simple')

@section('title', 'Dashboard Admin - ' . $schoolName)

@section('content')
<div class="min-h-screen bg-slate-50">
    <div class="bg-gradient-to-r from-green-700 to-green-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-white">Dashboard</h1>
                    <p class="text-green-100 mt-1">
                        Selamat datang, <span class="font-semibold text-white">{{ Auth::user()->name }}</span>
                        · {{ now()->translatedFormat('l, d F Y') }}
                    </p>
                </div>
                <div class="text-green-100 text-sm">
                    <span id="current-time" class="font-semibold text-white text-lg">{{ now()->format('H:i') }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
        {{-- Stats --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl border border-gray-100 p-4">
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Berita</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $data['total_berita'] ?? 0 }}</p>
                <p class="text-xs text-green-700 mt-1">{{ $data['berita_published'] ?? 0 }} terbit · {{ $data['berita_draft'] ?? 0 }} draft</p>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-4">
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Agenda</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $data['total_agenda'] ?? 0 }}</p>
                <p class="text-xs text-green-700 mt-1">{{ $data['agenda_upcoming'] ?? 0 }} akan datang</p>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-4">
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Galeri</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $data['galeri_foto'] ?? 0 }}</p>
                <p class="text-xs text-green-700 mt-1">foto aktif</p>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-4">
                <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Unduhan</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $data['total_downloads'] ?? 0 }}</p>
                <p class="text-xs text-green-700 mt-1">{{ $data['downloads_bulan_ini'] ?? 0 }} diunggah bulan ini</p>
            </div>
        </div>

        {{-- Attention widgets --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.buku-tamu.index') }}" class="bg-white rounded-xl border border-gray-100 p-4 hover:border-green-300 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Buku Tamu belum dibaca</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $data['pesan_baru'] ?? 0 }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.comments.index', ['status' => 'pending']) }}" class="bg-white rounded-xl border border-gray-100 p-4 hover:border-green-300 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Komentar menunggu</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $data['komentar_pending'] ?? 0 }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-orange-100 text-orange-700 flex items-center justify-center">
                        <i class="fas fa-comments"></i>
                    </div>
                </div>
            </a>
            <a href="{{ route('admin.berita.index') }}" class="bg-white rounded-xl border border-gray-100 p-4 hover:border-green-300 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Berita draft</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $data['berita_draft'] ?? 0 }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-green-100 text-green-700 flex items-center justify-center">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
            </a>
        </div>

        {{-- Quick actions --}}
        <div>
            <h2 class="text-sm font-semibold text-gray-700 mb-3">Aksi cepat</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
                <a href="{{ route('admin.berita.create') }}" class="flex items-center gap-3 bg-white border border-gray-100 rounded-xl px-4 py-3 hover:border-green-300 transition-colors">
                    <span class="w-9 h-9 rounded-lg bg-green-700 text-white flex items-center justify-center"><i class="fas fa-plus text-sm"></i></span>
                    <span class="text-sm font-medium text-gray-900">Tulis Berita</span>
                </a>
                <a href="{{ route('admin.agenda.create') }}" class="flex items-center gap-3 bg-white border border-gray-100 rounded-xl px-4 py-3 hover:border-green-300 transition-colors">
                    <span class="w-9 h-9 rounded-lg bg-green-700 text-white flex items-center justify-center"><i class="fas fa-calendar-plus text-sm"></i></span>
                    <span class="text-sm font-medium text-gray-900">Tambah Agenda</span>
                </a>
                <a href="{{ route('admin.galeri.create') }}" class="flex items-center gap-3 bg-white border border-gray-100 rounded-xl px-4 py-3 hover:border-green-300 transition-colors">
                    <span class="w-9 h-9 rounded-lg bg-green-700 text-white flex items-center justify-center"><i class="fas fa-image text-sm"></i></span>
                    <span class="text-sm font-medium text-gray-900">Upload Galeri</span>
                </a>
                <a href="{{ route('admin.downloads.create') }}" class="flex items-center gap-3 bg-white border border-gray-100 rounded-xl px-4 py-3 hover:border-green-300 transition-colors">
                    <span class="w-9 h-9 rounded-lg bg-green-700 text-white flex items-center justify-center"><i class="fas fa-download text-sm"></i></span>
                    <span class="text-sm font-medium text-gray-900">Tambah Unduhan</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Recent berita --}}
            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-gray-900">Berita terbaru</h3>
                    <a href="{{ route('admin.berita.index') }}" class="text-xs text-green-700 hover:underline">Kelola</a>
                </div>
                <div class="divide-y divide-gray-50">
                    @forelse(($data['berita_terbaru'] ?? collect()) as $item)
                        <a href="{{ route('admin.berita.edit', $item) }}" class="block px-4 py-3 hover:bg-gray-50">
                            <p class="text-sm font-medium text-gray-900 line-clamp-1">{{ $item->judul }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">
                                {{ $item->created_at?->diffForHumans() }}
                                · <span class="capitalize">{{ $item->status }}</span>
                            </p>
                        </a>
                    @empty
                        <p class="px-4 py-8 text-sm text-gray-500 text-center">Belum ada berita</p>
                    @endforelse
                </div>
            </div>

            {{-- Upcoming agenda / pesan --}}
            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-sm font-semibold text-gray-900">Agenda terdekat</h3>
                    <a href="{{ route('admin.agenda.index') }}" class="text-xs text-green-700 hover:underline">Kelola</a>
                </div>
                <div class="divide-y divide-gray-50">
                    @forelse(($data['agenda_terdekat'] ?? collect()) as $event)
                        <a href="{{ route('admin.agenda.edit', $event) }}" class="flex gap-3 px-4 py-3 hover:bg-gray-50">
                            <div class="shrink-0 w-12 text-center rounded-lg bg-green-50 text-green-800 py-1">
                                <div class="text-sm font-bold leading-none">{{ $event->tanggal_mulai?->format('d') ?? '--' }}</div>
                                <div class="text-[10px] uppercase">{{ $event->tanggal_mulai?->format('M') ?? '' }}</div>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-900 line-clamp-1">{{ $event->judul }}</p>
                                <p class="text-xs text-gray-500 mt-0.5 line-clamp-1">{{ $event->lokasi ?? 'Lokasi belum diatur' }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="px-4 py-8 text-sm text-gray-500 text-center">Tidak ada agenda mendatang</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Buku tamu terbaru --}}
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-900">Pesan buku tamu terbaru</h3>
                <a href="{{ route('admin.buku-tamu.index') }}" class="text-xs text-green-700 hover:underline">Lihat semua</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse(($data['pesan_terbaru'] ?? collect()) as $pesan)
                    <a href="{{ route('admin.buku-tamu.show', $pesan) }}" class="block px-4 py-3 hover:bg-gray-50">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="text-sm font-medium text-gray-900">{{ $pesan->nama ?? 'Tamu' }}</p>
                                <p class="text-xs text-gray-500 mt-0.5 line-clamp-1">{{ Str::limit(strip_tags($pesan->pesan ?? ''), 80) }}</p>
                            </div>
                            <span class="shrink-0 text-[10px] uppercase tracking-wide px-2 py-0.5 rounded-full
                                {{ ($pesan->status ?? '') === 'unread' ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-600' }}">
                                {{ $pesan->status ?? '-' }}
                            </span>
                        </div>
                    </a>
                @empty
                    <p class="px-4 py-8 text-sm text-gray-500 text-center">Belum ada pesan</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    function updateTime() {
        const el = document.getElementById('current-time');
        if (el) {
            el.textContent = new Date().toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });
        }
    }
    setInterval(updateTime, 60000);
    updateTime();
</script>
@endsection
