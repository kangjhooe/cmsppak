@extends('layouts.frontend')

@section('title', 'Galeri - ' . $schoolName)

@php
    $profileData = $profile ?? null;
@endphp

@section('page-header')
    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-3">Galeri Foto & Video</h1>
    <p class="text-xl text-blue-100 max-w-3xl mx-auto">
        Dokumentasi kegiatan dan momen berharga {{ $profile->nama_sekolah ?? $schoolName }}
    </p>
@endsection

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Filter Tabs -->
        <div class="mb-8">
            <!-- Mobile Filter Toggle Button -->
            <button onclick="toggleFilterTabs()" 
                    class="lg:hidden w-full mb-4 bg-gradient-to-r from-green-600 to-green-700 text-white px-6 py-4 rounded-2xl font-bold hover:from-green-700 hover:to-green-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 flex items-center justify-between">
                <span class="flex items-center">
                    <i class="fas fa-filter mr-3"></i>
                    <span>Pilih Tipe Media</span>
                </span>
                <i id="filterTabsToggleIcon" class="fas fa-chevron-down transition-transform duration-300"></i>
            </button>
            
            <div id="filterTabsSection" class="flex justify-center hidden lg:flex">
                <div class="bg-white rounded-lg p-1 shadow-lg">
                    <button class="px-6 py-3 rounded-lg font-medium transition-all duration-200 active-tab" data-type="foto">
                        <i class="fas fa-image mr-2"></i>Foto
                    </button>
                    <button class="px-6 py-3 rounded-lg font-medium transition-all duration-200" data-type="video">
                        <i class="fas fa-video mr-2"></i>Video
                    </button>
                </div>
            </div>
            
            <!-- Mobile Tabs (shown when expanded) -->
            <div id="mobileTabsSection" class="lg:hidden hidden">
                <div class="bg-white rounded-lg p-1 shadow-lg">
                    <button class="w-full px-6 py-3 rounded-lg font-medium transition-all duration-200 active-tab mb-2" data-type="foto">
                        <i class="fas fa-image mr-2"></i>Foto
                    </button>
                    <button class="w-full px-6 py-3 rounded-lg font-medium transition-all duration-200" data-type="video">
                        <i class="fas fa-video mr-2"></i>Video
                    </button>
                </div>
            </div>
        </div>

        <!-- Foto Section -->
        <div id="foto-section" class="tab-content">
            @if($foto->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($foto as $item)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 group">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $item->file_path) }}" 
                                 alt="{{ $item->judul }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <!-- View button overlay -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{ route('galeri.show', $item->id) }}" 
                                   class="bg-white text-gray-900 px-6 py-3 rounded-xl font-semibold shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-green-50">
                                    <i class="fas fa-eye mr-2"></i>
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold text-gray-900 mb-2 hover:text-green-600 transition-colors duration-200 text-lg">{{ $item->judul }}</h3>
                            <p class="text-sm text-gray-600 mb-4 leading-relaxed">{{ Str::limit($item->deskripsi, 80) }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500 border-t border-gray-100 pt-3">
                                <div class="flex items-center">
                                    <i class="fas fa-calendar mr-1"></i>
                                    <span>{{ $item->created_at->format('d-m-Y') }}</span>
                                </div>
                                <a href="{{ route('galeri.show', $item->id) }}" 
                                   class="text-green-600 hover:text-green-800 text-sm font-medium transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @if($foto->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $foto->links() }}
                </div>
                @endif
            @else
                <div class="text-center py-16">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-image text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada foto tersedia</h3>
                    <p class="text-gray-500">Kami akan segera menambahkan foto terbaru untuk Anda</p>
                </div>
            @endif
        </div>

        <!-- Video Section -->
        <div id="video-section" class="tab-content hidden">
            @if($video->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($video as $item)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="h-48 overflow-hidden bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-play-circle text-6xl text-gray-400"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">{{ $item->judul }}</h3>
                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($item->deskripsi, 80) }}</p>
                            <a href="{{ route('galeri.show', $item->id) }}" 
                               class="text-green-600 hover:text-green-800 text-sm font-medium transition-colors duration-200">
                                Tonton Video <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @if($video->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $video->links() }}
                </div>
                @endif
            @else
                <div class="text-center py-16">
                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-video text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada video tersedia</h3>
                    <p class="text-gray-500">Kami akan segera menambahkan video terbaru untuk Anda</p>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
// Toggle filter tabs for mobile
function toggleFilterTabs() {
    const mobileTabsSection = document.getElementById('mobileTabsSection');
    const toggleIcon = document.getElementById('filterTabsToggleIcon');
    
    if (mobileTabsSection) {
        mobileTabsSection.classList.toggle('hidden');
        if (toggleIcon) {
            if (mobileTabsSection.classList.contains('hidden')) {
                toggleIcon.classList.remove('fa-chevron-up');
                toggleIcon.classList.add('fa-chevron-down');
            } else {
                toggleIcon.classList.remove('fa-chevron-down');
                toggleIcon.classList.add('fa-chevron-up');
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('[data-type]');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active-tab'));
            tabContents.forEach(tc => tc.classList.add('hidden'));
            
            // Add active class to clicked tab
            this.classList.add('active-tab');
            document.getElementById(type + '-section').classList.remove('hidden');
            
            // Close mobile tabs after selection
            if (window.innerWidth < 1024) {
                const mobileTabsSection = document.getElementById('mobileTabsSection');
                const toggleIcon = document.getElementById('filterTabsToggleIcon');
                if (mobileTabsSection) {
                    mobileTabsSection.classList.add('hidden');
                    if (toggleIcon) {
                        toggleIcon.classList.remove('fa-chevron-up');
                        toggleIcon.classList.add('fa-chevron-down');
                    }
                }
            }
        });
    });
    
    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const mobileTabsSection = document.getElementById('mobileTabsSection');
            if (window.innerWidth >= 1024) {
                if (mobileTabsSection) {
                    mobileTabsSection.classList.add('hidden');
                }
            }
        }, 250);
    });
});
</script>
@endpush

@push('styles')
<style>
.active-tab {
    background-color: var(--color-primary);
    color: white;
}
</style>
@endpush
@endsection
