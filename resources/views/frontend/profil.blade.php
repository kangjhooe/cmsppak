@extends('layouts.frontend')

@section('title', 'Profil ' . __('school') . ' - ' . $schoolName)

@section('page-header')
            <h1 style="font-size: 1.65rem; font-weight: bold; margin-bottom: 0.75rem; color: white; line-height: 1.25; white-space: normal; overflow: visible; text-overflow: unset; -webkit-line-clamp: unset; display: block; -webkit-box-orient: unset; max-width: none; width: auto; height: auto; min-height: auto; max-height: none;" class="hero-text">{{ $profile->profil_hero_title ?? 'Profil ' . __('school') }}</h1>
    <p style="font-size: 0.98rem; color: #dcfce7; max-width: 64rem; margin: 0 auto; line-height: 1.55; white-space: normal; overflow: visible; text-overflow: unset; -webkit-line-clamp: unset; display: block; -webkit-box-orient: unset; max-width: none; width: auto; height: auto; min-height: auto; max-height: none;" class="hero-text">{{ $profile->profil_hero_subtitle ?? $profile->nama_sekolah ?? $schoolName }}</p>
@endsection

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section dengan Logo -->
        <section class="rounded-2xl shadow-2xl overflow-hidden mb-12" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 50%, var(--color-secondary) 100%);">
            <div class="relative p-12 text-center text-white">
                <div class="absolute inset-0 bg-black opacity-20"></div>
                <div class="relative z-10">
                    <div class="mb-8">
                        <img class="h-32 w-auto mx-auto mb-6 drop-shadow-lg" 
                             src="{{ $profile->logo_url ?? asset('images/default-logo.png') }}" 
                             alt="Logo {{ $profile->nama_sekolah ?? $schoolName }}">
                    </div>
                    <h2 style="font-size: 1.65rem; font-weight: bold; margin-bottom: 0.75rem; color: white; line-height: 1.2; white-space: normal; overflow: visible; text-overflow: unset; -webkit-line-clamp: unset; display: block; -webkit-box-orient: unset; max-width: none; width: auto; height: auto; min-height: auto; max-height: none;" class="hero-text">
                        {{ $profile->profil_hero_subtitle ?? $profile->nama_sekolah ?? $schoolName }}
                    </h2>
                    <p style="font-size: 1.125rem; color: #dcfce7; max-width: 64rem; margin: 0 auto; line-height: 1.6; white-space: normal; overflow: visible; text-overflow: unset; -webkit-line-clamp: unset; display: block; -webkit-box-orient: unset; max-width: none; width: auto; height: auto; min-height: auto; max-height: none;" class="hero-text">
                        {{ $profile->profil_hero_description ?? $profile->alamat ?? '' }}
                    </p>
                    @if($profile->npsn)
                        <div class="mt-4 inline-block bg-white bg-opacity-20 px-4 py-2 rounded-full">
                            <span class="text-sm">{{ __('npsn_label') }}: {{ $profile->npsn }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- {{ __('kepala_sekolah') }} -->
        @if($profile->shouldShowSection('profil_show_principal'))
        @if($profile->foto_kepala_madrasah || $profile->kepala_sekolah)
        <section class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12">
            <div class="bg-gradient-to-r from-yellow-600 to-orange-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-user-tie mr-3"></i>
                    {{ __('kepala_sekolah') }}
                </h2>
            </div>
            <div class="p-8">
                <div class="text-center">
                    @if($profile->foto_kepala_madrasah)
                        <div class="w-48 h-48 rounded-full overflow-hidden mx-auto mb-8 border-6 border-yellow-400 shadow-2xl transform hover:scale-105 transition-transform duration-300">
                            <img src="{{ $profile->foto_kepala_madrasah_url }}" 
                                 alt="{{ $profile->kepala_sekolah ?? __('kepala_sekolah') }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-3">{{ $profile->kepala_sekolah ?? __('kepala_sekolah') }}</h3>
                        <p class="text-lg text-gray-600 mb-6">{{ __('kepala_sekolah') }} {{ $schoolName }}</p>
                    @else
                        <div class="w-48 h-48 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-8 shadow-2xl">
                            <i class="fas fa-user-tie text-white text-6xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-3">{{ $profile->kepala_sekolah ?? __('kepala_sekolah') }}</h3>
                        <p class="text-lg text-gray-600">{{ __('kepala_sekolah') }} {{ $schoolName }}</p>
                    @endif
                </div>
            </div>
        </section>
        @endif
        @endif

        <!-- Statistik {{ __('school') }} -->
        @if($profile->shouldShowSection('profil_show_statistics'))
        <section class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12">
            <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-chart-bar mr-3"></i>
                    Statistik {{ __('school') }}
                </h2>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="p-6 rounded-xl text-center text-white shadow-lg transform hover:scale-105 transition-transform duration-300" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <div class="text-3xl font-bold mb-2">{{ number_format($profile->jumlah_siswa ?? 100) }}</div>
                        <div class="text-green-100">Total {{ __('siswa') }}</div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-green-500 to-green-600 p-6 rounded-xl text-center text-white shadow-lg transform hover:scale-105 transition-transform duration-300">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-chalkboard-teacher text-2xl"></i>
                        </div>
                        <div class="text-3xl font-bold mb-2">{{ number_format($profile->jumlah_guru ?? 25) }}</div>
                        <div class="text-green-100">Total {{ __('guru') }}</div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-6 rounded-xl text-center text-white shadow-lg transform hover:scale-105 transition-transform duration-300">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-door-open text-2xl"></i>
                        </div>
                        <div class="text-3xl font-bold mb-2">{{ number_format($profile->jumlah_kelas ?? 6) }}</div>
                        <div class="text-yellow-100">Total Kelas</div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-xl text-center text-white shadow-lg transform hover:scale-105 transition-transform duration-300">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-calendar-alt text-2xl"></i>
                        </div>
                        <div class="text-3xl font-bold mb-2">{{ $profile->tahun_berdiri ?? 2006 }}</div>
                        <div class="text-orange-100">Tahun Berdiri</div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <!-- Visi & Misi -->
        @if($profile->shouldShowSection('profil_show_vision_mission'))
        <section class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12">
            <div class="bg-gradient-to-r from-green-600 to-emerald-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-bullseye mr-3"></i>
                    Visi & Misi
                </h2>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Visi -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl border-l-4 border-green-500">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-eye text-white text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Visi</h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $profile->visi ?: 'Visi belum tersedia.' }}
                        </p>
                    </div>
                    
                     <!-- Misi -->
                     <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl border-l-4 border-green-500">
                         <div class="flex items-center mb-4">
                             <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mr-4">
                                 <i class="fas fa-bullseye text-white text-xl"></i>
                             </div>
                             <h3 class="text-xl font-bold text-gray-900">Misi</h3>
                         </div>
                         <div class="text-gray-700 leading-relaxed">
                             @if($profile->misi)
                                 @php
                                     // Split misi by various line break formats and create a proper list
                                     $misiText = $profile->misi;
                                     
                                     // Handle different line break formats
                                     $misiText = str_replace(["\r\n", "\r"], "\n", $misiText);
                                     
                                     // Split by line breaks
                                     $misiLines = explode("\n", $misiText);
                                     
                                     // Clean and filter lines
                                     $misiLines = array_filter(array_map('trim', $misiLines), function($line) {
                                         return !empty($line) && strlen(trim($line)) > 0;
                                     });
                                     
                                     // If no proper line breaks found, try to split by numbered items
                                     if (count($misiLines) <= 1) {
                                         $misiText = preg_replace('/(\d+\.\s*)/', "\n$1", $misiText);
                                         $misiLines = explode("\n", $misiText);
                                         $misiLines = array_filter(array_map('trim', $misiLines), function($line) {
                                             return !empty($line) && strlen(trim($line)) > 0;
                                         });
                                     }
                                 @endphp
                                 <ul class="space-y-3">
                                     @foreach($misiLines as $line)
                                         <li class="flex items-start">
                                             <span class="flex-shrink-0 w-2 h-2 bg-green-600 rounded-full mt-2 mr-3"></span>
                                             <span>{{ trim($line) }}</span>
                                         </li>
                                     @endforeach
                                 </ul>
                             @else
                                 <ul class="space-y-3">
                                     <li class="flex items-start">
                                         <span class="flex-shrink-0 w-2 h-2 bg-blue-600 rounded-full mt-2 mr-3"></span>
                                         <span>Menyelenggarakan pendidikan yang berkualitas dan berorientasi pada prestasi</span>
                                     </li>
                                     <li class="flex items-start">
                                         <span class="flex-shrink-0 w-2 h-2 bg-blue-600 rounded-full mt-2 mr-3"></span>
                                         <span>Membentuk karakter siswa yang berakhlak mulia dan beriman</span>
                                     </li>
                                     <li class="flex items-start">
                                         <span class="flex-shrink-0 w-2 h-2 bg-blue-600 rounded-full mt-2 mr-3"></span>
                                         <span>Mengembangkan potensi siswa dalam bidang akademik dan non-akademik</span>
                                     </li>
                                     <li class="flex items-start">
                                         <span class="flex-shrink-0 w-2 h-2 bg-blue-600 rounded-full mt-2 mr-3"></span>
                                         <span>Menyiapkan lulusan yang siap melanjutkan ke jenjang pendidikan tinggi</span>
                                     </li>
                                 </ul>
                             @endif
                         </div>
                     </div>
                </div>
            </div>
        </section>
        @endif

        <!-- Sejarah {{ __('school') }} -->
        @if($profile->shouldShowSection('profil_show_history'))
        @if($profile->sejarah)
        <section class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-history mr-3"></i>
                    Sejarah {{ __('school') }}
                </h2>
            </div>
            <div class="p-8">
                <div class="prose prose-lg max-w-none">
                    @php
                        // Convert line breaks to proper paragraphs
                        $sejarahText = $profile->sejarah;
                        
                        // Handle different line break formats
                        $sejarahText = str_replace(["\r\n", "\r"], "\n", $sejarahText);
                        
                        // Split by double line breaks to create paragraphs
                        $paragraphs = preg_split('/\n\s*\n/', $sejarahText);
                        
                        // Clean and filter paragraphs
                        $paragraphs = array_filter(array_map('trim', $paragraphs), function($paragraph) {
                            return !empty($paragraph) && strlen(trim($paragraph)) > 0;
                        });
                    @endphp
                    
                    @if(count($paragraphs) > 1)
                        @foreach($paragraphs as $paragraph)
                            <p class="mb-4">{{ $paragraph }}</p>
                        @endforeach
                    @else
                        @php
                            // If no double line breaks, split by single line breaks and create paragraphs
                            $lines = explode("\n", $sejarahText);
                            $lines = array_filter(array_map('trim', $lines), function($line) {
                                return !empty($line) && strlen(trim($line)) > 0;
                            });
                        @endphp
                        @foreach($lines as $line)
                            <p class="mb-4">{{ $line }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        @endif
        @endif

        <!-- Fasilitas {{ __('school') }} -->
        @if($profile->shouldShowSection('profil_show_facilities'))
        @if($profile->fasilitas)
        <section class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12">
            <div class="bg-gradient-to-r from-orange-600 to-red-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-building mr-3"></i>
                    Fasilitas {{ __('school') }}
                </h2>
            </div>
            <div class="p-8">
                <div class="prose prose-lg max-w-none">
                    {!! $profile->fasilitas !!}
                </div>
            </div>
        </section>
        @endif
        @endif

        <!-- Prestasi {{ __('school') }} -->
        @if($profile->shouldShowSection('profil_show_achievements'))
        @if($profile->prestasi)
        <section class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12">
            <div class="bg-gradient-to-r from-red-600 to-pink-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-trophy mr-3"></i>
                    Prestasi {{ __('school') }}
                </h2>
            </div>
            <div class="p-8">
                <div class="prose prose-lg max-w-none">
                    {!! $profile->prestasi !!}
                </div>
            </div>
        </section>
        @endif
        @endif

        <!-- Informasi Kontak & Media Sosial -->
        @if($profile->shouldShowSection('profil_show_contact'))
        <section class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-address-book mr-3"></i>
                    Informasi Kontak & Media Sosial
                </h2>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Kontak Utama -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">Kontak Utama</h3>
                        <div class="space-y-4">
                            @if($profile->telepon)
                                <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                    <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-phone text-white"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-900">Telepon</div>
                                        <a href="{{ $profile->telepon_url ?? \App\Helpers\ProfileHelper::makePhoneUrl($profile->telepon) }}" 
                                           class="text-green-600 hover:text-green-800">{{ $profile->telepon }}</a>
                                    </div>
                                </div>
                            @endif
                            
                            @if($profile->whatsapp_admin)
                                <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                    <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center mr-4">
                                        <i class="fab fa-whatsapp text-white"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-900">WhatsApp Admin</div>
                                        <a href="{{ $profile->whatsapp_url ?? \App\Helpers\ProfileHelper::makeWhatsAppUrl($profile->whatsapp_admin) }}" 
                                           target="_blank" class="text-green-600 hover:text-green-800">{{ $profile->whatsapp_admin }}</a>
                                    </div>
                                </div>
                            @endif
                            
                            @if($profile->email)
                                <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                    <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-900">Email</div>
                                        <a href="mailto:{{ $profile->email }}" class="text-red-600 hover:text-red-800">{{ $profile->email }}</a>
                                    </div>
                                </div>
                            @endif
                            
                            @if($profile->website)
                                <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                    <div class="w-12 h-12 bg-yellow-600 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-globe text-white"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-900">Website</div>
                                        <a href="{{ $profile->website }}" target="_blank" class="text-yellow-600 hover:text-yellow-800">{{ $profile->website }}</a>
                                    </div>
                                </div>
                            @endif
                            
                            @if($profile->jam_operasional)
                                <div class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                                    <div class="w-12 h-12 bg-yellow-600 rounded-full flex items-center justify-center mr-4">
                                        <i class="fas fa-clock text-white"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-900">Jam Operasional</div>
                                        <div class="text-gray-700">{{ $profile->jam_operasional }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Media Sosial -->
                    @if($profile->shouldShowSection('profil_show_social_media'))
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">Media Sosial</h3>
                        <div class="grid grid-cols-2 gap-4">
                            @if($profile->facebook)
                                <a href="{{ $profile->facebook }}" target="_blank" 
                                   class="flex items-center p-4 bg-green-600 rounded-xl text-white hover:bg-green-700 transition-colors transform hover:scale-105">
                                    <i class="fab fa-facebook text-2xl mr-3"></i>
                                    <span class="font-semibold">Facebook</span>
                                </a>
                            @endif
                            
                            @if($profile->instagram)
                                <a href="{{ $profile->instagram }}" target="_blank" 
                                   class="flex items-center p-4 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl text-white hover:from-yellow-600 hover:to-orange-600 transition-colors transform hover:scale-105">
                                    <i class="fab fa-instagram text-2xl mr-3"></i>
                                    <span class="font-semibold">Instagram</span>
                                </a>
                            @endif
                            
                            @if($profile->youtube)
                                <a href="{{ $profile->youtube }}" target="_blank" 
                                   class="flex items-center p-4 bg-red-600 rounded-xl text-white hover:bg-red-700 transition-colors transform hover:scale-105">
                                    <i class="fab fa-youtube text-2xl mr-3"></i>
                                    <span class="font-semibold">YouTube</span>
                                </a>
                            @endif
                            
                            @if($profile->twitter)
                                <a href="{{ $profile->twitter }}" target="_blank" 
                                   class="flex items-center p-4 bg-green-400 rounded-xl text-white hover:bg-green-500 transition-colors transform hover:scale-105">
                                    <i class="fab fa-twitter text-2xl mr-3"></i>
                                    <span class="font-semibold">Twitter</span>
                                </a>
                            @endif
                        </div>
                        
                        @if($profile->koordinat_lat && $profile->koordinat_lng)
                            <div class="mt-6 p-4 bg-gray-50 rounded-xl">
                                <h4 class="font-semibold text-gray-900 mb-3">Lokasi {{ __('school') }}</h4>
                                <div class="text-sm text-gray-600 mb-3">
                                    <i class="fas fa-map-marker-alt text-red-500 mr-2"></i>
                                    {{ $profile->koordinat_formatted }} ({{ $profile->koordinat_alt ?? 0 }}m dpl)
                                </div>
                                <div class="flex space-x-2">
                                    @if($profile->google_maps_url)
                                        <a href="{{ $profile->google_maps_url }}" target="_blank" 
                                           class="flex-1 bg-green-600 text-white text-center py-2 px-4 rounded-lg hover:bg-green-700 transition-colors">
                                            <i class="fas fa-map mr-2"></i>Google Maps
                                        </a>
                                    @endif
                                    @if($profile->waze_url)
                                        <a href="{{ $profile->waze_url }}" target="_blank" 
                                           class="flex-1 bg-green-600 text-white text-center py-2 px-4 rounded-lg hover:bg-green-700 transition-colors">
                                            <i class="fas fa-car mr-2"></i>Waze
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </section>
        @endif

        <!-- Struktur Organisasi -->
        @if($profile->shouldShowSection('profil_show_organization'))
        @if($profile->struktur_organisasi)
        <section class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12">
            <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-sitemap mr-3"></i>
                    Struktur Organisasi
                </h2>
            </div>
            <div class="p-8">
                <div class="struktur-organisasi-container">
                    <div class="prose prose-lg max-w-none struktur-content">
                        {!! $profile->struktur_organisasi !!}
                    </div>
                </div>
            </div>
        </section>
        @endif
        @endif

        <!-- Kontak Darurat -->
        @if($profile->shouldShowSection('profil_show_emergency_contact'))
        <section class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-yellow-600 to-orange-700 px-8 py-6">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-exclamation-triangle mr-3"></i>
                    Kontak Darurat
                </h2>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-6 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl border border-yellow-200">
                        <div class="w-20 h-20 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-phone text-white text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Telepon Darurat</h3>
                        @if($profile?->telepon)
                        <p class="text-gray-600 mb-3">{{ $profile->telepon }}</p>
                        <a href="{{ $profile->telepon_url }}" class="inline-block bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors">
                            <i class="fas fa-phone mr-2"></i>Hubungi
                        </a>
                        @else
                        <p class="text-gray-600 mb-3">Nomor telepon belum tersedia</p>
                        @endif
                    </div>
                    
                    <div class="text-center p-6 bg-gradient-to-br from-red-50 to-pink-50 rounded-xl border border-red-200">
                        <div class="w-20 h-20 bg-gradient-to-br from-red-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-ambulance text-white text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Pertolongan Pertama</h3>
                        <p class="text-gray-600 mb-3">Hubungi petugas {{ __('school') }} terdekat</p>
                        <span class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Darurat
                        </span>
                    </div>
                    
                    <div class="text-center p-6 rounded-xl border" style="background: linear-gradient(135deg, var(--color-surface) 0%, var(--color-background) 100%); border-color: var(--color-border);">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);">
                            <i class="fas fa-shield-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Keamanan</h3>
                        <p class="text-gray-600 mb-3">Petugas keamanan {{ __('school') }}</p>
                        <span class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg">
                            <i class="fas fa-shield-alt mr-2"></i>Keamanan
                        </span>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
/* Responsive text handling */
.break-words {
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
    white-space: normal;
    overflow: visible;
    text-overflow: unset;
}

/* Ensure text is fully visible */
.text-responsive {
    font-size: clamp(1rem, 2.5vw, 1.5rem);
    line-height: 1.6;
}

/* Fix for text truncation issues */
.hero-text {
    white-space: normal !important;
    overflow: visible !important;
    text-overflow: unset !important;
    -webkit-line-clamp: unset !important;
    display: block !important;
    -webkit-box-orient: unset !important;
    max-width: none !important;
    width: auto !important;
    height: auto !important;
    min-height: auto !important;
    max-height: none !important;
}

/* Force text to display completely */
.hero-text * {
    white-space: normal !important;
    overflow: visible !important;
    text-overflow: unset !important;
    -webkit-line-clamp: unset !important;
    display: block !important;
    -webkit-box-orient: unset !important;
}

/* Override any conflicting CSS */
h1.hero-text, h2.hero-text, p.hero-text {
    white-space: normal !important;
    overflow: visible !important;
    text-overflow: unset !important;
    -webkit-line-clamp: unset !important;
    display: block !important;
    -webkit-box-orient: unset !important;
    max-width: none !important;
    width: auto !important;
    height: auto !important;
    min-height: auto !important;
    max-height: none !important;
    text-indent: 0 !important;
    letter-spacing: normal !important;
    word-spacing: normal !important;
}

/* Hero section improvements - removed custom CSS to use Tailwind classes */

.prose {
    color: #374151;
    line-height: 1.75;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #111827;
    font-weight: 600;
    margin-top: 1.5em;
    margin-bottom: 0.5em;
}

.prose h1 { font-size: 1.875rem; }
.prose h2 { font-size: 1.5rem; }
.prose h3 { font-size: 1.25rem; }
.prose h4 { font-size: 1.125rem; }

.prose p {
    margin-bottom: 1.25em;
}

.prose ul, .prose ol {
    margin-bottom: 1.25em;
    padding-left: 1.625em;
}

.prose li {
    margin-bottom: 0.5em;
}

.prose blockquote {
    border-left: 4px solid #e5e7eb;
    padding-left: 1rem;
    font-style: italic;
    color: #6b7280;
    margin: 1.5em 0;
}

.prose img {
    border-radius: 0.5rem;
    margin: 1.5em 0;
}

.prose a {
    color: #2563eb;
    text-decoration: underline;
}

.prose a:hover {
    color: #1d4ed8;
}

/* Animasi hover untuk card */
.transform {
    transition: transform 0.3s ease-in-out;
}

.hover\:scale-105:hover {
    transform: scale(1.05);
}

/* Gradient text untuk judul section */
.gradient-text {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Mobile Optimizations - using Tailwind responsive classes instead */

/* Struktur Organisasi Styling */
.struktur-organisasi-container {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.struktur-content {
    width: 100%;
    min-height: 200px;
}

/* Styling untuk gambar struktur organisasi */
.struktur-content img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 1.5rem auto;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.struktur-content img:hover {
    transform: scale(1.02);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

/* Styling untuk tabel struktur organisasi */
.struktur-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
    background: white;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    border-radius: 0.5rem;
    overflow: hidden;
}

.struktur-content table thead {
    background: linear-gradient(135deg, #059669 0%, #047857 100%);
    color: white;
}

.struktur-content table th {
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    font-size: 1rem;
}

.struktur-content table td {
    padding: 0.875rem 1rem;
    border-bottom: 1px solid #e5e7eb;
    color: #374151;
}

.struktur-content table tbody tr:last-child td {
    border-bottom: none;
}

.struktur-content table tbody tr:hover {
    background-color: #f9fafb;
    transition: background-color 0.2s ease;
}

.struktur-content table tbody tr:nth-child(even) {
    background-color: #f9fafb;
}

.struktur-content table tbody tr:nth-child(even):hover {
    background-color: #f3f4f6;
}

/* Styling untuk list struktur organisasi */
.struktur-content ul,
.struktur-content ol {
    margin: 1.5rem 0;
    padding-left: 2rem;
    line-height: 1.8;
}

.struktur-content ul li,
.struktur-content ol li {
    margin-bottom: 0.75rem;
    color: #374151;
}

.struktur-content ul li::marker {
    color: #059669;
}

.struktur-content ol li::marker {
    color: #059669;
    font-weight: 600;
}

/* Styling untuk heading dalam struktur organisasi */
.struktur-content h1,
.struktur-content h2,
.struktur-content h3,
.struktur-content h4,
.struktur-content h5,
.struktur-content h6 {
    color: #111827;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.struktur-content h1 {
    font-size: 1.65rem;
    border-bottom: 3px solid #059669;
    padding-bottom: 0.5rem;
}

.struktur-content h2 {
    font-size: 1.4rem;
    color: #059669;
}

.struktur-content h3 {
    font-size: 1.2rem;
    color: #047857;
}

/* Styling untuk paragraf */
.struktur-content p {
    margin-bottom: 1.25rem;
    line-height: 1.8;
    color: #374151;
    text-align: justify;
}

/* Styling untuk div container */
.struktur-content div {
    margin-bottom: 1rem;
}

/* Center alignment untuk konten struktur */
.struktur-content {
    text-align: center;
}

.struktur-content p,
.struktur-content ul,
.struktur-content ol {
    text-align: left;
}

/* Responsive untuk mobile */
@media (max-width: 768px) {
    .struktur-content {
        font-size: 0.875rem;
    }
    
    .struktur-content table {
        font-size: 0.75rem;
    }
    
    .struktur-content table th,
    .struktur-content table td {
        padding: 0.5rem;
    }
    
    .struktur-content h1 {
        font-size: 1.5rem;
    }
    
    .struktur-content h2 {
        font-size: 1.25rem;
    }
    
    .struktur-content h3 {
        font-size: 1.125rem;
    }
    
    .struktur-content img {
        margin: 1rem auto;
    }
}

/* Print styling */
@media print {
    .struktur-content {
        page-break-inside: avoid;
    }
    
    .struktur-content img {
        max-width: 100%;
        page-break-inside: avoid;
    }
    
    .struktur-content table {
        page-break-inside: avoid;
    }
}
</style>
@endpush
