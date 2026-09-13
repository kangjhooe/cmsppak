@extends('layouts.frontend')

@section('title', 'Guru & Staf - ' . $schoolName)

@section('page-header')
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Guru & Staf</h1>
    <p class="text-xl text-blue-100 max-w-3xl mx-auto">
        Tim pengajar dan tenaga kependidikan yang profesional dan berdedikasi tinggi
    </p>
@endsection

@section('content')
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .float-animation {
        animation: float 6s ease-in-out infinite;
    }
    
    .glass-effect {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .card-hover-effect {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .card-hover-effect:hover {
        transform: translateY(-8px) scale(1.02);
    }
</style>

<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search and Filter Section -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-12 border border-gray-100">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Cari & Filter</h2>
                <p class="text-gray-600">Temukan guru dan staf yang Anda cari</p>
            </div>
            
            <form action="{{ route('guru-staf') }}" method="GET" class="flex flex-col lg:flex-row gap-6">
                <div class="flex-1">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 group-focus-within:text-blue-500 transition-colors duration-200"></i>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Cari nama guru atau staf..." 
                               class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 text-lg bg-gray-50 focus:bg-white">
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="relative">
                        <select name="jabatan" class="px-6 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 text-gray-900 bg-gray-50 focus:bg-white text-lg min-w-[200px]">
                            <option value="" class="text-gray-900">Semua Jabatan</option>
                            @foreach($jabatan as $jabatanItem)
                                <option value="{{ $jabatanItem }}" {{ request('jabatan') == $jabatanItem ? 'selected' : '' }} class="text-gray-900">
                                    {{ ucwords(str_replace('_', ' ', $jabatanItem)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl transition-all duration-300 font-semibold transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-search mr-2"></i>
                            Cari
                        </button>
                        @if(request('search') || request('jabatan'))
                        <a href="{{ route('guru-staf') }}" class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white px-6 py-4 rounded-xl transition-all duration-300 font-semibold transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <i class="fas fa-times mr-2"></i>
                            Reset
                        </a>
                        @endif
                    </div>
                </div>
            </form>
            
            @if(request('search') || request('jabatan'))
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Filter Aktif:</h3>
                <div class="flex flex-wrap gap-3">
                    @if(request('search'))
                    <span class="bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 px-4 py-2 rounded-full text-sm font-medium shadow-sm border border-blue-200">
                        <i class="fas fa-search mr-2"></i>
                        Pencarian: "{{ request('search') }}"
                    </span>
                    @endif
                    @if(request('jabatan'))
                    <span class="bg-gradient-to-r from-green-100 to-green-200 text-green-800 px-4 py-2 rounded-full text-sm font-medium shadow-sm border border-green-200">
                        <i class="fas fa-filter mr-2"></i>
                        Jabatan: {{ ucwords(str_replace('_', ' ', request('jabatan'))) }}
                    </span>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 text-center transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden card-hover-effect float-animation">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-blue-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-users text-2xl text-white"></i>
                    </div>
                    <div class="text-4xl font-bold text-blue-600 mb-2 group-hover:text-blue-700 transition-colors duration-300">{{ $totalGuruStaf }}</div>
                    <div class="text-gray-600 font-medium">Total Guru & Staf</div>
                </div>
            </div>
            
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 text-center transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden card-hover-effect float-animation" style="animation-delay: 0.2s;">
                <div class="absolute inset-0 bg-gradient-to-br from-green-50 to-green-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-chalkboard-teacher text-2xl text-white"></i>
                    </div>
                    <div class="text-4xl font-bold text-green-600 mb-2 group-hover:text-green-700 transition-colors duration-300">{{ $totalGuru }}</div>
                    <div class="text-gray-600 font-medium">Guru</div>
                </div>
            </div>
            
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl p-8 text-center transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 overflow-hidden card-hover-effect float-animation" style="animation-delay: 0.4s;">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-50 to-purple-100 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-user-tie text-2xl text-white"></i>
                    </div>
                    <div class="text-4xl font-bold text-purple-600 mb-2 group-hover:text-purple-700 transition-colors duration-300">{{ $totalStaf }}</div>
                    <div class="text-gray-600 font-medium">Staf</div>
                </div>
            </div>
        </div>

        <!-- Featured Staff -->
        @if($guruStaf->count() > 0)
            @php
                $kepalaSekolah = $guruStaf->where('jabatan', 'kepala_sekolah')->first();
            @endphp
            
            @if($kepalaSekolah)
            <div class="mb-16">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Kepala Sekolah</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-purple-600 mx-auto rounded-full"></div>
                </div>
                
                <div class="group relative bg-white rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500 max-w-5xl mx-auto border border-gray-100 card-hover-effect">
                    <!-- Gradient Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="relative md:flex">
                        <!-- Image Section -->
                        <div class="md:w-2/5 relative">
                            @if($kepalaSekolah->foto)
                                <img src="{{ asset('storage/' . $kepalaSekolah->foto) }}" 
                                     alt="{{ $kepalaSekolah->nama_lengkap }}" 
                                     class="w-full aspect-square object-cover group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="w-full aspect-square bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-user text-8xl text-gray-400 mb-4"></i>
                                        <p class="text-sm text-gray-500">Foto tidak tersedia</p>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Decorative Elements -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-100/30 to-purple-100/30 rounded-full -translate-y-16 translate-x-16 group-hover:scale-150 transition-transform duration-700"></div>
                            <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-purple-100/30 to-blue-100/30 rounded-full translate-y-12 -translate-x-12 group-hover:scale-150 transition-transform duration-700"></div>
                        </div>
                        
                        <!-- Content Section -->
                        <div class="md:w-3/5 p-8 md:p-12">
                            <!-- Position Badge -->
                            <div class="mb-6">
                                <span class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                    <i class="fas fa-crown mr-2"></i>
                                    Kepala Sekolah
                                </span>
                            </div>
                            
                            <!-- Name -->
                            <h3 class="text-3xl font-bold text-gray-900 mb-4 group-hover:text-blue-700 transition-colors duration-300">
                                {{ $kepalaSekolah->nama_lengkap }}
                            </h3>
                            
                            <!-- Bio -->
                            <p class="text-gray-600 mb-6 leading-relaxed text-lg">
                                {{ $kepalaSekolah->biodata ?? 'Kepala Sekolah ' . ($profile->nama_sekolah ?? $schoolName) . ' yang berdedikasi tinggi dalam memajukan pendidikan dan membentuk karakter santri yang unggul.' }}
                            </p>
                            
                            <!-- Contact Info -->
                            <div class="space-y-3 mb-8">
                                @if($kepalaSekolah->nip)
                                <div class="flex items-center bg-gray-50 rounded-xl py-3 px-4">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-id-card text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">NIP</p>
                                        <p class="font-semibold text-gray-900">{{ $kepalaSekolah->nip }}</p>
                                    </div>
                                </div>
                                @endif
                                
                                @if($kepalaSekolah->mata_pelajaran)
                                <div class="flex items-center bg-gray-50 rounded-xl py-3 px-4">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-graduation-cap text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Mata Pelajaran</p>
                                        <p class="font-semibold text-gray-900">{{ $kepalaSekolah->mata_pelajaran }}</p>
                                    </div>
                                </div>
                                @endif
                                
                                @if($kepalaSekolah->email)
                                <div class="flex items-center bg-gray-50 rounded-xl py-3 px-4">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-envelope text-purple-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Email</p>
                                        <p class="font-semibold text-gray-900">{{ $kepalaSekolah->email }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Action Button -->
                            <button onclick="showStaffDetail('{{ $kepalaSekolah->id }}')" 
                                    class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <i class="fas fa-user-circle mr-2"></i>
                                Lihat Profil Lengkap
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Staff Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($guruStaf->where('jabatan', '!=', 'kepala_sekolah') as $staff)
                <article class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-gray-100 card-hover-effect">
                    <!-- Gradient Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <!-- Image Container -->
                    <div class="relative aspect-square overflow-hidden">
                        @if($staff->foto)
                            <img src="{{ asset('storage/' . $staff->foto) }}" 
                                 alt="{{ $staff->nama_lengkap }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-user text-5xl text-gray-400 mb-2"></i>
                                    <p class="text-xs text-gray-500">Foto tidak tersedia</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Position Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur-sm text-blue-700 text-xs font-semibold px-3 py-1.5 rounded-full shadow-lg border border-blue-200">
                                {{ ucwords(str_replace('_', ' ', $staff->jabatan)) }}
                            </span>
                        </div>
                        
                        <!-- Action Button Overlay -->
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all duration-300 flex items-center justify-center">
                            <button onclick="showStaffDetail('{{ $staff->id }}')" 
                                    class="bg-white/95 backdrop-blur-sm text-gray-900 px-6 py-3 rounded-xl font-semibold opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0 shadow-xl hover:shadow-2xl hover:bg-white">
                                <i class="fas fa-eye mr-2"></i>
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="relative p-4">
                        <!-- Name -->
                        <h3 class="font-bold text-gray-900 mb-1 text-center text-base group-hover:text-blue-700 transition-colors duration-300">
                            {{ $staff->nama_lengkap }}
                        </h3>
                        
                        <!-- Position -->
                        <p class="text-xs text-gray-600 mb-2 text-center font-medium">
                            {{ ucwords(str_replace('_', ' ', $staff->jabatan)) }}
                        </p>
                        
                        <!-- Subject Badge -->
                        @if($staff->mata_pelajaran)
                        <div class="text-center mb-2">
                            <span class="bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full border border-blue-200">
                                <i class="fas fa-graduation-cap mr-1"></i>
                                {{ $staff->mata_pelajaran }}
                            </span>
                        </div>
                        @endif
                        
                        <!-- Contact Info -->
                        <div class="space-y-1 text-xs text-gray-500">
                            @if($staff->nip)
                            <div class="flex items-center justify-center bg-gray-50 rounded-lg py-1 px-2">
                                <i class="fas fa-id-card mr-1 w-3 text-blue-500"></i>
                                <span class="font-medium text-xs">{{ $staff->nip }}</span>
                            </div>
                            @endif
                            @if($staff->email)
                            <div class="flex items-center justify-center bg-gray-50 rounded-lg py-1 px-2">
                                <i class="fas fa-envelope mr-1 w-3 text-green-500"></i>
                                <span class="truncate font-medium text-xs">{{ $staff->email }}</span>
                            </div>
                            @endif
                            @if($staff->telepon)
                            <div class="flex items-center justify-center bg-gray-50 rounded-lg py-1 px-2">
                                <i class="fas fa-phone mr-1 w-3 text-purple-500"></i>
                                <span class="font-medium text-xs">{{ $staff->telepon }}</span>
                            </div>
                            @endif
                        </div>
                        
                    </div>
                    
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-12 h-12 bg-gradient-to-br from-blue-100/50 to-purple-100/50 rounded-full -translate-y-6 translate-x-6 group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="absolute bottom-0 left-0 w-10 h-10 bg-gradient-to-tr from-purple-100/50 to-blue-100/50 rounded-full translate-y-5 -translate-x-5 group-hover:scale-150 transition-transform duration-700"></div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($guruStaf->hasPages())
            <div class="mt-16 flex justify-center">
                <nav class="flex items-center space-x-3">
                    @if($guruStaf->onFirstPage())
                        <span class="px-4 py-3 text-gray-400 bg-gray-100 rounded-xl cursor-not-allowed shadow-sm">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $guruStaf->previousPageUrl() }}" class="px-4 py-3 text-gray-600 bg-white border-2 border-gray-200 rounded-xl hover:bg-gray-50 hover:border-blue-300 transition-all duration-300 shadow-sm hover:shadow-md">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    @foreach($guruStaf->getUrlRange(1, $guruStaf->lastPage()) as $page => $url)
                        @if($page == $guruStaf->currentPage())
                            <span class="px-4 py-3 text-white bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl shadow-lg font-semibold">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-3 text-gray-600 bg-white border-2 border-gray-200 rounded-xl hover:bg-gray-50 hover:border-blue-300 transition-all duration-300 shadow-sm hover:shadow-md font-medium">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($guruStaf->hasMorePages())
                        <a href="{{ $guruStaf->nextPageUrl() }}" class="px-4 py-3 text-gray-600 bg-white border-2 border-gray-200 rounded-xl hover:bg-gray-50 hover:border-blue-300 transition-all duration-300 shadow-sm hover:shadow-md">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="px-4 py-3 text-gray-400 bg-gray-100 rounded-xl cursor-not-allowed shadow-sm">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </nav>
            </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="mx-auto w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center mb-8 shadow-lg">
                    <i class="fas fa-users text-6xl text-gray-400"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Belum ada data guru & staf tersedia</h3>
                <p class="text-gray-600 mb-8 text-lg max-w-md mx-auto">Kami akan segera menambahkan informasi guru dan staf terbaru untuk memberikan pengalaman yang lebih baik</p>
                <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-lg font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i class="fas fa-home mr-3"></i>
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Staff Detail Modal -->
<div id="staffModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 w-full max-w-4xl">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6 text-white">
                <div class="flex justify-between items-center">
                    <h3 class="text-2xl font-bold">Detail Profil</h3>
                    <button onclick="closeStaffModal()" class="bg-white/20 hover:bg-white/30 text-white p-2 rounded-xl transition-all duration-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Modal Content -->
            <div class="p-8" id="staffModalContent">
                <!-- Content will be loaded here -->
            </div>
            
            <!-- Modal Footer -->
            <div class="bg-gray-50 px-8 py-6 text-center">
                <button onclick="closeStaffModal()" class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-times mr-2"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Data staff untuk modal (akan diisi dari server)
const staffData = @json($guruStaf->items());

function showStaffDetail(staffId) {
    // Show modal
    document.getElementById('staffModal').classList.remove('hidden');
    
    // Find staff data
    const staff = staffData.find(s => s.id == staffId);
    
    if (staff) {
        // Generate modal content
        let modalContent = `
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-2/5">
                    <div class="relative group">
                        ${staff.foto ? 
                            `<img src="/storage/${staff.foto}" alt="${staff.nama_lengkap}" class="w-full aspect-square object-cover rounded-2xl shadow-xl group-hover:scale-105 transition-transform duration-500">` :
                            `<div class="w-full aspect-square bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl shadow-xl flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-user text-8xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-500">Foto tidak tersedia</p>
                                </div>
                            </div>`
                        }
                        <!-- Decorative elements -->
                        <div class="absolute top-4 right-4 w-16 h-16 bg-gradient-to-br from-blue-100/50 to-purple-100/50 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                        <div class="absolute bottom-4 left-4 w-12 h-12 bg-gradient-to-tr from-purple-100/50 to-blue-100/50 rounded-full group-hover:scale-150 transition-transform duration-700"></div>
                    </div>
                </div>
                <div class="lg:w-3/5">
                    <div class="mb-6">
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                            <i class="fas fa-user-tag mr-2"></i>
                            ${staff.jabatan.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())}
                        </span>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">${staff.nama_lengkap}</h3>
                    
                    <div class="space-y-4 mb-8">
                        ${staff.nip ? `
                        <div class="flex items-center bg-gray-50 rounded-xl py-4 px-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-id-card text-blue-600 text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">NIP</p>
                                <p class="text-gray-900 font-semibold text-lg">${staff.nip}</p>
                            </div>
                        </div>
                        ` : ''}
                        
                        ${staff.mata_pelajaran ? `
                        <div class="flex items-center bg-gray-50 rounded-xl py-4 px-4">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-graduation-cap text-green-600 text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Mata Pelajaran</p>
                                <p class="text-gray-900 font-semibold text-lg">${staff.mata_pelajaran}</p>
                            </div>
                        </div>
                        ` : ''}
                        
                        ${staff.email ? `
                        <div class="flex items-center bg-gray-50 rounded-xl py-4 px-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-envelope text-purple-600 text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Email</p>
                                <p class="text-gray-900 font-semibold text-lg">
                                    <a href="mailto:${staff.email}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200">${staff.email}</a>
                                </p>
                            </div>
                        </div>
                        ` : ''}
                        
                        ${staff.telepon ? `
                        <div class="flex items-center bg-gray-50 rounded-xl py-4 px-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-phone text-orange-600 text-lg"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 font-medium">Telepon</p>
                                <p class="text-gray-900 font-semibold text-lg">
                                    <a href="tel:${staff.telepon}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200">${staff.telepon}</a>
                                </p>
                            </div>
                        </div>
                        ` : ''}
                    </div>
                    
                    ${staff.biodata ? `
                    <div class="border-t border-gray-200 pt-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-user-circle mr-3 text-blue-600"></i>
                            Biodata
                        </h4>
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6">
                            <p class="text-gray-700 leading-relaxed text-lg">${staff.biodata}</p>
                        </div>
                    </div>
                    ` : ''}
                </div>
            </div>
        `;
        
        document.getElementById('staffModalContent').innerHTML = modalContent;
    } else {
        // Fallback jika data tidak ditemukan
        document.getElementById('staffModalContent').innerHTML = `
            <div class="text-center py-16">
                <div class="mx-auto w-24 h-24 bg-gradient-to-br from-red-100 to-red-200 rounded-2xl flex items-center justify-center mb-6">
                    <i class="fas fa-exclamation-triangle text-3xl text-red-500"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Data Tidak Ditemukan</h3>
                <p class="text-gray-600 text-lg">Data staff yang diminta tidak tersedia atau telah dihapus</p>
                <div class="mt-6">
                    <button onclick="closeStaffModal()" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </button>
                </div>
            </div>
        `;
    }
}

function closeStaffModal() {
    document.getElementById('staffModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('staffModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeStaffModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeStaffModal();
    }
});
</script>
@endpush
