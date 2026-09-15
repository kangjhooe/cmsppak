@extends('layouts.admin-simple')

@section('title', 'Manajemen Galeri - ' . $schoolName)

@section('content')
@php
    $hasFilters = request()->filled('search') || request()->filled('kategori') || request()->filled('status');
@endphp
<div class="bg-slate-50 pb-10">
    <!-- Banner: full width area konten (bukan viewport), tidak overlap sidebar -->
    <div class="w-full bg-gradient-to-r from-violet-600 via-purple-600 to-indigo-600 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.12] pointer-events-none" style="background-image: radial-gradient(circle at 20% 50%, #fff 0, transparent 45%), radial-gradient(circle at 80% 20%, #fff 0, transparent 35%);"></div>
        <div class="relative w-full px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 max-w-7xl mx-auto">
                <div>
                    <p class="text-violet-200 text-sm font-medium mb-2">Konten Website</p>
                    <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Manajemen Galeri</h1>
                    <p class="mt-2 text-violet-100/90 text-base max-w-xl">Kelola galeri kegiatan dengan foto dan video dalam satu tempat.</p>
                </div>
                <a href="{{ route('admin.galeri.create') }}"
                   class="inline-flex items-center justify-center gap-2 self-start md:self-auto px-5 py-2.5 rounded-xl bg-white text-violet-700 font-semibold text-sm shadow-lg shadow-violet-900/20 hover:bg-violet-50 transition-colors">
                    <i class="fas fa-plus"></i>
                    Tambah Galeri
                </a>
            </div>
        </div>
    </div>

    <!-- Konten di bawah banner (tanpa overlap) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-violet-200 transition-all duration-200">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-violet-100 flex items-center justify-center">
                    <i class="fas fa-images text-violet-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Total Galeri</p>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">{{ $stats['total'] }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-emerald-200 transition-all duration-200">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-emerald-100 flex items-center justify-center">
                    <i class="fas fa-check-circle text-emerald-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Aktif</p>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">{{ $stats['active'] }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-sky-200 transition-all duration-200">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-sky-100 flex items-center justify-center">
                    <i class="fas fa-folder-open text-sky-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Kategori</p>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">{{ $stats['kategori'] }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-amber-200 transition-all duration-200">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-amber-100 flex items-center justify-center">
                    <i class="fas fa-layer-group text-amber-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Total Media</p>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">{{ $stats['media'] }}</p>
                </div>
            </div>
        </div>

        <!-- Main panel -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="px-5 sm:px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">Daftar Galeri</h2>
                    <p class="text-sm text-slate-500 mt-0.5">{{ $galeri->total() }} galeri terdaftar</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mx-5 sm:mx-6 mt-5 flex items-center gap-3 rounded-xl bg-emerald-50 border border-emerald-100 px-4 py-3 text-emerald-800 text-sm">
                    <i class="fas fa-check-circle text-emerald-500"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-5 sm:p-6">
                <!-- Search toolbar -->
                <form method="GET" action="{{ route('admin.galeri.index') }}" class="mb-6">
                    <div class="flex flex-col gap-3">
                        <!-- Search row -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-slate-400"></i>
                            </div>
                            <input
                                type="text"
                                name="search"
                                id="search"
                                value="{{ request('search') }}"
                                placeholder="Cari judul, deskripsi, atau kategori galeri..."
                                class="w-full h-12 pl-11 {{ request('search') ? 'pr-11' : 'pr-4' }} rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder:text-slate-400
                                       focus:bg-white focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-400 transition-all"
                            >
                            @if(request('search'))
                                <a href="{{ route('admin.galeri.index', request()->except('search', 'page')) }}"
                                   class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600"
                                   title="Hapus pencarian">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>

                        <!-- Filters row -->
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-1 sm:max-w-[200px]">
                                <select name="kategori" id="kategori"
                                        class="w-full h-11 appearance-none pl-4 pr-10 rounded-xl border border-slate-200 bg-white text-sm text-slate-700
                                               focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-400 transition-all">
                                    <option value="">Semua Kategori</option>
                                    <option value="akademik" {{ request('kategori') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                    <option value="prestasi" {{ request('kategori') == 'prestasi' ? 'selected' : '' }}>Prestasi</option>
                                    <option value="acara" {{ request('kategori') == 'acara' ? 'selected' : '' }}>Acara</option>
                                    <option value="kegiatan" {{ request('kategori') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                    <option value="fasilitas" {{ request('kategori') == 'fasilitas' ? 'selected' : '' }}>Fasilitas</option>
                                    <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                            </div>

                            <div class="relative flex-1 sm:max-w-[180px]">
                                <select name="status" id="status"
                                        class="w-full h-11 appearance-none pl-4 pr-10 rounded-xl border border-slate-200 bg-white text-sm text-slate-700
                                               focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-400 transition-all">
                                    <option value="">Semua Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                            </div>

                            <div class="flex gap-2 sm:ml-auto">
                                <button type="submit"
                                        class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-xl bg-violet-600 text-white text-sm font-semibold
                                               hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2
                                               shadow-sm shadow-violet-600/25 transition-colors whitespace-nowrap">
                                    <i class="fas fa-sliders-h"></i>
                                    Filter
                                </button>
                                @if($hasFilters)
                                    <a href="{{ route('admin.galeri.index') }}"
                                       class="inline-flex items-center justify-center gap-2 h-11 px-4 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-semibold
                                              hover:bg-slate-50 hover:text-slate-800 transition-colors whitespace-nowrap">
                                        <i class="fas fa-undo text-xs"></i>
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($hasFilters)
                        <div class="mt-3 flex flex-wrap items-center gap-2">
                            <span class="text-xs text-slate-500">Filter:</span>
                            @if(request('search'))
                                <span class="inline-flex items-center gap-1.5 h-7 px-2.5 rounded-lg bg-violet-50 text-violet-700 text-xs font-medium border border-violet-100">
                                    “{{ Str::limit(request('search'), 24) }}”
                                </span>
                            @endif
                            @if(request('kategori'))
                                <span class="inline-flex items-center gap-1.5 h-7 px-2.5 rounded-lg bg-sky-50 text-sky-700 text-xs font-medium border border-sky-100">
                                    {{ ucfirst(request('kategori')) }}
                                </span>
                            @endif
                            @if(request('status'))
                                <span class="inline-flex items-center gap-1.5 h-7 px-2.5 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-medium border border-emerald-100">
                                    {{ ucfirst(request('status')) }}
                                </span>
                            @endif
                            <span class="text-xs text-slate-400 sm:ml-auto">{{ $galeri->total() }} hasil</span>
                        </div>
                    @endif
                </form>

                <!-- Table -->
                <div class="overflow-x-auto rounded-xl border border-slate-200">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50/80">
                            <tr>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider w-14">No</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Thumbnail</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Judul & Deskripsi</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Media</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @forelse($galeri as $item)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-sm font-semibold text-slate-600">
                                        {{ $galeri->firstItem() + $loop->index }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    @if($item->thumbnailItem && $item->thumbnailItem->jenis === 'foto' && $item->thumbnailItem->file_path)
                                        <img class="h-14 w-14 rounded-xl object-cover border border-slate-100 shadow-sm"
                                             src="{{ asset('storage/' . $item->thumbnailItem->file_path) }}"
                                             alt="{{ $item->judul }}">
                                    @elseif($item->thumbnailItem && $item->thumbnailItem->preview_url)
                                        <img class="h-14 w-14 rounded-xl object-cover border border-slate-100 shadow-sm"
                                             src="{{ $item->thumbnailItem->preview_url }}"
                                             alt="{{ $item->judul }}">
                                    @else
                                        <div class="h-14 w-14 bg-slate-100 rounded-xl flex items-center justify-center border border-slate-100">
                                            <i class="fas fa-images text-slate-400"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-4">
                                    <div class="min-w-0 max-w-xs">
                                        <p class="text-sm font-semibold text-slate-900 truncate">{{ $item->judul }}</p>
                                        <p class="text-sm text-slate-500 line-clamp-2">{{ Str::limit($item->deskripsi, 80) ?: 'Tidak ada deskripsi' }}</p>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if($item->kategori)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-sky-50 text-sky-700 border border-sky-100">
                                            {{ ucfirst($item->kategori) }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-50 text-slate-600 border border-slate-100">
                                            Umum
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-violet-50 text-violet-700 border border-violet-100">
                                        {{ $item->active_items_count }} item
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if($item->status == 'active')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium bg-slate-50 text-slate-600 border border-slate-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-slate-800">{{ $item->created_at->format('d-m-Y') }}</div>
                                    <div class="text-xs text-slate-500">{{ $item->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('galeri.show', $item->id) }}" target="_blank"
                                           class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sky-600 hover:bg-sky-50 transition-colors" title="Lihat Frontend">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                        <a href="{{ route('admin.galeri.edit', $item) }}"
                                           class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-violet-600 hover:bg-violet-50 transition-colors" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.galeri.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-rose-600 hover:bg-rose-50 transition-colors"
                                                    onclick="return confirm('Yakin ingin menghapus galeri ini? Semua media dalam galeri akan ikut terhapus.')"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-16 text-center">
                                    <div class="mx-auto w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                                        <i class="fas fa-images text-2xl text-slate-400"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-slate-900 mb-1">
                                        {{ $hasFilters ? 'Tidak ada galeri yang cocok' : 'Belum ada galeri' }}
                                    </h3>
                                    <p class="text-sm text-slate-500 mb-5">
                                        {{ $hasFilters ? 'Coba ubah kata kunci atau reset filter.' : 'Mulai dengan menambahkan galeri pertama.' }}
                                    </p>
                                    @if($hasFilters)
                                        <a href="{{ route('admin.galeri.index') }}"
                                           class="inline-flex items-center gap-2 h-10 px-4 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-semibold hover:bg-slate-50">
                                            <i class="fas fa-undo text-xs"></i> Reset Filter
                                        </a>
                                    @else
                                        <a href="{{ route('admin.galeri.create') }}"
                                           class="inline-flex items-center gap-2 h-10 px-5 rounded-xl bg-violet-600 text-white text-sm font-semibold hover:bg-violet-700">
                                            <i class="fas fa-plus"></i> Tambah Galeri
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($galeri->total() > 0)
                <div class="mt-5 pt-5 border-t border-slate-100">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <p class="text-sm text-slate-500">
                            Menampilkan
                            <span class="font-semibold text-slate-800">{{ $galeri->firstItem() ?? 0 }}</span>
                            –
                            <span class="font-semibold text-slate-800">{{ $galeri->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-semibold text-slate-800">{{ $galeri->total() }}</span>
                        </p>
                        <div class="galeri-pagination">
                            {{ $galeri->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Plain CSS — @apply in Blade tidak diproses Vite/CDN */
.galeri-pagination nav > div:first-child { display: none; }
.galeri-pagination p { display: none; }
.galeri-pagination nav { display: flex; justify-content: flex-end; }
.galeri-pagination span[aria-current="page"] span {
    background-color: #7c3aed !important;
    border-color: #7c3aed !important;
    color: #fff !important;
    border-radius: 0.5rem !important;
}
.galeri-pagination a span,
.galeri-pagination span[aria-disabled="true"] span {
    border-radius: 0.5rem !important;
    min-width: 2.25rem;
    justify-content: center;
}
.galeri-pagination a:hover span {
    background-color: #f5f3ff !important;
    color: #6d28d9 !important;
    border-color: #ddd6fe !important;
}
</style>
@endsection
