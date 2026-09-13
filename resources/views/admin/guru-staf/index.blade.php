@extends('layouts.admin-simple')

@section('title', 'Manajemen Guru & Staf - ' . $schoolName)

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
                        Manajemen Guru & Staf
                    </h1>
                    <p class="text-xl lg:text-2xl text-blue-100 font-medium">
                        Kelola data guru dan staf pondok pesantren
                    </p>
                    <p class="text-blue-100 mt-2">Atur informasi dan status kepegawaian</p>
                </div>
                
                <div class="flex items-center space-x-6 bg-white/10 backdrop-blur-sm rounded-3xl p-6 border border-white/20">
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-users text-white text-3xl"></i>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-blue-100 font-medium">Total</p>
                        <p class="text-2xl font-bold text-white">{{ $guruStaf->total() }}</p>
                        <p class="text-sm text-blue-100">Guru & Staf</p>
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
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Total</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $guruStaf->total() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-blue-600 font-semibold">
                    <i class="fas fa-users mr-2"></i>
                    <span>Guru & Staf</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 via-emerald-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Guru</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $guruStaf->where('jabatan', 'Guru')->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-green-600 font-semibold">
                    <i class="fas fa-chalkboard-teacher mr-2"></i>
                    <span>Tenaga Pendidik</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 via-purple-600 to-violet-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-user-tie text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Kepala Sekolah</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $guruStaf->where('jabatan', 'Kepala Sekolah')->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-purple-600 font-semibold">
                    <i class="fas fa-user-tie mr-2"></i>
                    <span>Pimpinan</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 via-orange-600 to-red-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-user-cog text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Staf</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $guruStaf->where('jabatan', '!=', 'Guru')->where('jabatan', '!=', 'Kepala Sekolah')->where('jabatan', '!=', 'Wakil Kepala Sekolah')->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-orange-600 font-semibold">
                    <i class="fas fa-user-cog mr-2"></i>
                    <span>Tenaga Kependidikan</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="card-modern">
            <div class="card-modern-header">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Guru & Staf</h3>
                        <p class="text-sm text-gray-600">Kelola data guru dan staf sekolah</p>
                    </div>
                    <a href="{{ route('admin.guru-staf.create') }}" class="btn-primary">
                        <i class="fas fa-plus mr-2"></i>Tambah Guru/Staf
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mt-4 flex items-center">
                        <i class="fas fa-check-circle mr-2 text-green-600"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mt-4 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2 text-red-600"></i>
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <div class="card-modern-body">
                <!-- Filter dan Pencarian -->
                <div class="mb-6">
                    <form action="{{ route('admin.guru-staf.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Nama/NIP</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                   placeholder="Nama atau NIP..." 
                                   class="form-input">
                        </div>
                        <div>
                            <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-select">
                                <option value="">Semua Jabatan</option>
                                <option value="Guru" {{ request('jabatan') == 'Guru' ? 'selected' : '' }}>Guru</option>
                                <option value="Kepala Sekolah" {{ request('jabatan') == 'Kepala Sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                                <option value="Wakil Kepala Sekolah" {{ request('jabatan') == 'Wakil Kepala Sekolah' ? 'selected' : '' }}>Wakil Kepala Sekolah</option>
                                <option value="Staf TU" {{ request('jabatan') == 'Staf TU' ? 'selected' : '' }}>Staf TU</option>
                                <option value="Staf Perpustakaan" {{ request('jabatan') == 'Staf Perpustakaan' ? 'selected' : '' }}>Staf Perpustakaan</option>
                                <option value="Staf Kebersihan" {{ request('jabatan') == 'Staf Kebersihan' ? 'selected' : '' }}>Staf Kebersihan</option>
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                <option value="Cuti" {{ request('status') == 'Cuti' ? 'selected' : '' }}>Cuti</option>
                            </select>
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
                                    <div class="flex items-center">
                                        <i class="fas fa-user mr-2"></i>Foto & Informasi
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-tag mr-2"></i>Jabatan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-phone mr-2"></i>Kontak
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
                            @forelse($guruStaf as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            @if($item->foto)
                                                <img class="h-12 w-12 rounded-full object-cover ring-2 ring-gray-100" src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama }}">
                                            @else
                                                <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center ring-2 ring-gray-100">
                                                    <span class="text-sm font-medium text-white">{{ strtoupper(substr($item->nama, 0, 1)) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                                            <div class="text-sm text-gray-500">{{ $item->nip ?? 'NIP tidak tersedia' }}</div>
                                            @if($item->bidang_studi)
                                                <div class="text-xs text-blue-600">{{ $item->bidang_studi }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $item->jabatan == 'Guru' ? 'bg-blue-100 text-blue-800' : 
                                           ($item->jabatan == 'Kepala Sekolah' ? 'bg-red-100 text-red-800' : 
                                           ($item->jabatan == 'Wakil Kepala Sekolah' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800')) }}">
                                        <i class="fas fa-tag mr-1"></i>{{ $item->jabatan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->email ?? '-' }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->telepon ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $item->status == 'Aktif' ? 'bg-green-100 text-green-800' : 
                                           ($item->status == 'Non-Aktif' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        <i class="fas fa-circle mr-1 text-xs"></i>{{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.guru-staf.show', $item) }}" 
                                           class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition-colors duration-150"
                                           title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.guru-staf.edit', $item) }}" 
                                           class="text-indigo-600 hover:text-indigo-800 p-2 rounded-lg hover:bg-indigo-50 transition-colors duration-150"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.guru-staf.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors duration-150"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <i class="fas fa-users text-4xl text-gray-400 mb-4"></i>
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data guru/staf</h3>
                                        <p class="text-gray-500">Mulai dengan menambahkan data guru atau staf pertama.</p>
                                        <a href="{{ route('admin.guru-staf.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            Tambah Data Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($guruStaf->hasPages())
                <div class="mt-6 border-t border-gray-200 pt-6">
                    {{ $guruStaf->appends(request()->query())->links() }}
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

