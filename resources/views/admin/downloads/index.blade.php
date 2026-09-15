@extends('layouts.admin-simple')

@section('title', 'Kelola Downloads - Admin Panel')

@section('content')
@php
    $hasFilters = request()->filled('search') || request()->filled('kategori') || request()->filled('status') || request()->filled('tipe');
@endphp
<div class="bg-slate-50 pb-10">
    <!-- Banner: ikuti gradasi agenda (purple → pink → red) -->
    <div class="w-full bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.12] pointer-events-none" style="background-image: radial-gradient(circle at 20% 50%, #fff 0, transparent 45%), radial-gradient(circle at 80% 20%, #fff 0, transparent 35%);"></div>
        <div class="relative w-full px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 max-w-7xl mx-auto">
                <div>
                    <p class="text-purple-100 text-sm font-medium mb-2">Konten Website</p>
                    <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Manajemen Downloads</h1>
                    <p class="mt-2 text-purple-50/90 text-base max-w-xl">Kelola file yang dapat diunduh pengunjung website.</p>
                </div>
                <a href="{{ route('admin.downloads.create') }}"
                   class="inline-flex items-center justify-center gap-2 self-start md:self-auto px-5 py-2.5 rounded-xl bg-white text-purple-700 font-semibold text-sm shadow-lg shadow-purple-900/20 hover:bg-purple-50 transition-colors">
                    <i class="fas fa-plus"></i>
                    Tambah File
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-purple-200 transition-all duration-200">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-download text-purple-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Total File</p>
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

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-rose-200 transition-all duration-200">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-rose-100 flex items-center justify-center">
                    <i class="fas fa-times-circle text-rose-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Nonaktif</p>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">{{ $stats['inactive'] }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-sky-200 transition-all duration-200">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-sky-100 flex items-center justify-center">
                    <i class="fas fa-file-pdf text-sky-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">PDF</p>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">{{ $stats['pdf'] }}</p>
                </div>
            </div>
        </div>

        <!-- Main panel -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="px-5 sm:px-6 py-5 border-b border-slate-100">
                <h2 class="text-lg font-semibold text-slate-900">Daftar File Download</h2>
                <p class="text-sm text-slate-500 mt-0.5">{{ $downloads->total() }} file terdaftar</p>
            </div>

            @if(session('success'))
                <div class="mx-5 sm:mx-6 mt-5 flex items-center gap-3 rounded-xl bg-emerald-50 border border-emerald-100 px-4 py-3 text-emerald-800 text-sm">
                    <i class="fas fa-check-circle text-emerald-500"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-5 sm:p-6">
                <!-- Search toolbar -->
                <form method="GET" action="{{ route('admin.downloads.index') }}" class="mb-6">
                    <div class="flex flex-col gap-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-slate-400"></i>
                            </div>
                            <input
                                type="text"
                                name="search"
                                id="search"
                                value="{{ request('search') }}"
                                placeholder="Cari judul, nama file, deskripsi, atau kategori..."
                                class="w-full h-12 pl-11 {{ request('search') ? 'pr-11' : 'pr-4' }} rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder:text-slate-400
                                       focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-400 transition-all"
                            >
                            @if(request('search'))
                                <a href="{{ route('admin.downloads.index', request()->except('search', 'page')) }}"
                                   class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600"
                                   title="Hapus pencarian">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-1 sm:max-w-[180px]">
                                <select name="kategori" id="kategori"
                                        class="w-full h-11 appearance-none pl-4 pr-10 rounded-xl border border-slate-200 bg-white text-sm text-slate-700
                                               focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-400 transition-all">
                                    <option value="">Semua Kategori</option>
                                    <option value="silabus" {{ request('kategori') == 'silabus' ? 'selected' : '' }}>Silabus</option>
                                    <option value="kurikulum" {{ request('kategori') == 'kurikulum' ? 'selected' : '' }}>Kurikulum</option>
                                    <option value="dokumen" {{ request('kategori') == 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                                    <option value="formulir" {{ request('kategori') == 'formulir' ? 'selected' : '' }}>Formulir</option>
                                    <option value="brosur" {{ request('kategori') == 'brosur' ? 'selected' : '' }}>Brosur</option>
                                    <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                            </div>

                            <div class="relative flex-1 sm:max-w-[160px]">
                                <select name="status" id="status"
                                        class="w-full h-11 appearance-none pl-4 pr-10 rounded-xl border border-slate-200 bg-white text-sm text-slate-700
                                               focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-400 transition-all">
                                    <option value="">Semua Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                            </div>

                            <div class="relative flex-1 sm:max-w-[140px]">
                                <select name="tipe" id="tipe"
                                        class="w-full h-11 appearance-none pl-4 pr-10 rounded-xl border border-slate-200 bg-white text-sm text-slate-700
                                               focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-400 transition-all">
                                    <option value="">Semua Tipe</option>
                                    <option value="pdf" {{ request('tipe') == 'pdf' ? 'selected' : '' }}>PDF</option>
                                    <option value="doc" {{ request('tipe') == 'doc' ? 'selected' : '' }}>DOC</option>
                                    <option value="docx" {{ request('tipe') == 'docx' ? 'selected' : '' }}>DOCX</option>
                                    <option value="xls" {{ request('tipe') == 'xls' ? 'selected' : '' }}>XLS</option>
                                    <option value="xlsx" {{ request('tipe') == 'xlsx' ? 'selected' : '' }}>XLSX</option>
                                    <option value="ppt" {{ request('tipe') == 'ppt' ? 'selected' : '' }}>PPT</option>
                                    <option value="pptx" {{ request('tipe') == 'pptx' ? 'selected' : '' }}>PPTX</option>
                                    <option value="zip" {{ request('tipe') == 'zip' ? 'selected' : '' }}>ZIP</option>
                                    <option value="rar" {{ request('tipe') == 'rar' ? 'selected' : '' }}>RAR</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                            </div>

                            <div class="flex gap-2 sm:ml-auto">
                                <button type="submit"
                                        class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-xl bg-purple-600 text-white text-sm font-semibold
                                               hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2
                                               shadow-sm shadow-purple-600/25 transition-colors whitespace-nowrap">
                                    <i class="fas fa-sliders-h"></i>
                                    Filter
                                </button>
                                @if($hasFilters)
                                    <a href="{{ route('admin.downloads.index') }}"
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
                                <span class="inline-flex items-center gap-1.5 h-7 px-2.5 rounded-lg bg-purple-50 text-purple-700 text-xs font-medium border border-purple-100">
                                    “{{ Str::limit(request('search'), 24) }}”
                                </span>
                            @endif
                            @if(request('kategori'))
                                <span class="inline-flex items-center gap-1.5 h-7 px-2.5 rounded-lg bg-pink-50 text-pink-700 text-xs font-medium border border-pink-100">
                                    {{ ucfirst(request('kategori')) }}
                                </span>
                            @endif
                            @if(request('status'))
                                <span class="inline-flex items-center gap-1.5 h-7 px-2.5 rounded-lg bg-sky-50 text-sky-700 text-xs font-medium border border-sky-100">
                                    {{ request('status') === 'active' ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            @endif
                            @if(request('tipe'))
                                <span class="inline-flex items-center gap-1.5 h-7 px-2.5 rounded-lg bg-amber-50 text-amber-700 text-xs font-medium border border-amber-100">
                                    {{ strtoupper(request('tipe')) }}
                                </span>
                            @endif
                            <span class="text-xs text-slate-400 sm:ml-auto">{{ $downloads->total() }} hasil</span>
                        </div>
                    @endif
                </form>

                <!-- Table -->
                <div class="overflow-x-auto rounded-xl border border-slate-200">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50/80">
                            <tr>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider w-14">No</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">File</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Ukuran</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Download</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @forelse($downloads as $download)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-sm font-semibold text-slate-600">
                                        {{ $downloads->firstItem() + $loop->index }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3 min-w-0 max-w-sm">
                                        @if($download->tipe_file == 'pdf')
                                            <div class="h-11 w-11 bg-rose-50 rounded-xl flex items-center justify-center border border-rose-100 shrink-0">
                                                <i class="fas fa-file-pdf text-rose-500"></i>
                                            </div>
                                        @elseif(in_array($download->tipe_file, ['doc', 'docx']))
                                            <div class="h-11 w-11 bg-sky-50 rounded-xl flex items-center justify-center border border-sky-100 shrink-0">
                                                <i class="fas fa-file-word text-sky-500"></i>
                                            </div>
                                        @elseif(in_array($download->tipe_file, ['xls', 'xlsx']))
                                            <div class="h-11 w-11 bg-emerald-50 rounded-xl flex items-center justify-center border border-emerald-100 shrink-0">
                                                <i class="fas fa-file-excel text-emerald-500"></i>
                                            </div>
                                        @elseif(in_array($download->tipe_file, ['ppt', 'pptx']))
                                            <div class="h-11 w-11 bg-amber-50 rounded-xl flex items-center justify-center border border-amber-100 shrink-0">
                                                <i class="fas fa-file-powerpoint text-amber-500"></i>
                                            </div>
                                        @else
                                            <div class="h-11 w-11 bg-slate-50 rounded-xl flex items-center justify-center border border-slate-100 shrink-0">
                                                <i class="fas fa-file text-slate-500"></i>
                                            </div>
                                        @endif
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-slate-900 truncate">{{ $download->judul }}</p>
                                            <p class="text-sm text-slate-500 truncate">{{ $download->nama_file }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-sky-50 text-sky-700 border border-sky-100">
                                        {{ ucfirst($download->kategori) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-slate-700">{{ $download->ukuran_file_formatted }}</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-700">
                                        <i class="fas fa-download text-purple-400 text-xs"></i>
                                        {{ number_format($download->jumlah_download) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.downloads.toggle-status', $download) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium border transition-colors
                                                    {{ $download->is_active
                                                        ? 'bg-emerald-50 text-emerald-700 border-emerald-100 hover:bg-emerald-100'
                                                        : 'bg-rose-50 text-rose-700 border-rose-100 hover:bg-rose-100' }}"
                                                title="Klik untuk ubah status">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $download->is_active ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                            {{ $download->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('admin.downloads.edit', $download) }}"
                                           class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-purple-600 hover:bg-purple-50 transition-colors" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.downloads.destroy', $download) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-rose-600 hover:bg-rose-50 transition-colors"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="mx-auto w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                                        <i class="fas fa-file-download text-2xl text-slate-400"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-slate-900 mb-1">
                                        {{ $hasFilters ? 'Tidak ada file yang cocok' : 'Belum ada file download' }}
                                    </h3>
                                    <p class="text-sm text-slate-500 mb-5">
                                        {{ $hasFilters ? 'Coba ubah kata kunci atau reset filter.' : 'Mulai dengan menambahkan file pertama.' }}
                                    </p>
                                    @if($hasFilters)
                                        <a href="{{ route('admin.downloads.index') }}"
                                           class="inline-flex items-center gap-2 h-10 px-4 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-semibold hover:bg-slate-50">
                                            <i class="fas fa-undo text-xs"></i> Reset Filter
                                        </a>
                                    @else
                                        <a href="{{ route('admin.downloads.create') }}"
                                           class="inline-flex items-center gap-2 h-10 px-5 rounded-xl bg-purple-600 text-white text-sm font-semibold hover:bg-purple-700">
                                            <i class="fas fa-plus"></i> Tambah File
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($downloads->total() > 0)
                <div class="mt-5 pt-5 border-t border-slate-100">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <p class="text-sm text-slate-500">
                            Menampilkan
                            <span class="font-semibold text-slate-800">{{ $downloads->firstItem() ?? 0 }}</span>
                            –
                            <span class="font-semibold text-slate-800">{{ $downloads->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-semibold text-slate-800">{{ $downloads->total() }}</span>
                        </p>
                        <div class="admin-list-pagination">
                            {{ $downloads->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.admin-list-pagination nav > div:first-child { display: none; }
.admin-list-pagination p { display: none; }
.admin-list-pagination nav { display: flex; justify-content: flex-end; }
.admin-list-pagination span[aria-current="page"] span {
    background-color: #9333ea !important;
    border-color: #9333ea !important;
    color: #fff !important;
    border-radius: 0.5rem !important;
}
.admin-list-pagination a span,
.admin-list-pagination span[aria-disabled="true"] span {
    border-radius: 0.5rem !important;
    min-width: 2.25rem;
    justify-content: center;
}
.admin-list-pagination a:hover span {
    background-color: #faf5ff !important;
    color: #7e22ce !important;
    border-color: #e9d5ff !important;
}
</style>
@endsection
