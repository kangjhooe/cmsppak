@extends('layouts.admin-simple')

@section('title', 'Manajemen Agenda - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-purple-50/30 to-pink-50/30">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 shadow-2xl relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="mb-8 lg:mb-0">
                    <h1 class="text-5xl lg:text-6xl font-bold text-white mb-4 drop-shadow-lg">
                        Manajemen Agenda
                    </h1>
                    <p class="text-xl lg:text-2xl text-purple-100 font-medium">
                        Kelola semua agenda dan kegiatan sekolah
                    </p>
                    <p class="text-purple-100 mt-2">Jadwalkan dan atur kegiatan akademik dan non-akademik</p>
                </div>
                
                <div class="flex items-center space-x-6 bg-white/10 backdrop-blur-sm rounded-3xl p-6 border border-white/20">
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-calendar-alt text-white text-3xl"></i>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-purple-100 font-medium">Total Agenda</p>
                        <p class="text-2xl font-bold text-white">{{ $agenda->total() ?? 0 }}</p>
                        <p class="text-sm text-purple-100">Kegiatan</p>
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
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 via-purple-600 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-calendar-alt text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Total Agenda</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $agenda->total() ?? 0 }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-purple-600 font-semibold">
                    <i class="fas fa-calendar mr-2"></i>
                    <span>Semua Kegiatan</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Akan Datang</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $agenda->filter(function($item) { return $item->tanggal_mulai && \Carbon\Carbon::parse($item->tanggal_mulai)->isFuture(); })->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-blue-600 font-semibold">
                    <i class="fas fa-clock mr-2"></i>
                    <span>Belum Mulai</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 via-emerald-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-play text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Sedang Berlangsung</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $agenda->filter(function($item) { return $item->tanggal_mulai && \Carbon\Carbon::parse($item->tanggal_mulai)->isToday(); })->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-green-600 font-semibold">
                    <i class="fas fa-play mr-2"></i>
                    <span>Hari Ini</span>
                </div>
            </div>

            <div class="card-modern group hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-gray-500 via-gray-600 to-slate-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-check text-white text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600 font-medium">Selesai</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $agenda->filter(function($item) { return $item->tanggal_mulai && \Carbon\Carbon::parse($item->tanggal_mulai)->isPast(); })->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center text-sm text-gray-600 font-semibold">
                    <i class="fas fa-check mr-2"></i>
                    <span>Sudah Lewat</span>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="card-modern">
            <div class="card-modern-header">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Agenda</h3>
                        <p class="text-sm text-gray-600">Kelola semua agenda dan kegiatan sekolah</p>
                    </div>
                    <a href="{{ route('admin.agenda.create') }}" class="btn-primary">
                        <i class="fas fa-plus mr-2"></i>Tambah Agenda
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
                    <form action="{{ route('admin.agenda.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Agenda</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" 
                                   placeholder="Judul agenda..." 
                                   class="form-input">
                        </div>
                        <div>
                            <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1">Jenis Agenda</label>
                            <select name="jenis" id="jenis" class="form-select">
                                <option value="">Semua Jenis</option>
                                <option value="akademik" {{ request('jenis') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="non-akademik" {{ request('jenis') == 'non-akademik' ? 'selected' : '' }}>Non-Akademik</option>
                                <option value="rapat" {{ request('jenis') == 'rapat' ? 'selected' : '' }}>Rapat</option>
                                <option value="kegiatan" {{ request('jenis') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                                <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
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
                                        <i class="fas fa-calendar mr-2"></i>Judul Agenda
                                    </div>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-tag mr-2"></i>Jenis
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-clock mr-2"></i>Tanggal & Waktu
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Lokasi
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
                            @forelse($agenda as $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->judul }}</div>
                                    <div class="text-sm text-gray-500 mt-1">{{ Str::limit($item->deskripsi, 80) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $item->jenis == 'akademik' ? 'bg-blue-100 text-blue-800' : 
                                           ($item->jenis == 'non_akademik' ? 'bg-green-100 text-green-800' : 
                                           ($item->jenis == 'umum' ? 'bg-purple-100 text-purple-800' : 'bg-yellow-100 text-yellow-800')) }}">
                                        <i class="fas fa-tag mr-1"></i>
                                        @if($item->jenis == 'non_akademik')
                                            Non-Akademik
                                        @else
                                            {{ ucfirst($item->jenis) }}
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->tanggal_mulai ? $item->tanggal_mulai->format('d-m-Y') : '-' }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->waktu_mulai ?? '-' }} - {{ $item->waktu_selesai ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->lokasi ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $now = \Carbon\Carbon::now();
                                        $tanggal = $item->tanggal_mulai ? \Carbon\Carbon::parse($item->tanggal_mulai) : null;
                                        $status = 'upcoming';
                                        if ($tanggal && $tanggal->isPast()) {
                                            $status = 'completed';
                                        } elseif ($tanggal && $tanggal->isToday()) {
                                            $status = 'ongoing';
                                        }
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $status == 'upcoming' ? 'bg-blue-100 text-blue-800' : 
                                           ($status == 'ongoing' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                        <i class="fas fa-circle mr-1 text-xs"></i>
                                        {{ $status == 'upcoming' ? 'Akan Datang' : ($status == 'ongoing' ? 'Sedang Berlangsung' : 'Selesai') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.agenda.edit', $item) }}" 
                                           class="text-indigo-600 hover:text-indigo-800 p-2 rounded-lg hover:bg-indigo-50 transition-colors duration-150"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.agenda.destroy', $item) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors duration-150"
                                                    onclick="return confirm('Yakin ingin menghapus agenda ini?')"
                                                    title="Hapus">
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
                                        <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                                        <p class="text-lg font-medium text-gray-400">Belum ada agenda</p>
                                        <p class="text-sm text-gray-300">Mulai buat agenda pertama Anda</p>
                                        <a href="{{ route('admin.agenda.create') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                                            Tambah Agenda Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($agenda->hasPages())
                    <div class="mt-6 border-t border-gray-200 pt-6">
                        {{ $agenda->links() }}
                    </div>
                @endif
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
    @apply inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-pink-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:from-purple-700 hover:to-pink-700 active:from-purple-800 active:to-pink-800 focus:outline-none focus:border-purple-900 focus:ring focus:ring-purple-300 disabled:opacity-25 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5;
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
