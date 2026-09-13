@extends('layouts.frontend')

@section('title', 'Guru & Staf - ' . $schoolName)

@section('page-header')
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Guru & Staf</h1>
    <p class="text-xl text-blue-100 max-w-3xl mx-auto">
        Tim pengajar dan tenaga kependidikan yang profesional dan berdedikasi tinggi
    </p>
@endsection

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search and Filter Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <form action="{{ route('guru-staf') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Cari guru atau staf..." 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    </div>
                </div>
                <div class="flex gap-3">
                    <select name="jabatan" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <option value="">Semua Jabatan</option>
                        <option value="kepala_sekolah" {{ request('jabatan') == 'kepala_sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                        <option value="wakil_kepala_sekolah" {{ request('jabatan') == 'wakil_kepala_sekolah' ? 'selected' : '' }}>Wakil Kepala Sekolah</option>
                        <option value="guru" {{ request('jabatan') == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="staf_tu" {{ request('jabatan') == 'staf_tu' ? 'selected' : '' }}>Staf TU</option>
                        <option value="staf_lainnya" {{ request('jabatan') == 'staf_lainnya' ? 'selected' : '' }}>Staf Lainnya</option>
                    </select>
                    <select name="status" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg transition-all duration-200 font-medium">
                        <i class="fas fa-search mr-2"></i>
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Featured Staff -->
        @if(isset($guruStaf) && $guruStaf->count() > 0)
            @if($guruStaf->where('jabatan', 'kepala_sekolah')->first())
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Kepala Sekolah</h2>
                <div class="bg-white rounded-xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300 max-w-4xl mx-auto">
                    <div class="md:flex">
                        <div class="md:w-1/3">
                            @if($guruStaf->where('jabatan', 'kepala_sekolah')->first()->foto)
                                <img src="{{ asset('storage/' . $guruStaf->where('jabatan', 'kepala_sekolah')->first()->foto) }}" 
                                     alt="{{ $guruStaf->where('jabatan', 'kepala_sekolah')->first()->nama_lengkap }}" 
                                     class="w-full h-64 md:h-full object-cover">
                            @else
                                <div class="w-full h-64 md:h-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-6xl text-gray-400"></i>
                                </div>
                            @endif
                        </div>
                        <div class="md:w-2/3 p-8">
                            <div class="mb-4">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                    Kepala Sekolah
                                </span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                {{ $guruStaf->where('jabatan', 'kepala_sekolah')->first()->nama_lengkap }}
                            </h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($guruStaf->where('jabatan', 'kepala_sekolah')->first()->biodata, 200) }}</p>
                            
                            <div class="space-y-2 text-sm text-gray-600">
                                @if($guruStaf->where('jabatan', 'kepala_sekolah')->first()->nip)
                                <div class="flex items-center">
                                    <i class="fas fa-id-card mr-3 w-4"></i>
                                    <span>NIP: {{ $guruStaf->where('jabatan', 'kepala_sekolah')->first()->nip }}</span>
                                </div>
                                @endif
                                @if($guruStaf->where('jabatan', 'kepala_sekolah')->first()->mata_pelajaran)
                                <div class="flex items-center">
                                    <i class="fas fa-graduation-cap mr-3 w-4"></i>
                                    <span>{{ $guruStaf->where('jabatan', 'kepala_sekolah')->first()->mata_pelajaran }}</span>
                                </div>
                                @endif
                                @if($guruStaf->where('jabatan', 'kepala_sekolah')->first()->email)
                                <div class="flex items-center">
                                    <i class="fas fa-envelope mr-3 w-4"></i>
                                    <span>{{ $guruStaf->where('jabatan', 'kepala_sekolah')->first()->email }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- All Staff Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($guruStaf as $staff)
                    @if($staff->jabatan != 'kepala_sekolah')
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 group">
                        <div class="relative">
                            @if($staff->foto)
                                <img src="{{ asset('storage/' . $staff->foto) }}" 
                                     alt="{{ $staff->nama_lengkap }}" 
                                     class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-4xl text-gray-400"></i>
                                </div>
                            @endif
                            <div class="absolute top-3 right-3">
                                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                                    {{ ucfirst(str_replace('_', ' ', $staff->jabatan)) }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors duration-200">
                                {{ $staff->nama_lengkap }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($staff->biodata, 100) }}</p>
                            
                            <div class="space-y-1 text-xs text-gray-500">
                                @if($staff->nip)
                                <div class="flex items-center">
                                    <i class="fas fa-id-card mr-2 w-3"></i>
                                    <span>NIP: {{ $staff->nip }}</span>
                                </div>
                                @endif
                                @if($staff->mata_pelajaran)
                                <div class="flex items-center">
                                    <i class="fas fa-graduation-cap mr-2 w-3"></i>
                                    <span>{{ $staff->mata_pelajaran }}</span>
                                </div>
                                @endif
                                @if($staff->email)
                                <div class="flex items-center">
                                    <i class="fas fa-envelope mr-2 w-3"></i>
                                    <span>{{ $staff->email }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

            <!-- Pagination -->
            @if($guruStaf->hasPages())
            <div class="mt-12">
                {{ $guruStaf->links() }}
            </div>
            @endif
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-users text-6xl"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada data guru & staf</h3>
                <p class="text-gray-600">Data guru dan staf akan ditampilkan di sini.</p>
            </div>
        @endif
    </div>
</div>
@endsection
