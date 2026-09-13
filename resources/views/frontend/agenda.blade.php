@extends('layouts.frontend')

@section('title', 'Agenda - ' . $schoolName)

@php
    $profileData = $profile ?? null;
    
    // Helper function untuk nama bulan Indonesia
    function getBulanIndonesia($month) {
        $bulan = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Ags',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];
        return $bulan[$month] ?? 'Jan';
    }
@endphp

@section('page-header')
    <div class="text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: var(--color-text-primary);">
            Agenda & Kegiatan
        </h1>
        <p class="text-xl max-w-3xl mx-auto" style="color: var(--color-text-secondary);">
            Lihat jadwal kegiatan dan agenda terbaru {{ $profile->nama_sekolah ?? $schoolName }}
        </p>
    </div>
@endsection

@section('content')
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search and Filter Section -->
        <div class="mb-8">
            <!-- Mobile Filter Toggle Button -->
            <button onclick="toggleFilterSection()" 
                    class="lg:hidden w-full mb-4 bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-4 rounded-2xl font-bold hover:from-green-700 hover:to-green-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-between">
                <span class="flex items-center">
                    <i class="fas fa-filter mr-3"></i>
                    <span>Filter & Pencarian</span>
                    @if(request('search') || request('bulan'))
                        <span class="ml-3 px-2 py-1 bg-white/30 rounded-full text-xs font-semibold">
                            Aktif
                        </span>
                    @endif
                </span>
                <i id="filterToggleIcon" class="fas fa-chevron-down transition-transform duration-300"></i>
            </button>
            
            <div id="filterSection" class="bg-white rounded-2xl shadow-xl p-6 hidden lg:block">
                <form action="{{ route('agenda') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-blue-500"></i>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Cari agenda..." 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    </div>
                </div>
                <div class="flex gap-3">
                    <select name="bulan" class="px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-900 bg-white">
                        <option value="" class="text-gray-900">Semua Bulan</option>
                        <option value="1" {{ request('bulan') == '1' ? 'selected' : '' }} class="text-gray-900">Januari</option>
                        <option value="2" {{ request('bulan') == '2' ? 'selected' : '' }} class="text-gray-900">Februari</option>
                        <option value="3" {{ request('bulan') == '3' ? 'selected' : '' }} class="text-gray-900">Maret</option>
                        <option value="4" {{ request('bulan') == '4' ? 'selected' : '' }} class="text-gray-900">April</option>
                        <option value="5" {{ request('bulan') == '5' ? 'selected' : '' }} class="text-gray-900">Mei</option>
                        <option value="6" {{ request('bulan') == '6' ? 'selected' : '' }} class="text-gray-900">Juni</option>
                        <option value="7" {{ request('bulan') == '7' ? 'selected' : '' }} class="text-gray-900">Juli</option>
                        <option value="8" {{ request('bulan') == '8' ? 'selected' : '' }} class="text-gray-900">Agustus</option>
                        <option value="9" {{ request('bulan') == '9' ? 'selected' : '' }} class="text-gray-900">September</option>
                        <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }} class="text-gray-900">Oktober</option>
                        <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }} class="text-gray-900">November</option>
                        <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }} class="text-gray-900">Desember</option>
                    </select>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-medium rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-200 transform hover:scale-105 shadow-lg">
                        <i class="fas fa-filter mr-2"></i>
                        Filter
                    </button>
                </div>
                </form>
            </div>
        </div>

        @if($agenda->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($agenda as $event)
                    <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden {{ $event->auto_status === 'completed' ? 'opacity-75' : '' }}">
                        <!-- Status Indicator Bar -->
                        <div class="h-2 w-full 
                            @switch($event->auto_status)
                                @case('upcoming') bg-green-500 @break
                                @case('ongoing') bg-blue-500 @break
                                @case('completed') bg-gray-400 @break
                                @case('cancelled') bg-red-500 @break
                                @default bg-green-500
                            @endswitch
                        "></div>
                        
                        <div class="relative p-6">
                            <!-- Header Section -->
                            <div class="flex items-start justify-between mb-5">
                                <div class="flex items-center space-x-3">
                                    <div class="w-14 h-14 bg-gradient-to-br from-green-600 to-green-700 rounded-xl flex items-center justify-center shadow-md">
                                        <i class="fas fa-calendar-alt text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-medium
                                            @if($event->jenis == 'akademik')
                                                bg-green-100 text-green-800
                                            @elseif($event->jenis == 'non-akademik')
                                                bg-yellow-100 text-yellow-800
                                            @else
                                                bg-blue-100 text-blue-800
                                            @endif
                                        ">
                                            <i class="fas fa-{{ $event->jenis == 'akademik' ? 'graduation-cap' : ($event->jenis == 'non-akademik' ? 'users' : 'star') }} mr-2"></i>
                                            {{ ucfirst($event->jenis ?? 'Event') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Status Badge -->
                                <div class="flex flex-col items-end">
                                    @switch($event->auto_status)
                                        @case('upcoming')
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-green-100 text-green-800">
                                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                                Akan Datang
                                            </span>
                                            @break
                                        @case('ongoing')
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-blue-100 text-blue-800">
                                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                                                Sedang Berlangsung
                                            </span>
                                            @break
                                        @case('completed')
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-gray-100 text-gray-600">
                                                <i class="fas fa-check-circle mr-2"></i>
                                                Selesai
                                            </span>
                                            @break
                                        @case('cancelled')
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-2"></i>
                                                Dibatalkan
                                            </span>
                                            @break
                                        @default
                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold bg-green-100 text-green-800">
                                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                                {{ ucfirst($event->status ?? 'Akan Datang') }}
                                            </span>
                                    @endswitch
                                </div>
                            </div>
                            
                            <!-- Title -->
                            <h3 class="text-xl font-bold text-gray-900 mb-4 leading-tight">
                                {{ $event->judul }}
                            </h3>
                            
                            <!-- Event Details -->
                            <div class="space-y-3 mb-5">
                                <!-- Date & Time -->
                                <div class="flex items-center text-gray-700 bg-gray-50 rounded-lg p-3">
                                    <div class="w-8 h-8 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-calendar-day text-green-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 text-sm">
                                            {{ $event->tanggal_mulai ? $event->tanggal_mulai->format('d-m-Y') : 'Tanggal belum ditentukan' }}
                                        </div>
                                        @if($event->waktu_mulai)
                                            <div class="text-xs text-gray-600">
                                                {{ $event->waktu_mulai }} 
                                                @if($event->waktu_selesai)
                                                    - {{ $event->waktu_selesai }}
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Location -->
                                @if($event->lokasi)
                                <div class="flex items-center text-gray-700 bg-gray-50 rounded-lg p-3">
                                    <div class="w-8 h-8 bg-gradient-to-br from-green-100 to-emerald-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-map-marker-alt text-green-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 text-sm">Lokasi</div>
                                        <div class="text-xs text-gray-600">{{ $event->lokasi }}</div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Description -->
                            <div class="mb-5">
                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                                    {{ Str::limit($event->deskripsi, 100) }}
                                </p>
                            </div>
                            
                            <!-- Action Button -->
                            <div class="flex items-center justify-between">
                                <a href="{{ route('agenda.show', $event->id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-medium rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 transform hover:scale-105 shadow-md text-sm">
                                    <span>Lihat Detail</span>
                                    <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                </a>
                                
                                <!-- Additional Info -->
                                @if($event->peserta)
                                <div class="text-right">
                                    <div class="text-xs text-gray-500 font-medium">Peserta</div>
                                    <div class="text-sm font-semibold text-gray-800">{{ $event->peserta }}</div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($agenda->hasPages())
            <div class="mt-12 flex justify-center">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-4 border border-white/20">
                    {{ $agenda->links() }}
                </div>
            </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="mx-auto w-32 h-32 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mb-6 shadow-lg">
                    <i class="fas fa-calendar-alt text-5xl text-blue-500"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum ada agenda tersedia</h3>
                <p class="text-gray-600 mb-8 text-lg">Kami akan segera menambahkan agenda terbaru untuk Anda</p>
                <a href="{{ route('home') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-medium rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-home mr-3"></i>
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
// Toggle filter section for mobile
function toggleFilterSection() {
    const filterSection = document.getElementById('filterSection');
    const toggleIcon = document.getElementById('filterToggleIcon');
    
    if (filterSection) {
        if (filterSection.classList.contains('hidden')) {
            filterSection.classList.remove('hidden');
            if (toggleIcon) {
                toggleIcon.classList.remove('fa-chevron-down');
                toggleIcon.classList.add('fa-chevron-up');
            }
        } else {
            if (window.innerWidth < 1024) {
                filterSection.classList.add('hidden');
                if (toggleIcon) {
                    toggleIcon.classList.remove('fa-chevron-up');
                    toggleIcon.classList.add('fa-chevron-down');
                }
            }
        }
    }
}

// Handle window resize for filter section
document.addEventListener('DOMContentLoaded', function() {
    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const filterSection = document.getElementById('filterSection');
            if (window.innerWidth >= 1024) {
                // Desktop: always show
                filterSection.classList.remove('hidden');
            }
            // Mobile: always hidden by default (user must click toggle to show)
        }, 250);
    });
});
</script>
@endpush
@endsection
