@extends('layouts.frontend')

@section('title', 'Agenda - ' . $schoolName)

@section('page-header')
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Agenda & Kegiatan</h1>
    <p class="text-xl text-blue-100 max-w-3xl mx-auto">
        Informasi lengkap tentang agenda, kegiatan, dan event yang akan diselenggarakan di {{ $profile->nama_sekolah ?? $schoolName }}
    </p>
@endsection

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search and Filter Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
            <form action="{{ route('agenda') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Cari agenda..." 
                               class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                    </div>
                </div>
                <div class="flex gap-3">
                    <select name="jenis" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <option value="">Semua Jenis</option>
                        <option value="akademik" {{ request('jenis') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="non-akademik" {{ request('jenis') == 'non-akademik' ? 'selected' : '' }}>Non-Akademik</option>
                        <option value="kegiatan" {{ request('jenis') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                        <option value="event" {{ request('jenis') == 'event' ? 'selected' : '' }}>Event</option>
                    </select>
                    <select name="status" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <option value="">Semua Status</option>
                        <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                        <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg transition-all duration-200 font-medium">
                        <i class="fas fa-search mr-2"></i>
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Featured Agenda -->
        @if(isset($agenda) && $agenda->count() > 0)
            @if($agenda->first()->gambar)
            <div class="mb-12">
                <div class="bg-white rounded-xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-300">
                    <div class="md:flex">
                        <div class="md:w-1/2">
                            <img src="{{ asset('storage/' . $agenda->first()->gambar) }}" 
                                 alt="{{ $agenda->first()->judul }}" 
                                 class="w-full h-64 md:h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="md:w-1/2 p-8">
                            <div class="flex items-center mb-3">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium mr-3">
                                    {{ ucfirst($agenda->first()->jenis) }}
                                </span>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">
                                    @switch($agenda->first()->auto_status)
                                        @case('upcoming')
                                            Akan Datang
                                            @break
                                        @case('ongoing')
                                            Sedang Berlangsung
                                            @break
                                        @case('completed')
                                            Selesai
                                            @break
                                        @case('cancelled')
                                            Dibatalkan
                                            @break
                                        @default
                                            {{ ucfirst($agenda->first()->status ?? 'Akan Datang') }}
                                    @endswitch
                                </span>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4 hover:text-blue-600 transition-colors duration-200">
                                {{ $agenda->first()->judul }}
                            </h2>
                            <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit(strip_tags($agenda->first()->deskripsi), 200) }}</p>
                            
                            <div class="space-y-3 mb-6">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-calendar mr-3 w-4"></i>
                                    <span>{{ $agenda->first()->tanggal_mulai ? $agenda->first()->tanggal_mulai->format('d-m-Y') : '-' }}</span>
                                    @if($agenda->first()->tanggal_selesai && $agenda->first()->tanggal_selesai != $agenda->first()->tanggal_mulai)
                                        <span class="mx-2">s/d</span>
                                        <span>{{ $agenda->first()->tanggal_selesai ? $agenda->first()->tanggal_selesai->format('d-m-Y') : '-' }}</span>
                                    @endif
                                </div>
                                @if($agenda->first()->waktu)
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-clock mr-3 w-4"></i>
                                    <span>{{ $agenda->first()->waktu }}</span>
                                </div>
                                @endif
                                @if($agenda->first()->lokasi)
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt mr-3 w-4"></i>
                                    <span>{{ $agenda->first()->lokasi }}</span>
                                </div>
                                @endif
                            </div>
                            
                            <a href="{{ route('agenda.show', $agenda->first()->id) }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-all duration-200 font-medium">
                                <i class="fas fa-info-circle mr-2"></i>
                                Detail Agenda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Agenda Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($agenda->skip(1) as $item)
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 {{ $item->auto_status === 'completed' ? 'opacity-75' : '' }}">
                    @if($item->gambar)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->gambar) }}" 
                             alt="{{ $item->judul }}" 
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    @else
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-4xl text-gray-400"></i>
                    </div>
                    @endif
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">
                                {{ ucfirst($item->jenis) }}
                            </span>
                            @switch($item->auto_status)
                                @case('upcoming')
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full">
                                        Akan Datang
                                    </span>
                                    @break
                                @case('ongoing')
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1 rounded-full">
                                        Sedang Berlangsung
                                    </span>
                                    @break
                                @case('completed')
                                    <span class="bg-gray-100 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">
                                        <i class="fas fa-check-circle mr-1"></i>Selesai
                                    </span>
                                    @break
                                @case('cancelled')
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-3 py-1 rounded-full">
                                        <i class="fas fa-times-circle mr-1"></i>Dibatalkan
                                    </span>
                                    @break
                                @default
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full">
                                        {{ ucfirst($item->status ?? 'Akan Datang') }}
                                    </span>
                            @endswitch
                        </div>
                        
                        <h3 class="text-lg font-semibold {{ $item->auto_status === 'completed' ? 'text-gray-600' : 'text-gray-900' }} mb-3 hover:text-blue-600 transition-colors duration-200">
                            <a href="{{ route('agenda.show', $item->id) }}">{{ $item->judul }}</a>
                        </h3>
                        
                        <p class="text-gray-600 mb-4 leading-relaxed">{{ Str::limit(strip_tags($item->deskripsi), 120) }}</p>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-calendar mr-2 w-4"></i>
                                <span>{{ $item->tanggal_mulai ? $item->tanggal_mulai->format('d-m-Y') : '-' }}</span>
                            </div>
                            @if($item->waktu)
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-clock mr-2 w-4"></i>
                                <span>{{ $item->waktu }}</span>
                            </div>
                            @endif
                            @if($item->lokasi)
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-map-marker-alt mr-2 w-4"></i>
                                <span>{{ Str::limit($item->lokasi, 30) }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <a href="{{ route('agenda.show', $item->id) }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm transition-colors duration-200">
                            Detail Agenda <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($agenda->hasPages())
            <div class="mt-12 flex justify-center">
                <nav class="flex items-center space-x-2">
                    @if($agenda->onFirstPage())
                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $agenda->previousPageUrl() }}" class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    @foreach($agenda->getUrlRange(1, $agenda->lastPage()) as $page => $url)
                        @if($page == $agenda->currentPage())
                            <span class="px-3 py-2 text-white bg-blue-600 rounded-lg">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($agenda->hasMorePages())
                        <a href="{{ $agenda->nextPageUrl() }}" class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </nav>
            </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-calendar-alt text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada agenda tersedia</h3>
                <p class="text-gray-500 mb-6">Kami akan segera menambahkan agenda terbaru untuk Anda</p>
                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-home mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
