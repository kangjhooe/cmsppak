@extends('layouts.admin-simple')

@section('title', 'Manajemen Galeri - ' . $schoolName)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-purple-50/30 to-indigo-50/30">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 shadow-2xl relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="mb-8 lg:mb-0">
                    <h1 class="text-5xl lg:text-6xl font-bold text-white mb-4 drop-shadow-lg">
                        Manajemen Galeri
                    </h1>
                    <p class="text-xl lg:text-2xl text-purple-100 font-medium">
                        Kelola galeri dengan multiple foto dan video
                    </p>
                    <p class="text-purple-100 mt-2">Buat galeri per kegiatan/event dengan multiple media</p>
                </div>
                
                <div class="flex items-center space-x-6 bg-white/10 backdrop-blur-sm rounded-3xl p-6 border border-white/20">
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-images text-white text-3xl"></i>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-purple-100 font-medium">Total Galeri</p>
                        <p class="text-2xl font-bold text-white">{{ $galeri->total() }}</p>
                        <p class="text-sm text-purple-100">Galeri</p>
                    </div>
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-layer-group text-white text-3xl"></i>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-purple-100 font-medium">Total Media</p>
                        <p class="text-2xl font-bold text-white">{{ $galeri->sum('active_items_count') }}</p>
                        <p class="text-sm text-purple-100">Media</p>
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
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 via-purple-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-images text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Total Galeri</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $galeri->total() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-purple-600 font-semibold">
                    <i class="fas fa-images mr-2"></i>
                    <span>Semua Galeri</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 via-emerald-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-check-circle text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Active</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $galeri->where('status', 'active')->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-green-600 font-semibold">
                    <i class="fas fa-check mr-2"></i>
                    <span>Sudah Aktif</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-folder text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Kategori</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $galeri->pluck('kategori')->unique()->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-blue-600 font-semibold">
                    <i class="fas fa-folder mr-2"></i>
                    <span>Kategori</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 via-orange-600 to-red-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-layer-group text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Total Media</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $galeri->sum('active_items_count') }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-orange-600 font-semibold">
                    <i class="fas fa-layer-group mr-2"></i>
                    <span>Semua Media</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="card-modern">
            <div class="card-modern-header">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                                                 <h3 class="text-lg font-semibold text-gray-900">Daftar Galeri</h3>
                         <p class="text-sm text-gray-600">Kelola semua galeri multi-media yang ada</p>
                    </div>
                                         <a href="{{ route('admin.galeri.create') }}" class="btn-primary">
                         <i class="fas fa-plus mr-2"></i>Tambah Galeri
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
                <!-- Search and Filter -->
                <div class="mb-6">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" placeholder="Cari galeri..." class="form-input pl-10 w-full">
                            </div>
                        </div>
                        <div>
                            <select class="form-select">
                                <option value="">Semua Kategori</option>
                                <option value="akademik">Akademik</option>
                                <option value="prestasi">Prestasi</option>
                                <option value="acara">Acara</option>
                                <option value="kegiatan">Kegiatan</option>
                                <option value="fasilitas">Fasilitas</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <select class="form-select">
                                <option value="">Semua Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div>
                            <button class="btn-secondary">
                                <i class="fas fa-filter mr-2"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>

                                 <!-- Table -->
                 <div class="overflow-x-auto">
                     <table class="min-w-full divide-y divide-gray-200">
                         <thead class="bg-gray-50 sticky top-0 z-10">
                             <tr>
                                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                     <div class="flex items-center">
                                         <i class="fas fa-image mr-2"></i>Thumbnail
                                     </div>
                                 </th>
                                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                     <i class="fas fa-tag mr-2"></i>Judul & Deskripsi
                                 </th>
                                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                     <i class="fas fa-folder mr-2"></i>Kategori
                                 </th>
                                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                     <i class="fas fa-layer-group mr-2"></i>Jumlah Media
                                 </th>
                                 <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                     <i class="fas fa-toggle-on mr-2"></i>Status
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
                             @foreach($galeri as $item)
                             <tr class="hover:bg-gray-50 transition-colors duration-200">
                                 <td class="px-6 py-4">
                                     <div class="flex-shrink-0">
                                         @if($item->thumbnailItem)
                                             <img class="h-16 w-16 rounded-lg object-cover ring-2 ring-gray-100" 
                                                  src="{{ asset('storage/' . $item->thumbnailItem->file_path) }}" 
                                                  alt="{{ $item->judul }}">
                                         @else
                                             <div class="h-16 w-16 bg-gray-100 rounded-lg flex items-center justify-center ring-2 ring-gray-100">
                                                 <i class="fas fa-images text-gray-400 text-lg"></i>
                                             </div>
                                         @endif
                                     </div>
                                 </td>
                                 <td class="px-6 py-4">
                                     <div class="flex-1 min-w-0">
                                         <p class="text-sm font-medium text-gray-900 truncate">{{ $item->judul }}</p>
                                         <p class="text-sm text-gray-500">{{ Str::limit($item->deskripsi, 80) ?: 'Tidak ada deskripsi' }}</p>
                                     </div>
                                 </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                     @if($item->kategori)
                                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                             <i class="fas fa-folder mr-1"></i>{{ ucfirst($item->kategori) }}
                                         </span>
                                     @else
                                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                             <i class="fas fa-folder mr-1"></i>Umum
                                         </span>
                                     @endif
                                 </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                     <div class="text-center">
                                         <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                             <i class="fas fa-layer-group mr-1"></i>{{ $item->active_items_count }} item
                                         </span>
                                     </div>
                                 </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                     @if($item->status == 'active')
                                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                             <i class="fas fa-check-circle mr-1"></i>Active
                                         </span>
                                     @else
                                         <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                             <i class="fas fa-times-circle mr-1"></i>Inactive
                                         </span>
                                     @endif
                                 </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                     <div class="text-sm text-gray-900">{{ $item->created_at->format('d-m-Y') }}</div>
                                     <div class="text-xs text-gray-500">{{ $item->created_at->format('H:i') }}</div>
                                 </td>
                                 <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                     <div class="flex items-center space-x-2">
                                         <a href="{{ route('galeri.show', $item->id) }}" target="_blank" class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition-colors duration-200" title="Lihat Frontend">
                                             <i class="fas fa-external-link-alt"></i>
                                         </a>
                                         <a href="{{ route('admin.galeri.edit', $item) }}" class="text-indigo-600 hover:text-indigo-800 p-2 rounded-lg hover:bg-indigo-50 transition-colors duration-200" title="Edit">
                                             <i class="fas fa-edit"></i>
                                         </a>
                                         <form action="{{ route('admin.galeri.destroy', $item) }}" method="POST" class="inline">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors duration-200" 
                                                     onclick="return confirm('Yakin ingin menghapus galeri ini? Semua media dalam galeri akan ikut terhapus.')" title="Hapus">
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
                             Menampilkan {{ $galeri->firstItem() ?? 0 }} sampai {{ $galeri->lastItem() ?? 0 }} dari {{ $galeri->total() }} galeri
                         </div>
                        <div class="flex items-center space-x-2">
                            {{ $galeri->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom CSS untuk form dan button */
.form-input {
    @apply w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200;
}

.form-select {
    @apply w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200;
}

.btn-primary {
    @apply inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-purple-700 hover:to-indigo-700 active:from-purple-800 active:to-indigo-800 focus:outline-none focus:border-purple-900 focus:ring focus:ring-purple-300 disabled:opacity-25 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5;
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
