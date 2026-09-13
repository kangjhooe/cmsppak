@extends('layouts.admin-simple')

@section('title', 'Buku Tamu - ' . $schoolName)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-teal-50/30 to-cyan-50/30">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-teal-600 via-cyan-600 to-blue-600 shadow-2xl relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="mb-8 lg:mb-0">
                    <h1 class="text-5xl lg:text-6xl font-bold text-white mb-4 drop-shadow-lg">
                        Buku Tamu
                    </h1>
                    <p class="text-xl lg:text-2xl text-teal-100 font-medium">
                        Kelola pesan dan saran dari pengunjung website
                    </p>
                    <p class="text-teal-100 mt-2">Baca dan balas pesan dari pengunjung</p>
                </div>
                
                <div class="flex items-center space-x-6 bg-white/10 backdrop-blur-sm rounded-3xl p-6 border border-white/20">
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-book-open text-white text-3xl"></i>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-teal-100 font-medium">Total Pesan</p>
                        <p class="text-2xl font-bold text-white">{{ $bukuTamu->total() }}</p>
                        <p class="text-sm text-teal-100">Pesan</p>
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
                    <div class="w-16 h-16 bg-gradient-to-br from-teal-500 via-cyan-600 to-blue-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-book-open text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Total Pesan</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $bukuTamu->total() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-teal-600 font-semibold">
                    <i class="fas fa-book-open mr-2"></i>
                    <span>Semua Pesan</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 via-red-600 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-envelope text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Belum Dibaca</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $bukuTamu->where('status', 'unread')->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-red-600 font-semibold">
                    <i class="fas fa-envelope mr-2"></i>
                    <span>Perlu Dibaca</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 via-orange-600 to-red-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-eye text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Sudah Dibaca</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $bukuTamu->where('status', 'read')->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-yellow-600 font-semibold">
                    <i class="fas fa-eye mr-2"></i>
                    <span>Sudah Dilihat</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 via-emerald-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-reply text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Sudah Dibalas</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $bukuTamu->where('status', 'replied')->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-green-600 font-semibold">
                    <i class="fas fa-reply mr-2"></i>
                    <span>Sudah Dibalas</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="card-modern">
            <div class="card-modern-header">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Pesan</h3>
                        <p class="text-sm text-gray-600">Kelola pesan dan saran dari pengunjung website</p>
                    </div>
                    <div class="text-sm text-gray-500">
                        Total: {{ $bukuTamu->total() }} pesan
                    </div>
                </div>
            </div>

            <div class="card-modern-body">
                <!-- Filter dan Search -->
                <div class="mb-6">
                    <form method="GET" action="{{ route('admin.buku-tamu.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                                <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Sudah Dibalas</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                   placeholder="Nama, email, atau pesan..."
                                   class="form-input">
                        </div>
                        
                        <div>
                            <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                   class="form-input">
                        </div>
                        
                        <div class="flex items-end">
                            <button type="submit" class="btn-secondary w-full">
                                <i class="fas fa-filter mr-2"></i>Filter
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-user mr-2"></i>Pengirim
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-comment mr-2"></i>Pesan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-calendar mr-2"></i>Tanggal
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-toggle-on mr-2"></i>Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-cogs mr-2"></i>Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($bukuTamu as $pesan)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $pesan->nama }}</div>
                                        <div class="text-sm text-gray-500">{{ $pesan->email }}</div>
                                        @if($pesan->telepon)
                                            <div class="text-sm text-gray-500">{{ $pesan->telepon }}</div>
                                        @endif
                                        @if($pesan->instansi)
                                            <div class="text-sm text-gray-500">{{ $pesan->instansi }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs truncate">
                                        {{ Str::limit($pesan->pesan, 100) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $pesan->created_at->format('d-m-Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($pesan->status === 'unread')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-circle mr-1 text-xs"></i>Belum Dibaca
                                        </span>
                                    @elseif($pesan->status === 'read')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-circle mr-1 text-xs"></i>Sudah Dibaca
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-circle mr-1 text-xs"></i>Sudah Dibalas
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.buku-tamu.show', $pesan->id) }}" 
                                           class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition-colors duration-200"
                                           title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        @if($pesan->status === 'unread')
                                            <form action="{{ route('admin.buku-tamu.mark-as-read', $pesan->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-yellow-600 hover:text-yellow-800 p-2 rounded-lg hover:bg-yellow-50 transition-colors duration-200" title="Tandai Dibaca">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if($pesan->status !== 'replied')
                                            <a href="{{ route('admin.buku-tamu.show', $pesan->id) }}#reply" 
                                               class="text-green-600 hover:text-green-800 p-2 rounded-lg hover:bg-green-50 transition-colors duration-200"
                                               title="Balas">
                                                <i class="fas fa-reply"></i>
                                            </a>
                                        @endif
                                        
                                        <form action="{{ route('admin.buku-tamu.destroy', $pesan->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors duration-200" 
                                                    onclick="return confirm('Yakin ingin menghapus pesan ini?')"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-book-open text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-lg font-medium text-gray-400">Tidak ada pesan buku tamu</p>
                                        <p class="text-sm text-gray-300">Belum ada pengunjung yang meninggalkan pesan</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($bukuTamu->hasPages())
                <div class="mt-6 border-t border-gray-200 pt-6">
                    {{ $bukuTamu->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Custom CSS untuk form dan button */
.form-input {
    @apply w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200;
}

.form-select {
    @apply w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200;
}

.btn-secondary {
    @apply inline-flex items-center px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-200 active:bg-gray-300 focus:outline-none focus:border-gray-500 focus:ring focus:ring-gray-300 transition-all duration-200 shadow-sm hover:shadow-md;
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
</style>
@endsection
