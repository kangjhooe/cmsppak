@extends('layouts.admin-simple')

@section('title', 'Manajemen Komentar - ' . $schoolName)

@section('content')
@php
    $hasFilters = request()->filled('search') || request()->filled('status') || request()->filled('date_from');
@endphp
<div class="bg-slate-50 pb-10">
    <!-- Banner: ikuti gradasi downloads (purple → pink → red) -->
    <div class="w-full bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 relative overflow-hidden">
        <div class="absolute inset-0 opacity-[0.12] pointer-events-none" style="background-image: radial-gradient(circle at 20% 50%, #fff 0, transparent 45%), radial-gradient(circle at 80% 20%, #fff 0, transparent 35%);"></div>
        <div class="relative w-full px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 max-w-7xl mx-auto">
                <div>
                    <p class="text-purple-100 text-sm font-medium mb-2">Konten Website</p>
                    <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Manajemen Komentar</h1>
                    <p class="mt-2 text-purple-50/90 text-base max-w-xl">Moderasi dan kelola komentar dari pengunjung website.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-purple-200 transition-all duration-200">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-comments text-purple-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Total Komentar</p>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">{{ $stats['total'] }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-amber-200 transition-all duration-200">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-amber-100 flex items-center justify-center">
                    <i class="fas fa-clock text-amber-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Menunggu</p>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">{{ $stats['pending'] }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-emerald-200 transition-all duration-200">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-emerald-100 flex items-center justify-center">
                    <i class="fas fa-check-circle text-emerald-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Disetujui</p>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">{{ $stats['approved'] }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 sm:p-5 flex items-center gap-4 hover:shadow-md hover:border-rose-200 transition-all duration-200">
                <div class="shrink-0 w-12 h-12 sm:w-14 sm:h-14 rounded-2xl bg-rose-100 flex items-center justify-center">
                    <i class="fas fa-times-circle text-rose-600 text-lg sm:text-xl"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Ditolak</p>
                    <p class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight">{{ $stats['rejected'] }}</p>
                </div>
            </div>
        </div>

        <!-- Main panel -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="px-5 sm:px-6 py-5 border-b border-slate-100">
                <h2 class="text-lg font-semibold text-slate-900">Daftar Komentar</h2>
                <p class="text-sm text-slate-500 mt-0.5">{{ $comments->total() }} komentar terdaftar</p>
            </div>

            @if(session('success'))
                <div class="mx-5 sm:mx-6 mt-5 flex items-center gap-3 rounded-xl bg-emerald-50 border border-emerald-100 px-4 py-3 text-emerald-800 text-sm">
                    <i class="fas fa-check-circle text-emerald-500"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-5 sm:p-6">
                <!-- Search toolbar -->
                <form method="GET" action="{{ route('admin.comments.index') }}" class="mb-6">
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
                                placeholder="Cari nama, email, komentar, atau judul berita..."
                                class="w-full h-12 pl-11 {{ request('search') ? 'pr-11' : 'pr-4' }} rounded-xl border border-slate-200 bg-slate-50 text-sm text-slate-800 placeholder:text-slate-400
                                       focus:bg-white focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-400 transition-all"
                            >
                            @if(request('search'))
                                <a href="{{ route('admin.comments.index', request()->except('search', 'page')) }}"
                                   class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600"
                                   title="Hapus pencarian">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-1 sm:max-w-[220px]">
                                <select name="status" id="status"
                                        class="w-full h-11 appearance-none pl-4 pr-10 rounded-xl border border-slate-200 bg-white text-sm text-slate-700
                                               focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-400 transition-all">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                            </div>

                            <div class="flex-1 sm:max-w-[180px]">
                                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                       class="w-full h-11 px-4 rounded-xl border border-slate-200 bg-white text-sm text-slate-700
                                              focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-400 transition-all">
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
                                    <a href="{{ route('admin.comments.index') }}"
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
                            @if(request('status'))
                                <span class="inline-flex items-center gap-1.5 h-7 px-2.5 rounded-lg bg-pink-50 text-pink-700 text-xs font-medium border border-pink-100">
                                    @php
                                        $statusLabels = [
                                            'pending' => 'Menunggu',
                                            'approved' => 'Disetujui',
                                            'rejected' => 'Ditolak',
                                        ];
                                    @endphp
                                    {{ $statusLabels[request('status')] ?? ucfirst(request('status')) }}
                                </span>
                            @endif
                            @if(request('date_from'))
                                <span class="inline-flex items-center gap-1.5 h-7 px-2.5 rounded-lg bg-sky-50 text-sky-700 text-xs font-medium border border-sky-100">
                                    Dari {{ request('date_from') }}
                                </span>
                            @endif
                            <span class="text-xs text-slate-400 sm:ml-auto">{{ $comments->total() }} hasil</span>
                        </div>
                    @endif
                </form>

                @if($comments->count() > 0)
                    <!-- Bulk Actions -->
                    <div class="mb-5 p-4 rounded-xl border border-slate-200 bg-slate-50/80">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-3">
                            <div>
                                <h4 class="text-sm font-semibold text-slate-900">Aksi Massal</h4>
                                <p class="text-xs text-slate-500">Pilih komentar untuk diproses sekaligus</p>
                            </div>
                            <p class="text-xs text-slate-500">
                                <span id="selectedCount" class="font-semibold text-slate-800">0</span> komentar dipilih
                            </p>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" onclick="bulkAction('approve')"
                                    class="bulk-btn-approve inline-flex items-center gap-2 h-10 px-4 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition-colors">
                                <i class="fas fa-check"></i> Setujui
                            </button>
                            <button type="button" onclick="bulkAction('reject')"
                                    class="bulk-btn-reject inline-flex items-center gap-2 h-10 px-4 rounded-xl bg-amber-500 text-white text-sm font-semibold hover:bg-amber-600 transition-colors">
                                <i class="fas fa-times"></i> Tolak
                            </button>
                            <button type="button" onclick="bulkAction('delete')"
                                    class="bulk-btn-delete inline-flex items-center gap-2 h-10 px-4 rounded-xl bg-rose-600 text-white text-sm font-semibold hover:bg-rose-700 transition-colors">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                            <button type="button" onclick="clearSelection()"
                                    class="bulk-btn-clear inline-flex items-center gap-2 h-10 px-4 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-semibold hover:bg-slate-50 transition-colors">
                                <i class="fas fa-undo text-xs"></i> Batal Pilih
                            </button>
                        </div>
                    </div>

                    <form id="bulkForm" method="POST" action="{{ route('admin.comments.bulk-action') }}">
                        @csrf
                        <input type="hidden" name="action" id="bulkAction">
                    </form>

                    <!-- Table -->
                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50/80">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-12">
                                        <input type="checkbox" id="selectAll" onchange="toggleSelectAll()"
                                               class="rounded border-slate-300 text-purple-600 focus:ring-purple-500">
                                    </th>
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider w-14">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Komentar</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Penulis</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Berita</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-4 py-3 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @foreach($comments as $comment)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-4 py-4">
                                        <input type="checkbox" name="comment_ids[]" value="{{ $comment->id }}"
                                               class="comment-checkbox rounded border-slate-300 text-purple-600 focus:ring-purple-500">
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 text-sm font-semibold text-slate-600">
                                            {{ $comments->firstItem() + $loop->index }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <p class="text-sm text-slate-800 max-w-xs line-clamp-2" title="{{ strip_tags($comment->komentar) }}">
                                            {{ Str::limit(strip_tags($comment->komentar), 100) }}
                                        </p>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center shrink-0">
                                                <span class="text-xs font-semibold text-purple-700">{{ strtoupper(substr($comment->nama ?? 'N', 0, 1)) }}</span>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-sm font-medium text-slate-900 truncate">{{ $comment->nama }}</p>
                                                <p class="text-xs text-slate-500 truncate">{{ $comment->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        @if($comment->berita)
                                            <a href="{{ route('berita.show', $comment->berita->slug) }}" target="_blank"
                                               class="text-sm text-purple-600 hover:text-purple-800 hover:underline">
                                                {{ Str::limit($comment->berita->judul, 40) }}
                                            </a>
                                        @else
                                            <span class="text-xs text-slate-400 italic">Berita dihapus</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        @if($comment->status == 'pending')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium bg-amber-50 text-amber-700 border border-amber-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Menunggu
                                            </span>
                                        @elseif($comment->status == 'approved')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Disetujui
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium bg-rose-50 text-rose-700 border border-rose-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-slate-800">{{ $comment->created_at->format('d-m-Y') }}</div>
                                        <div class="text-xs text-slate-500">{{ $comment->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="{{ route('admin.comments.show', $comment) }}"
                                               class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-sky-600 hover:bg-sky-50 transition-colors" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if($comment->status == 'pending')
                                                <form method="POST" action="{{ route('admin.comments.update', $comment) }}" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit"
                                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-emerald-600 hover:bg-emerald-50 transition-colors"
                                                            title="Setujui">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.comments.update', $comment) }}" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit"
                                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-amber-600 hover:bg-amber-50 transition-colors"
                                                            title="Tolak">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-5 pt-5 border-t border-slate-100">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <p class="text-sm text-slate-500">
                                Menampilkan
                                <span class="font-semibold text-slate-800">{{ $comments->firstItem() ?? 0 }}</span>
                                –
                                <span class="font-semibold text-slate-800">{{ $comments->lastItem() ?? 0 }}</span>
                                dari
                                <span class="font-semibold text-slate-800">{{ $comments->total() }}</span>
                            </p>
                            <div class="admin-list-pagination">
                                {{ $comments->onEachSide(1)->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="rounded-xl border border-slate-200 px-6 py-16 text-center">
                        <div class="mx-auto w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                            <i class="fas fa-comments text-2xl text-slate-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-1">
                            {{ $hasFilters ? 'Tidak ada komentar yang cocok' : 'Belum ada komentar' }}
                        </h3>
                        <p class="text-sm text-slate-500 mb-5">
                            {{ $hasFilters ? 'Coba ubah kata kunci atau reset filter.' : 'Komentar dari pengunjung akan muncul di sini.' }}
                        </p>
                        @if($hasFilters)
                            <a href="{{ route('admin.comments.index') }}"
                               class="inline-flex items-center gap-2 h-10 px-4 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-semibold hover:bg-slate-50">
                                <i class="fas fa-undo text-xs"></i> Reset Filter
                            </a>
                        @endif
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

<script>
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.comment-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    updateSelectedCount();
}

function clearSelection() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.comment-checkbox');
    if (selectAll) selectAll.checked = false;
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    updateSelectedCount();
}

function updateSelectedCount() {
    const checkboxes = document.querySelectorAll('.comment-checkbox:checked');
    const countElement = document.getElementById('selectedCount');
    if (!countElement) return;

    countElement.textContent = checkboxes.length;

    const selectAll = document.getElementById('selectAll');
    const allCheckboxes = document.querySelectorAll('.comment-checkbox');
    if (!selectAll) return;

    if (checkboxes.length === 0) {
        selectAll.indeterminate = false;
        selectAll.checked = false;
    } else if (checkboxes.length === allCheckboxes.length) {
        selectAll.indeterminate = false;
        selectAll.checked = true;
    } else {
        selectAll.indeterminate = true;
    }
}

function bulkAction(action) {
    const checkboxes = document.querySelectorAll('.comment-checkbox:checked');
    if (checkboxes.length === 0) {
        alert('Pilih komentar yang akan diproses terlebih dahulu');
        return;
    }

    const commentIds = Array.from(checkboxes).map(cb => cb.value);
    const actionText = action === 'approve' ? 'menyetujui' : action === 'reject' ? 'menolak' : 'menghapus';

    if (!confirm(`Yakin ingin ${actionText} ${commentIds.length} komentar?`)) {
        return;
    }

    const bulkButtons = document.querySelectorAll('.bulk-btn-approve, .bulk-btn-reject, .bulk-btn-delete, .bulk-btn-clear');
    bulkButtons.forEach(btn => {
        btn.disabled = true;
        btn.style.opacity = '0.6';
        btn.style.cursor = 'not-allowed';
    });

    const bulkForm = document.getElementById('bulkForm');
    bulkForm.querySelectorAll('input[name="comment_ids[]"]').forEach(input => input.remove());
    document.getElementById('bulkAction').value = action;

    commentIds.forEach(id => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'comment_ids[]';
        input.value = id;
        bulkForm.appendChild(input);
    });

    const selectedCount = document.getElementById('selectedCount');
    if (selectedCount) selectedCount.textContent = 'Memproses...';
    bulkForm.submit();
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.comment-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });
    updateSelectedCount();
});
</script>
@endsection
