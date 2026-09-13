@extends('layouts.admin-simple')

@section('title', 'Kelola Downloads - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-orange-50/30 to-amber-50/30">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-orange-600 via-amber-600 to-yellow-600 shadow-2xl relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="mb-8 lg:mb-0">
                    <h1 class="text-5xl lg:text-6xl font-bold text-white mb-4 drop-shadow-lg">
                        Manajemen Downloads
                    </h1>
                    <p class="text-xl lg:text-2xl text-orange-100 font-medium">
                        Kelola semua file yang dapat diunduh
                    </p>
                    <p class="text-orange-100 mt-2">Upload dan atur file untuk pengunjung website</p>
                </div>
                
                <div class="flex items-center space-x-6 bg-white/10 backdrop-blur-sm rounded-3xl p-6 border border-white/20">
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-download text-white text-3xl"></i>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-orange-100 font-medium">Total File</p>
                        <p class="text-2xl font-bold text-white">{{ $downloads->total() }}</p>
                        <p class="text-sm text-orange-100">Download</p>
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
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 via-amber-600 to-yellow-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-download text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Total File</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $downloads->total() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-orange-600 font-semibold">
                    <i class="fas fa-download mr-2"></i>
                    <span>Semua File</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 via-emerald-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-check-circle text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Aktif</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $downloads->where('is_active', true)->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-green-600 font-semibold">
                    <i class="fas fa-check mr-2"></i>
                    <span>Dapat Diunduh</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 via-red-600 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-times-circle text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Nonaktif</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $downloads->where('is_active', false)->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-red-600 font-semibold">
                    <i class="fas fa-times mr-2"></i>
                    <span>Tidak Tersedia</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-file-pdf text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">PDF</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $downloads->where('tipe_file', 'pdf')->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-blue-600 font-semibold">
                    <i class="fas fa-file-pdf mr-2"></i>
                    <span>Dokumen</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="card-modern">
            <div class="card-modern-header">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar File Download</h3>
                        <p class="text-sm text-gray-600">Kelola semua file yang dapat diunduh pengunjung</p>
                    </div>
                    <a href="{{ route('admin.downloads.create') }}" class="btn-primary">
                        <i class="fas fa-plus mr-2"></i>Tambah File
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mt-4 flex items-center">
                        <i class="fas fa-check-circle mr-2 text-green-600"></i>
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <div class="card-modern-body">
                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <i class="fas fa-file mr-2"></i>File
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-tag mr-2"></i>Kategori
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-weight-hanging mr-2"></i>Ukuran
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-download mr-2"></i>Download
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
                            @forelse($downloads as $download)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($download->tipe_file == 'pdf')
                                                <div class="h-10 w-10 bg-red-100 rounded-lg flex items-center justify-center ring-2 ring-red-200">
                                                    <i class="fas fa-file-pdf text-red-500 text-lg"></i>
                                                </div>
                                            @elseif(in_array($download->tipe_file, ['doc', 'docx']))
                                                <div class="h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center ring-2 ring-blue-200">
                                                    <i class="fas fa-file-word text-blue-500 text-lg"></i>
                                                </div>
                                            @elseif(in_array($download->tipe_file, ['xls', 'xlsx']))
                                                <div class="h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center ring-2 ring-green-200">
                                                    <i class="fas fa-file-excel text-green-500 text-lg"></i>
                                                </div>
                                            @elseif(in_array($download->tipe_file, ['ppt', 'pptx']))
                                                <div class="h-10 w-10 bg-orange-100 rounded-lg flex items-center justify-center ring-2 ring-orange-200">
                                                    <i class="fas fa-file-powerpoint text-orange-500 text-lg"></i>
                                                </div>
                                            @else
                                                <div class="h-10 w-10 bg-gray-100 rounded-lg flex items-center justify-center ring-2 ring-gray-200">
                                                    <i class="fas fa-file text-gray-500 text-lg"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $download->judul }}</div>
                                            <div class="text-sm text-gray-500">{{ $download->nama_file }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-tag mr-1"></i>{{ ucfirst($download->kategori) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $download->ukuran_file_formatted }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="flex items-center">
                                        <i class="fas fa-download text-blue-500 mr-2"></i>
                                        {{ $download->jumlah_download }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.downloads.toggle-status', $download) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition-colors duration-200 {{ $download->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                                            <i class="fas fa-circle mr-1 text-xs"></i>
                                            {{ $download->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.downloads.edit', $download) }}" class="text-indigo-600 hover:text-indigo-800 p-2 rounded-lg hover:bg-indigo-50 transition-colors duration-200" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.downloads.destroy', $download) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors duration-200" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-file-download text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-lg font-medium text-gray-400">Belum ada file download</p>
                                        <p class="text-sm text-gray-300">Mulai dengan menambahkan file pertama</p>
                                        <a href="{{ route('admin.downloads.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700">
                                            Tambah File Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($downloads->hasPages())
                <div class="mt-6 border-t border-gray-200 pt-6">
                    {{ $downloads->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Custom CSS untuk form dan button */
.btn-primary {
    @apply inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-600 to-amber-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-orange-700 hover:to-amber-700 active:from-orange-800 active:to-amber-800 focus:outline-none focus:border-orange-900 focus:ring focus:ring-orange-300 disabled:opacity-25 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5;
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
