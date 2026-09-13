@extends('layouts.admin-simple')

@section('title', 'Manajemen Komentar - ' . $schoolName)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/30">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 shadow-2xl relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="mb-8 lg:mb-0">
                    <h1 class="text-5xl lg:text-6xl font-bold text-white mb-4 drop-shadow-lg">
                        Manajemen Komentar
                    </h1>
                    <p class="text-xl lg:text-2xl text-blue-100 font-medium">
                        Kelola komentar dari pengunjung website
                    </p>
                    <p class="text-blue-100 mt-2">Moderasi dan kelola semua komentar yang masuk</p>
                </div>
                
                <div class="flex items-center space-x-6 bg-white/10 backdrop-blur-sm rounded-3xl p-6 border border-white/20">
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-comments text-white text-3xl"></i>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-blue-100 font-medium">Total Komentar</p>
                        <p class="text-2xl font-bold text-white">{{ $stats['total'] }}</p>
                        <p class="text-sm text-blue-100">Komentar</p>
                    </div>
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-clock text-white text-3xl"></i>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-blue-100 font-medium">Menunggu</p>
                        <p class="text-2xl font-bold text-white">{{ $stats['pending'] }}</p>
                        <p class="text-sm text-blue-100">Persetujuan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-comments text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Total Komentar</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-blue-600 font-semibold">
                    <i class="fas fa-comments mr-2"></i>
                    <span>Semua Komentar</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 via-orange-600 to-red-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Menunggu</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['pending'] }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-yellow-600 font-semibold">
                    <i class="fas fa-clock mr-2"></i>
                    <span>Persetujuan</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 via-emerald-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-check-circle text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Disetujui</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['approved'] }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-green-600 font-semibold">
                    <i class="fas fa-check mr-2"></i>
                    <span>Sudah Disetujui</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 via-red-600 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-times-circle text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Ditolak</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['rejected'] }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-red-600 font-semibold">
                    <i class="fas fa-times mr-2"></i>
                    <span>Sudah Ditolak</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="card-modern">
            <div class="card-modern-header">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Komentar</h3>
                        <p class="text-sm text-gray-600">Kelola dan moderasi semua komentar yang masuk</p>
                    </div>
                </div>

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mt-4 flex items-center animate-fade-in">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold">{{ session('success') }}</p>
                            <p class="text-sm text-green-600">Aksi berhasil dilakukan</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="card-modern-body">
                <!-- Search and Filter -->
                <div class="mb-6">
                    <form method="GET" action="{{ route('admin.comments.index') }}" class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                       placeholder="Nama, email, komentar, atau judul berita..."
                                       class="form-input pl-10 w-full">
                            </div>
                        </div>
                        <div>
                            <select name="status" id="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div>
                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                   class="form-input" placeholder="Dari Tanggal">
                        </div>
                        <div>
                            <button type="submit" class="btn-secondary">
                                <i class="fas fa-filter mr-2"></i>Filter
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('admin.comments.index') }}" class="btn-secondary">
                                <i class="fas fa-times mr-2"></i>Reset
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Bulk Actions -->
                <div class="mb-6 p-4 bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl border border-gray-200">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-tasks text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900">Aksi Massal</h4>
                                <p class="text-xs text-gray-600">Pilih komentar untuk melakukan aksi secara bersamaan</p>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500">
                            <span id="selectedCount">0</span> komentar dipilih
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-3">
                        <button type="button" class="bulk-btn-approve" onclick="bulkAction('approve')" title="Setujui Terpilih">
                            <i class="fas fa-check text-green-400"></i>
                        </button>
                        
                        <button type="button" class="bulk-btn-reject" onclick="bulkAction('reject')" title="Tolak Terpilih">
                            <i class="fas fa-times text-yellow-400"></i>
                        </button>
                        
                        <button type="button" class="bulk-btn-delete" onclick="bulkAction('delete')" title="Hapus Terpilih">
                            <i class="fas fa-trash text-red-400"></i>
                        </button>
                        
                        <button type="button" class="bulk-btn-clear" onclick="clearSelection()" title="Batal Pilih">
                            <i class="fas fa-times text-gray-400"></i>
                        </button>
                    </div>
                </div>

                @if($comments->count() > 0)
                    <form id="bulkForm" method="POST" action="{{ route('admin.comments.bulk-action') }}">
                        @csrf
                        <input type="hidden" name="action" id="bulkAction">
                    </form>
                    
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0 z-10">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2">Pilih</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <i class="fas fa-comment mr-2"></i>Komentar
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <i class="fas fa-user mr-2"></i>Penulis
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <i class="fas fa-newspaper mr-2"></i>Berita
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <i class="fas fa-tag mr-2"></i>Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <i class="fas fa-calendar mr-2"></i>Tanggal
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <i class="fas fa-cogs mr-2"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($comments as $comment)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" name="comment_ids[]" value="{{ $comment->id }}" class="comment-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            <div class="truncate" title="{{ strip_tags($comment->komentar) }}">
                                                {{ Str::limit(strip_tags($comment->komentar), 100) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $comment->nama }}</div>
                                        <div class="text-sm text-gray-500">{{ $comment->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('berita.show', $comment->berita->slug) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm">
                                            {{ Str::limit($comment->berita->judul, 50) }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($comment->status == 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i>Menunggu
                                            </span>
                                        @elseif($comment->status == 'approved')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i>Disetujui
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1"></i>Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $comment->created_at->format('d-m-Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $comment->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.comments.show', $comment) }}" class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition-colors duration-200" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            @if($comment->status == 'pending')
                                                <form method="POST" action="{{ route('admin.comments.update', $comment) }}" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="text-green-600 hover:text-green-800 p-2 rounded-lg hover:bg-green-50 transition-colors duration-200" title="Setujui">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.comments.update', $comment) }}" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="text-yellow-600 hover:text-yellow-800 p-2 rounded-lg hover:bg-yellow-50 transition-colors duration-200" title="Tolak">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors duration-200" title="Hapus">
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

                    <!-- Pagination -->
                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Menampilkan {{ $comments->firstItem() ?? 0 }} sampai {{ $comments->lastItem() ?? 0 }} dari {{ $comments->total() }} komentar
                            </div>
                            <div class="flex items-center space-x-2">
                                {{ $comments->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-comments text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada komentar</h3>
                        <p class="text-gray-500">Komentar dari pengunjung akan muncul di sini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Custom CSS untuk form dan button */
.form-input {
    @apply w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200;
}

.form-select {
    @apply w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200;
}

.btn-primary {
    @apply inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-blue-700 hover:to-indigo-700 active:from-blue-800 active:to-indigo-800 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5;
}

.btn-secondary {
    @apply inline-flex items-center px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-500 focus:ring focus:ring-gray-300 transition-all duration-200 shadow-sm hover:shadow-md;
}

.btn-success-sm {
    @apply inline-flex items-center px-3 py-2 bg-green-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-200 shadow-sm hover:shadow-md;
}

.btn-warning-sm {
    @apply inline-flex items-center px-3 py-2 bg-yellow-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all duration-200 shadow-sm hover:shadow-md;
}

.btn-danger-sm {
    @apply inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-200 shadow-sm hover:shadow-md;
}

/* Bulk Action Buttons - Icon Only - Dark Colors */
.bulk-btn-approve {
    @apply inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-gray-700 via-gray-800 to-gray-900 border border-transparent rounded-xl text-white hover:from-gray-800 hover:via-gray-900 hover:to-black focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105;
}

.bulk-btn-reject {
    @apply inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-gray-700 via-gray-800 to-gray-900 border border-transparent rounded-xl text-white hover:from-gray-800 hover:via-gray-900 hover:to-black focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105;
}

.bulk-btn-delete {
    @apply inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-gray-700 via-gray-800 to-gray-900 border border-transparent rounded-xl text-white hover:from-gray-800 hover:via-gray-900 hover:to-black focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105;
}

.bulk-btn-clear {
    @apply inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-gray-700 via-gray-800 to-gray-900 border border-transparent rounded-xl text-white hover:from-gray-800 hover:via-gray-900 hover:to-black focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105;
}

.card-modern {
    @apply bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden;
}

.card-modern-header {
    @apply p-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white;
}

.card-modern-body {
    @apply p-6;
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-out;
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
    
    selectAll.checked = false;
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    
    updateSelectedCount();
}

function updateSelectedCount() {
    const checkboxes = document.querySelectorAll('.comment-checkbox:checked');
    const countElement = document.getElementById('selectedCount');
    
    if (countElement) {
        countElement.textContent = checkboxes.length;
        
        // Update select all checkbox state
        const selectAll = document.getElementById('selectAll');
        const allCheckboxes = document.querySelectorAll('.comment-checkbox');
        
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
}

function bulkAction(action) {
    const checkboxes = document.querySelectorAll('.comment-checkbox:checked');
    
    if (checkboxes.length === 0) {
        alert('Pilih komentar yang akan diproses terlebih dahulu');
        return;
    }
    
    const commentIds = Array.from(checkboxes).map(cb => cb.value);
    const actionText = action === 'approve' ? 'menyetujui' : action === 'reject' ? 'menolak' : 'menghapus';
    
    if (confirm(`Yakin ingin ${actionText} ${commentIds.length} komentar?`)) {
        // Disable all bulk action buttons
        const bulkButtons = document.querySelectorAll('.bulk-btn-approve, .bulk-btn-reject, .bulk-btn-delete, .bulk-btn-clear');
        bulkButtons.forEach(btn => {
            btn.disabled = true;
            btn.style.opacity = '0.6';
            btn.style.cursor = 'not-allowed';
        });
        
        // Clear existing hidden inputs
        const bulkForm = document.getElementById('bulkForm');
        const existingInputs = bulkForm.querySelectorAll('input[name="comment_ids[]"]');
        existingInputs.forEach(input => input.remove());
        
        // Set action
        document.getElementById('bulkAction').value = action;
        
        // Add comment IDs as individual hidden inputs
        commentIds.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'comment_ids[]';
            input.value = id;
            bulkForm.appendChild(input);
        });
        
        // Show loading message
        const selectedCount = document.getElementById('selectedCount');
        const originalText = selectedCount.textContent;
        selectedCount.textContent = 'Memproses...';
        
        bulkForm.submit();
    }
}

// Add event listeners to checkboxes
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.comment-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });
    
    // Initial count update
    updateSelectedCount();
});
</script>
@endsection
