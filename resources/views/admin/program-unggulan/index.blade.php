@extends('layouts.admin-simple')

@section('title', 'Manajemen Program Unggulan - ' . $schoolName)

@section('content')
@php
    $hasFilters = request()->filled('search') || request()->filled('status');
    $warnaIcon = [
        'green' => 'bg-emerald-100 text-emerald-600',
        'blue' => 'bg-sky-100 text-sky-600',
        'orange' => 'bg-orange-100 text-orange-600',
        'purple' => 'bg-purple-100 text-purple-600',
        'red' => 'bg-rose-100 text-rose-600',
        'yellow' => 'bg-amber-100 text-amber-600',
    ];
    $warnaBadge = [
        'green' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
        'blue' => 'bg-sky-50 text-sky-700 border-sky-100',
        'orange' => 'bg-orange-50 text-orange-700 border-orange-100',
        'purple' => 'bg-purple-50 text-purple-700 border-purple-100',
        'red' => 'bg-rose-50 text-rose-700 border-rose-100',
        'yellow' => 'bg-amber-50 text-amber-700 border-amber-100',
    ];
@endphp
<div class="bg-slate-50 pb-10">
    <!-- Banner: pertahankan gradasi green → emerald → teal -->
    <div class="w-full bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.12] pointer-events-none" style="background-image: radial-gradient(circle at 20% 50%, #fff 0, transparent 45%), radial-gradient(circle at 80% 20%, #fff 0, transparent 35%);"></div>
        <div class="relative w-full px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 max-w-7xl mx-auto">
                <div>
                    <p class="text-emerald-100 text-sm font-medium mb-2">Konten Website</p>
                    <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Manajemen Program Unggulan</h1>
                    <p class="mt-2 text-emerald-50/90 text-base max-w-xl">Kelola program unggulan yang ditampilkan di halaman beranda.</p>
                </div>
                <a href="{{ route('admin.program-unggulan.create') }}"
                   class="inline-flex items-center justify-center gap-2 self-start md:self-auto px-5 py-2.5 rounded-xl bg-white text-emerald-700 font-semibold text-sm shadow-lg shadow-emerald-900/20 hover:bg-emerald-50 transition-colors">
                    <i class="fas fa-plus"></i>
                    Tambah Program
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 mb-6">
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-emerald-200 transition-all duration-200">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-emerald-100 flex items-center justify-center">
                    <i class="fas fa-star text-emerald-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Total Program</p>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">{{ $stats['total'] }}</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-sky-200 transition-all duration-200">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-sky-100 flex items-center justify-center">
                    <i class="fas fa-check-circle text-sky-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Aktif</p>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">{{ $stats['aktif'] }}</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-rose-200 transition-all duration-200 col-span-2 lg:col-span-1">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-rose-100 flex items-center justify-center">
                    <i class="fas fa-times-circle text-rose-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Nonaktif</p>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">{{ $stats['nonaktif'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="px-5 sm:px-6 py-5 border-b border-slate-100">
                <h2 class="text-lg font-semibold text-slate-900">Daftar Program Unggulan</h2>
                <p class="text-sm text-slate-500 mt-0.5">{{ $programUnggulan->total() }} program terdaftar</p>
            </div>

            @if(session('success'))
                <div class="mx-5 sm:mx-6 mt-5 flex items-center gap-3 rounded-xl bg-emerald-50 border border-emerald-100 px-4 py-3 text-emerald-800 text-sm">
                    <i class="fas fa-check-circle text-emerald-500"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mx-5 sm:mx-6 mt-5 flex items-center gap-3 rounded-xl bg-rose-50 border border-rose-100 px-4 py-3 text-rose-800 text-sm">
                    <i class="fas fa-exclamation-circle text-rose-500"></i>
                    {{ session('error') }}
                </div>
            @endif

            <div class="p-5 sm:p-6">
                <form method="GET" action="{{ route('admin.program-unggulan.index') }}" class="mb-6">
                    <div class="flex flex-col gap-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-slate-400"></i>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                   placeholder="Cari judul atau deskripsi program..."
                                   class="w-full h-12 pl-11 {{ request('search') ? 'pr-11' : 'pr-4' }} rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder:text-slate-400
                                          focus:bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all">
                            @if(request('search'))
                                <a href="{{ route('admin.program-unggulan.index', request()->except('search', 'page')) }}"
                                   class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600" title="Hapus pencarian">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-1 sm:max-w-[180px]">
                                <select name="status" id="status"
                                        class="w-full h-11 appearance-none pl-4 pr-10 rounded-xl border border-slate-200 bg-white text-sm text-slate-700
                                               focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-400 transition-all">
                                    <option value="">Semua Status</option>
                                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                            </div>
                            <div class="flex gap-2 sm:ml-auto">
                                <button type="submit"
                                        class="inline-flex items-center justify-center gap-2 h-11 px-5 rounded-xl bg-emerald-600 text-white text-sm font-semibold
                                               hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2
                                               shadow-sm shadow-emerald-600/25 transition-colors whitespace-nowrap">
                                    <i class="fas fa-sliders-h"></i> Filter
                                </button>
                                @if($hasFilters)
                                    <a href="{{ route('admin.program-unggulan.index') }}"
                                       class="inline-flex items-center justify-center gap-2 h-11 px-4 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-semibold
                                              hover:bg-slate-50 hover:text-slate-800 transition-colors whitespace-nowrap">
                                        <i class="fas fa-undo text-xs"></i> Reset
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($hasFilters)
                        <div class="mt-3 flex flex-wrap items-center gap-2">
                            <span class="text-xs text-slate-500">Filter:</span>
                            @if(request('search'))
                                <span class="inline-flex items-center h-7 px-2.5 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-medium border border-emerald-100">
                                    “{{ Str::limit(request('search'), 24) }}”
                                </span>
                            @endif
                            @if(request('status'))
                                <span class="inline-flex items-center h-7 px-2.5 rounded-lg bg-sky-50 text-sky-700 text-xs font-medium border border-sky-100">
                                    {{ ucfirst(request('status')) }}
                                </span>
                            @endif
                            <span class="text-xs text-slate-400 sm:ml-auto">{{ $programUnggulan->total() }} hasil</span>
                        </div>
                    @endif
                </form>

                <div class="overflow-x-auto rounded-xl border border-slate-200">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50/80">
                            <tr>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider w-14">No</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Urutan</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Icon</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Judul</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Deskripsi</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Warna</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @forelse($programUnggulan as $program)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-sm font-semibold text-slate-600">
                                        {{ $programUnggulan->firstItem() + $loop->index }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="text-sm font-semibold text-slate-800">{{ $program->urutan }}</span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="w-11 h-11 rounded-xl flex items-center justify-center {{ $warnaIcon[$program->warna] ?? 'bg-slate-100 text-slate-600' }}">
                                        <i class="{{ $program->icon }} text-lg"></i>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <p class="text-sm font-semibold text-slate-900">{{ $program->judul }}</p>
                                </td>
                                <td class="px-4 py-4">
                                    <p class="text-sm text-slate-500 max-w-xs line-clamp-2">{{ Str::limit($program->deskripsi, 80) }}</p>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium border {{ $warnaBadge[$program->warna] ?? 'bg-slate-50 text-slate-600 border-slate-100' }}">
                                        {{ ucfirst($program->warna) }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if($program->status == 'aktif')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium bg-rose-50 text-rose-700 border border-rose-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('admin.program-unggulan.edit', $program) }}"
                                           class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-emerald-600 hover:bg-emerald-50 transition-colors" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.program-unggulan.destroy', $program) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-rose-600 hover:bg-rose-50 transition-colors" title="Hapus">
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
                                        <i class="fas fa-star text-2xl text-slate-400"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-slate-900 mb-1">
                                        {{ $hasFilters ? 'Tidak ada program yang cocok' : 'Belum ada program unggulan' }}
                                    </h3>
                                    <p class="text-sm text-slate-500 mb-5">
                                        {{ $hasFilters ? 'Coba ubah kata kunci atau reset filter.' : 'Mulai dengan menambahkan program unggulan pertama.' }}
                                    </p>
                                    @if($hasFilters)
                                        <a href="{{ route('admin.program-unggulan.index') }}"
                                           class="inline-flex items-center gap-2 h-10 px-4 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-semibold hover:bg-slate-50">
                                            <i class="fas fa-undo text-xs"></i> Reset Filter
                                        </a>
                                    @else
                                        <a href="{{ route('admin.program-unggulan.create') }}"
                                           class="inline-flex items-center gap-2 h-10 px-5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700">
                                            <i class="fas fa-plus"></i> Tambah Program
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($programUnggulan->total() > 0)
                <div class="mt-5 pt-5 border-t border-slate-100">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <p class="text-sm text-slate-500">
                            Menampilkan
                            <span class="font-semibold text-slate-800">{{ $programUnggulan->firstItem() ?? 0 }}</span>
                            –
                            <span class="font-semibold text-slate-800">{{ $programUnggulan->lastItem() ?? 0 }}</span>
                            dari
                            <span class="font-semibold text-slate-800">{{ $programUnggulan->total() }}</span>
                        </p>
                        <div class="admin-list-pagination">
                            {{ $programUnggulan->onEachSide(1)->links() }}
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
    background-color: #059669 !important;
    border-color: #059669 !important;
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
    background-color: #ecfdf5 !important;
    color: #047857 !important;
    border-color: #a7f3d0 !important;
}
</style>
@endsection
