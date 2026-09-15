@extends('layouts.frontend')

@section('title', 'Kontak - ' . ($profile->nama_sekolah ?? $schoolName))

@section('page-header')
    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-3">Hubungi Kami</h1>
    <p class="text-xl text-green-100 max-w-3xl mx-auto">
        Kami siap membantu dan menjawab pertanyaan Anda seputar {{ $profile->nama_sekolah ?? $schoolName }}
    </p>
@endsection

@section('content')
<div class="bg-green-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Informasi Kontak -->
            <div>
                <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Alamat</h3>
                                <p class="text-gray-600">{{ $profile->alamat ?? 'Alamat sekolah belum tersedia' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-phone text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Telepon</h3>
                                <p class="text-gray-600">
                                    @if($profile && $profile->telepon)
                                        <a href="tel:{{ $profile->telepon }}" class="hover:text-green-600 transition-colors duration-200">
                                            {{ $profile->telepon }}
                                        </a>
                                    @else
                                        Telepon belum tersedia
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-envelope text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                                <p class="text-gray-600">
                                    @if($profile && $profile->email)
                                        <a href="mailto:{{ $profile->email }}" class="hover:text-green-600 transition-colors duration-200">
                                            {{ $profile->email }}
                                        </a>
                                    @else
                                        Email belum tersedia
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-globe text-orange-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Website</h3>
                                <p class="text-gray-600">
                                    @if($profile && $profile->website)
                                        <a href="{{ $profile->website }}" target="_blank" class="hover:text-green-600 transition-colors duration-200">
                                            {{ $profile->website }}
                                        </a>
                                    @else
                                        Website belum tersedia
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-clock text-red-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Jam Operasional</h3>
                                @if($profile && $profile->jam_operasional)
                                    <p class="text-gray-600">{{ $profile->jam_operasional }}</p>
                                @else
                                    <p class="text-gray-600">Senin - Jumat: 07:00 - 15:00 WIB</p>
                                    <p class="text-gray-600">Sabtu: 07:00 - 12:00 WIB</p>
                                    <p class="text-gray-600">Minggu: Tutup</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Media Sosial</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @if($profile && $profile->facebook)
                        <a href="{{ $profile->facebook }}" target="_blank" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                            <i class="fab fa-facebook text-blue-600 text-2xl mr-3"></i>
                            <div>
                                <h3 class="font-semibold text-gray-900">Facebook</h3>
                                <p class="text-sm text-gray-600">{{ parse_url($profile->facebook, PHP_URL_HOST) }}</p>
                            </div>
                        </a>
                        @endif
                        
                        @if($profile && $profile->instagram)
                        <a href="{{ $profile->instagram }}" target="_blank" class="flex items-center p-4 bg-pink-50 rounded-lg hover:bg-pink-100 transition-colors duration-200">
                            <i class="fab fa-instagram text-pink-600 text-2xl mr-3"></i>
                            <div>
                                <h3 class="font-semibold text-gray-900">Instagram</h3>
                                <p class="text-sm text-gray-600">{{ parse_url($profile->instagram, PHP_URL_HOST) }}</p>
                            </div>
                        </a>
                        @endif
                        
                        @if($profile && $profile->whatsapp_admin)
                        <a href="{{ $profile->whatsapp_url }}" target="_blank" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors duration-200">
                            <i class="fab fa-whatsapp text-green-600 text-2xl mr-3"></i>
                            <div>
                                <h3 class="font-semibold text-gray-900">WhatsApp</h3>
                                <p class="text-sm text-gray-600">{{ $profile->whatsapp_admin }}</p>
                            </div>
                        </a>
                        @endif
                        
                        @if($profile && $profile->youtube)
                        <a href="{{ $profile->youtube }}" target="_blank" class="flex items-center p-4 bg-red-50 rounded-lg hover:bg-red-100 transition-colors duration-200">
                            <i class="fab fa-youtube text-red-600 text-2xl mr-3"></i>
                            <div>
                                <h3 class="font-semibold text-gray-900">YouTube</h3>
                                <p class="text-sm text-gray-600">{{ parse_url($profile->youtube, PHP_URL_HOST) }}</p>
                            </div>
                        </a>
                        @endif
                        
                        @if($profile && $profile->twitter)
                        <a href="{{ $profile->twitter }}" target="_blank" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                            <i class="fab fa-twitter text-blue-500 text-2xl mr-3"></i>
                            <div>
                                <h3 class="font-semibold text-gray-900">Twitter</h3>
                                <p class="text-sm text-gray-600">{{ parse_url($profile->twitter, PHP_URL_HOST) }}</p>
                            </div>
                        </a>
                        @endif
                        
                        @if($profile && $profile->tiktok)
                        <a href="{{ $profile->tiktok }}" target="_blank" class="flex items-center p-4 bg-black rounded-lg hover:bg-gray-800 transition-colors duration-200">
                            <i class="fab fa-tiktok text-white text-2xl mr-3"></i>
                            <div>
                                <h3 class="font-semibold text-white">TikTok</h3>
                                <p class="text-sm text-gray-300">{{ parse_url($profile->tiktok, PHP_URL_HOST) }}</p>
                            </div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Form Kontak -->
            <div>
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>
                    
                    @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                        </div>
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <form action="{{ route('kontak.kirim') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                                <input type="text" 
                                       id="nama" 
                                       name="nama" 
                                       required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                       placeholder="Masukkan nama lengkap Anda">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       required 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                       placeholder="contoh@email.com">
                            </div>
                        </div>
                        
                        <div>
                            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                            <input type="tel" 
                                   id="telepon" 
                                   name="telepon" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                   placeholder="+62 812-3456-7890">
                        </div>
                        
                        <div>
                            <label for="subjek" class="block text-sm font-medium text-gray-700 mb-2">Subjek *</label>
                            <select id="subjek" 
                                    name="subjek" 
                                    required 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                <option value="">Pilih subjek</option>
                                <option value="informasi-pendaftaran">Informasi Pendaftaran</option>
                                <option value="akademik">Akademik</option>
                                <option value="non-akademik">Non-Akademik</option>
                                <option value="fasilitas">Fasilitas</option>
                                <option value="kerjasama">Kerjasama</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="pesan" class="block text-sm font-medium text-gray-700 mb-2">Pesan *</label>
                            <textarea id="pesan" 
                                      name="pesan" 
                                      rows="6" 
                                      required 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                      placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="setuju" 
                                   name="setuju" 
                                   required 
                                   class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <label for="setuju" class="ml-2 text-sm text-gray-700">
                                Saya setuju dengan <a href="{{ route('privacy') }}" target="_blank" rel="noopener noreferrer" class="text-green-600 hover:text-green-800">kebijakan privasi</a> dan <a href="{{ route('terms') }}" target="_blank" rel="noopener noreferrer" class="text-green-600 hover:text-green-800">syarat layanan</a>
                            </label>
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg transition-all duration-200">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Pesan
                        </button>
                    </form>
                </div>

                <!-- Tips Kontak -->
                <div class="bg-green-50 rounded-xl p-6 mt-8">
                    <h3 class="text-lg font-semibold text-green-900 mb-4">Tips Menghubungi Kami</h3>
                    <ul class="space-y-2 text-sm text-green-800">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-1 text-green-600"></i>
                            Sertakan informasi lengkap untuk memudahkan kami merespons
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-1 text-green-600"></i>
                            Untuk pertanyaan mendesak, gunakan telepon atau WhatsApp
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-1 text-green-600"></i>
                            Kami akan merespons dalam waktu 1-2 hari kerja
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-1 text-green-600"></i>
                            Pastikan email yang Anda masukkan valid dan aktif
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Peta Lokasi -->
        <div class="mt-16">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Lokasi Kami</h2>
                
                <!-- Link Peta -->
                <div class="flex flex-wrap justify-center gap-4 mb-6">
                    @if($profile && $profile->google_maps_url)
                    <a href="{{ $profile->google_maps_url }}" 
                       target="_blank" 
                       class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <i class="fab fa-google mr-2"></i>
                        Buka di Google Maps
                    </a>
                    @endif
                    @if($profile && $profile->waze_url)
                    <a href="{{ $profile->waze_url }}" 
                       target="_blank" 
                       class="inline-flex items-center px-6 py-3 bg-green-500 text-white font-medium rounded-lg hover:bg-green-600 transition-colors duration-200">
                        <i class="fas fa-car mr-2"></i>
                        Buka di Waze
                    </a>
                    @endif
                </div>
                
                <!-- Koordinat -->
                @if($profile && $profile->koordinat_formatted)
                <div class="text-center mb-6">
                    <div class="inline-flex items-center px-4 py-2 bg-gray-100 rounded-lg">
                        <i class="fas fa-map-marker-alt text-gray-600 mr-2"></i>
                        <span class="text-sm text-gray-700">
                            Koordinat: {{ $profile->koordinat_formatted }}
                            @if($profile->koordinat_alt)
                                ({{ $profile->koordinat_alt }}m dpl)
                            @endif
                        </span>
                    </div>
                </div>
                @endif
                
                <!-- Peta Interaktif -->
                @if($profile && $profile->koordinat_lat && $profile->koordinat_lng)
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <iframe 
                        src="https://www.google.com/maps?q={{ $profile->koordinat_lat }},{{ $profile->koordinat_lng }}&hl=id&z=15&output=embed"
                        width="100%" 
                        height="400" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-96">
                    </iframe>
                </div>
                @else
                <div class="rounded-lg overflow-hidden shadow-lg bg-gray-200 flex items-center justify-center h-96">
                    <p class="text-gray-500">Peta tidak tersedia - koordinat belum diatur</p>
                </div>
                @endif
                
                <!-- Informasi Tambahan -->
                <div class="mt-4 text-center space-y-2">
                    <p class="text-sm text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Klik dan seret untuk menjelajahi area sekitar sekolah
                    </p>
                    @if($profile && $profile->alamat)
                    <div class="bg-green-50 rounded-lg p-4 mt-4">
                        <h4 class="font-semibold text-green-900 mb-2">Alamat Lengkap</h4>
                        <p class="text-sm text-green-800">
                            {{ $profile->alamat }}
                        </p>
                    </div>
                    @else
                    <div class="bg-green-50 rounded-lg p-4 mt-4">
                        <h4 class="font-semibold text-green-900 mb-2">Alamat Lengkap</h4>
                        <p class="text-sm text-green-800">
                            {{ $profile->alamat ?? '' }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
