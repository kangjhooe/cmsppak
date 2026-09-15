@extends('layouts.admin-simple')

@section('title', 'Profil ' . __('school') . ' - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/30">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 shadow-2xl relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="mb-8 lg:mb-0">
                    <h1 class="text-5xl lg:text-6xl font-bold text-white mb-4 drop-shadow-lg">
                        Profil {{ __('school') }}
                    </h1>
                    <p class="text-xl lg:text-2xl text-emerald-100 font-medium">
                        Kelola informasi dan identitas {{ __('school') }}
                    </p>
                    <p class="text-emerald-100 mt-2">Edit profil, logo, dan informasi kontak {{ __('school') }}</p>
                </div>
                
                <div class="flex items-center space-x-6 bg-white/10 backdrop-blur-sm rounded-3xl p-6 border border-white/20">
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-building text-white text-3xl"></i>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-emerald-100 font-medium">Status</p>
                        <p class="text-2xl font-bold text-white">Aktif</p>
                        <p class="text-sm text-emerald-100">Terakhir update</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <i class="fas fa-edit text-emerald-600 mr-3"></i>
                        Edit Profil {{ __('school') }}
                    </h3>
                    
                    <!-- Tab Navigation -->
                    <div class="flex space-x-1 bg-white rounded-lg p-1 shadow-sm">
                        <button type="button" id="tab-basic" class="tab-button px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200 text-white cursor-pointer" style="pointer-events: auto; z-index: 10; background: var(--color-primary);" onclick="switchTab('basic')">
                            <i class="fas fa-info-circle mr-2"></i>Informasi Dasar
                        </button>
                        <button type="button" id="tab-frontend" class="tab-button px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200 text-gray-600 hover:text-gray-900 hover:bg-gray-100 cursor-pointer" style="pointer-events: auto; z-index: 10;" onclick="switchTab('frontend')">
                            <i class="fas fa-desktop mr-2"></i>Pengaturan Frontend
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                @if(session('success'))
                    <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl shadow-sm">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 mr-3 text-lg"></i>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl shadow-sm">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-600 mr-3 text-lg"></i>
                            <span class="font-medium">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="profile-form">
                    @csrf
                    <input type="hidden" name="form_timestamp" value="{{ time() }}">
                    
                    <!-- Tab Content: Informasi Dasar -->
                    <div id="content-basic" class="tab-content">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Jenis Lembaga -->
                        <div class="md:col-span-2">
                            <label for="jenis_lembaga" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-university text-emerald-600 mr-2"></i>
                                Jenis Lembaga
                            </label>
                            <select name="jenis_lembaga" id="jenis_lembaga"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200">
                                @foreach($jenisLembagaOptions ?? [] as $value => $label)
                                    <option value="{{ $value }}" {{ old('jenis_lembaga', $profile?->jenis_lembaga ?? 'pesantren') === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-xs text-gray-500">
                                Menyesuaikan istilah di situs: {{ __('kepala_sekolah') }}, {{ __('siswa') }}, dan {{ __('npsn_label') }}.
                                Widget waktu sholat dan kalender Hijriah tetap bisa diaktifkan lewat Widget Beranda.
                            </p>
                            @error('jenis_lembaga')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama {{ __('school') }} -->
                        <div>
                            <label for="nama_sekolah" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-school text-blue-600 mr-2"></i>
                                Nama {{ __('school') }}
                            </label>
                            <input type="text" name="nama_sekolah" id="nama_sekolah" 
                                   value="{{ old('nama_sekolah', $profile->nama_sekolah ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                   placeholder="Masukkan nama {{ __('school') }}">
                            @error('nama_sekolah')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nomor identitas lembaga -->
                        <div>
                            <label for="npsn" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-id-card text-indigo-600 mr-2"></i>
                                {{ __('npsn_label') }}
                            </label>
                            <input type="text" name="npsn" id="npsn" 
                                   value="{{ old('npsn', $profile->npsn ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                   placeholder="{{ __('npsn_hint') }}">
                            @error('npsn')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt text-red-600 mr-2"></i>
                                Alamat
                            </label>
                            <textarea name="alamat" id="alamat" rows="3"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                      placeholder="Alamat lengkap {{ __('school') }}">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                            @error('alamat')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label for="telepon" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-green-600 mr-2"></i>
                                Telepon
                            </label>
                            <input type="text" name="telepon" id="telepon" 
                                   value="{{ old('telepon', $profile->telepon ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                   placeholder="Nomor telepon {{ __('school') }}">
                            @error('telepon')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope text-purple-600 mr-2"></i>
                                Email
                            </label>
                            <input type="email" name="email" id="email" 
                                   value="{{ old('email', $profile->email ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                   placeholder="Email {{ __('school') }}">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Website -->
                        <div>
                            <label for="website" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-globe text-blue-600 mr-2"></i>
                                Website
                            </label>
                            <input type="url" name="website" id="website" 
                                   value="{{ old('website', $profile->website ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                   placeholder="https://website-{{ __('school') }}.com">
                            @error('website')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Media Sosial -->
                        <div class="md:col-span-2">
                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                <i class="fas fa-share-alt text-purple-600 mr-2"></i>
                                Media Sosial
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Facebook -->
                                <div>
                                    <label for="facebook" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fab fa-facebook text-blue-600 mr-2"></i>
                                        Facebook
                                    </label>
                                    <input type="url" name="facebook" id="facebook" 
                                           value="{{ old('facebook', $profile->facebook ?? '') }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                           placeholder="https://facebook.com/username">
                                    @error('facebook')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Instagram -->
                                <div>
                                    <label for="instagram" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fab fa-instagram text-pink-600 mr-2"></i>
                                        Instagram
                                    </label>
                                    <input type="url" name="instagram" id="instagram" 
                                           value="{{ old('instagram', $profile->instagram ?? '') }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                           placeholder="https://instagram.com/username">
                                    @error('instagram')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- YouTube -->
                                <div>
                                    <label for="youtube" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fab fa-youtube text-red-600 mr-2"></i>
                                        YouTube
                                    </label>
                                    <input type="url" name="youtube" id="youtube" 
                                           value="{{ old('youtube', $profile->youtube ?? '') }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                           placeholder="https://youtube.com/@username">
                                    @error('youtube')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Twitter -->
                                <div>
                                    <label for="twitter" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fab fa-twitter text-blue-500 mr-2"></i>
                                        Twitter
                                    </label>
                                    <input type="url" name="twitter" id="twitter" 
                                           value="{{ old('twitter', $profile->twitter ?? '') }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                           placeholder="https://twitter.com/username">
                                    @error('twitter')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- TikTok -->
                                <div>
                                    <label for="tiktok" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fab fa-tiktok text-black mr-2"></i>
                                        TikTok
                                    </label>
                                    <input type="url" name="tiktok" id="tiktok" 
                                           value="{{ old('tiktok', $profile->tiktok ?? '') }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                           placeholder="https://tiktok.com/@username">
                                    @error('tiktok')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- WhatsApp Admin -->
                                <div>
                                    <label for="whatsapp_admin" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fab fa-whatsapp text-green-600 mr-2"></i>
                                        WhatsApp Admin
                                    </label>
                                    <input type="text" name="whatsapp_admin" id="whatsapp_admin" 
                                           value="{{ old('whatsapp_admin', $profile->whatsapp_admin ?? '') }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                           placeholder="081234567890">
                                    @error('whatsapp_admin')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Logo -->
                        <div>
                            <label for="logo" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-image text-yellow-600 mr-2"></i>
                                Logo {{ __('school') }}
                            </label>
                            <div class="mt-1 flex items-center space-x-4">
                                @if($profile && $profile->logo)
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('storage/' . $profile->logo) }}" 
                                             alt="Logo {{ __('school') }}" 
                                             class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200">
                                    </div>
                                @endif
                                <input type="file" name="logo" id="logo" 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" 
                                       accept="image/*">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                            @error('logo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Favicon -->
                        <div>
                            <label for="favicon" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-star text-yellow-500 mr-2"></i>
                                Favicon
                            </label>
                            <div class="mt-1 flex items-center space-x-4">
                                @if($profile && $profile->favicon)
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('storage/' . $profile->favicon) }}" 
                                             alt="Favicon" 
                                             class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200">
                                    </div>
                                @endif
                                <input type="file" name="favicon" id="favicon" 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100" 
                                       accept="image/*,.ico,.svg">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Format: ICO, PNG, SVG. Maksimal 2MB. Ukuran disarankan: 32x32 atau 64x64 pixel</p>
                            @error('favicon')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Koordinat GPS -->
                        <div>
                            <label for="koordinat_lat" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map text-red-600 mr-2"></i>
                                Latitude
                            </label>
                            <input type="number" name="koordinat_lat" id="koordinat_lat" 
                                   value="{{ old('koordinat_lat', $profile->koordinat_lat ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                   step="any" placeholder="-7.123456">
                            @error('koordinat_lat')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="koordinat_lng" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map text-red-600 mr-2"></i>
                                Longitude
                            </label>
                            <input type="number" name="koordinat_lng" id="koordinat_lng" 
                                   value="{{ old('koordinat_lng', $profile->koordinat_lng ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                   step="any" placeholder="110.123456">
                            @error('koordinat_lng')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="koordinat_alt" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-mountain text-orange-600 mr-2"></i>
                                Altitude (m)
                            </label>
                            <input type="number" name="koordinat_alt" id="koordinat_alt" 
                                   value="{{ old('koordinat_alt', $profile->koordinat_alt ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                   placeholder="100">
                            @error('koordinat_alt')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- {{ __('kepala_sekolah') }} -->
                        <div>
                            <label for="kepala_sekolah" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user-tie text-blue-600 mr-2"></i>
                                {{ __('kepala_sekolah') }}
                            </label>
                            <input type="text" name="kepala_sekolah" id="kepala_sekolah" 
                                   value="{{ old('kepala_sekolah', $profile->kepala_sekolah ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                   placeholder="Nama {{ strtolower(__('kepala_sekolah')) }}">
                            @error('kepala_sekolah')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto {{ __('kepala_sekolah') }} -->
                        <div>
                            <label for="foto_kepala_madrasah" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-camera text-purple-600 mr-2"></i>
                                Foto {{ __('kepala_sekolah') }}
                            </label>
                            <div class="space-y-3">
                                @if($profile && $profile->foto_kepala_madrasah)
                                    <div class="flex items-center space-x-4 p-3 bg-gray-50 rounded-lg">
                                        <img src="{{ asset('storage/' . $profile->foto_kepala_madrasah) }}" 
                                             alt="Foto {{ __('kepala_sekolah') }}" 
                                             class="w-16 h-16 object-cover rounded-full border-2 border-purple-300">
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-600">Foto saat ini:</p>
                                            <p class="text-xs text-gray-500">{{ basename($profile->foto_kepala_madrasah) }}</p>
                                        </div>
                                    </div>
                                @endif
                                <input type="file" name="foto_kepala_madrasah" id="foto_kepala_madrasah" 
                                       accept="image/*"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                                <p class="text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                            </div>
                            @error('foto_kepala_madrasah')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jumlah_siswa" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-users text-teal-600 mr-2"></i>
                                Jumlah {{ __('siswa') }}
                            </label>
                            <input type="number" name="jumlah_siswa" id="jumlah_siswa" min="0"
                                   value="{{ old('jumlah_siswa', $profile->jumlah_siswa ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                   placeholder="0">
                            @error('jumlah_siswa')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jumlah_guru" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-chalkboard-teacher text-cyan-600 mr-2"></i>
                                Jumlah {{ __('guru') }}
                            </label>
                            <input type="number" name="jumlah_guru" id="jumlah_guru" min="0"
                                   value="{{ old('jumlah_guru', $profile->jumlah_guru ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                   placeholder="0">
                            @error('jumlah_guru')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="jumlah_kelas" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-door-open text-amber-600 mr-2"></i>
                                Jumlah Kelas
                            </label>
                            <input type="number" name="jumlah_kelas" id="jumlah_kelas" min="0"
                                   value="{{ old('jumlah_kelas', $profile->jumlah_kelas ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                   placeholder="0">
                            @error('jumlah_kelas')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tahun_berdiri" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-calendar-alt text-orange-600 mr-2"></i>
                                Tahun Berdiri
                            </label>
                            <input type="number" name="tahun_berdiri" id="tahun_berdiri" min="1900" max="2100"
                                   value="{{ old('tahun_berdiri', $profile->tahun_berdiri ?? '') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                   placeholder="{{ date('Y') }}">
                            @error('tahun_berdiri')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Visi -->
                        <div class="md:col-span-2">
                            <label for="visi" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-eye text-green-600 mr-2"></i>
                                Visi
                            </label>
                            <textarea name="visi" id="visi" rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                      placeholder="Visi {{ __('school') }}">{{ old('visi', $profile->visi ?? '') }}</textarea>
                            @error('visi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Misi -->
                        <div class="md:col-span-2">
                            <label for="misi" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-bullseye text-blue-600 mr-2"></i>
                                Misi
                            </label>
                            <textarea name="misi" id="misi" rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                      placeholder="Misi {{ __('school') }}">{{ old('misi', $profile->misi ?? '') }}</textarea>
                            @error('misi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sejarah -->
                        <div class="md:col-span-2">
                            <label for="sejarah" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-history text-purple-600 mr-2"></i>
                                Sejarah
                            </label>
                            <textarea name="sejarah" id="sejarah" rows="8"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                      placeholder="Sejarah berdirinya {{ __('school') }}">{{ old('sejarah', $profile->sejarah ?? '') }}</textarea>
                            @error('sejarah')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fasilitas -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-4">
                                <i class="fas fa-building text-orange-600 mr-2"></i>
                                Fasilitas {{ __('school') }}
                            </label>
                            
                            <!-- Editor Fasilitas -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-medium text-gray-700">Daftar Fasilitas</h4>
                                    <button type="button" onclick="addFasilitas()" class="px-3 py-1 bg-orange-500 text-white text-sm rounded-md hover:bg-orange-600 transition-colors">
                                        <i class="fas fa-plus mr-1"></i>Tambah
                                    </button>
                                </div>
                                
                                <div id="fasilitas-list" class="space-y-3">
                                    <!-- Fasilitas items akan ditambahkan di sini -->
                                </div>
                                
                                <!-- Hidden input untuk menyimpan data -->
                                <input type="hidden" name="fasilitas" id="fasilitas-hidden" value="{{ old('fasilitas', $profile->fasilitas ?? '') }}">
                            </div>
                            
                            @error('fasilitas')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Prestasi -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-4">
                                <i class="fas fa-trophy text-red-600 mr-2"></i>
                                Prestasi {{ __('school') }}
                            </label>
                            
                            <!-- Editor Prestasi -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-medium text-gray-700">Daftar Prestasi</h4>
                                    <button type="button" onclick="addPrestasi()" class="px-3 py-1 bg-red-500 text-white text-sm rounded-md hover:bg-red-600 transition-colors">
                                        <i class="fas fa-plus mr-1"></i>Tambah
                                    </button>
                                </div>
                                
                                <div id="prestasi-list" class="space-y-3">
                                    <!-- Prestasi items akan ditambahkan di sini -->
                                </div>
                                
                                <!-- Hidden input untuk menyimpan data -->
                                <input type="hidden" name="prestasi" id="prestasi-hidden" value="{{ old('prestasi', $profile->prestasi ?? '') }}">
                            </div>
                            
                            @error('prestasi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    </div>

                    <!-- Tab Content: Pengaturan Frontend -->
                    <div id="content-frontend" class="tab-content hidden">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl mb-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">
                                <i class="fas fa-cog text-blue-600 mr-2"></i>
                                Pengaturan Tampilan Halaman Profil Frontend
                            </h4>
                            <p class="text-gray-600">Kelola konten dan tampilan halaman profil yang ditampilkan di frontend website</p>
                        </div>

                        <!-- Hero Section Settings -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
                            <h5 class="text-md font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-star text-yellow-500 mr-2"></i>
                                Pengaturan Hero Section
                            </h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="profil_hero_title" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Judul Hero
                                    </label>
                                    <input type="text" name="profil_hero_title" id="profil_hero_title" 
                                           value="{{ old('profil_hero_title', $profile->profil_hero_title ?? 'Profil ' . __('school')) }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                           placeholder="Judul utama halaman profil">
                                </div>
                                <div>
                                    <label for="profil_hero_subtitle" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Subtitle Hero
                                    </label>
                                    <input type="text" name="profil_hero_subtitle" id="profil_hero_subtitle" 
                                           value="{{ old('profil_hero_subtitle', $profile->profil_hero_subtitle ?? $profile->nama_sekolah ?? '') }}"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                           placeholder="Subtitle halaman profil">
                                </div>
                                <div class="md:col-span-2">
                                    <label for="profil_hero_description" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Deskripsi Hero
                                    </label>
                                    <textarea name="profil_hero_description" id="profil_hero_description" rows="3"
                                              class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                                              placeholder="Deskripsi singkat untuk hero section">{{ old('profil_hero_description', $profile->profil_hero_description ?? $profile->alamat ?? '') }}</textarea>
                                </div>
                                
                                <!-- Upload Gambar Hero -->
                                <div class="md:col-span-2">
                                    <label for="hero_image" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-image text-blue-600 mr-2"></i>
                                        Gambar Hero Halaman Utama
                                    </label>
                                    <div class="mt-1 flex items-center space-x-4">
                                        @if($profile && $profile->hero_image)
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('storage/' . $profile->hero_image) }}" 
                                                     alt="Gambar Hero Saat Ini" 
                                                     class="w-32 h-20 object-cover rounded-lg border-2 border-gray-200">
                                                <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                                            </div>
                                        @else
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('images/hero/hero-main.jpg') }}" 
                                                     alt="Gambar Hero Default" 
                                                     class="w-32 h-20 object-cover rounded-lg border-2 border-gray-200">
                                                <p class="text-xs text-gray-500 mt-1">Gambar default</p>
                                            </div>
                                        @endif
                                        <input type="file" name="hero_image" id="hero_image" 
                                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" 
                                               accept="image/*">
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB. Gambar akan ditampilkan di halaman utama website.</p>
                                    @error('hero_image')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section Visibility Settings -->
                        <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
                            <h5 class="text-md font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-eye text-green-500 mr-2"></i>
                                Pengaturan Visibilitas Section
                            </h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div class="flex items-center">
                                    <input type="checkbox" name="profil_show_statistics" id="profil_show_statistics" value="1" 
                                           {{ old('profil_show_statistics', $profile->profil_show_statistics ?? true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="profil_show_statistics" class="ml-2 text-sm text-gray-700">
                                        <i class="fas fa-chart-bar text-blue-500 mr-1"></i>
                                        Tampilkan Statistik
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="profil_show_contact" id="profil_show_contact" value="1" 
                                           {{ old('profil_show_contact', $profile->profil_show_contact ?? true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="profil_show_contact" class="ml-2 text-sm text-gray-700">
                                        <i class="fas fa-address-book text-green-500 mr-1"></i>
                                        Tampilkan Kontak
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="profil_show_social_media" id="profil_show_social_media" value="1" 
                                           {{ old('profil_show_social_media', $profile->profil_show_social_media ?? true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="profil_show_social_media" class="ml-2 text-sm text-gray-700">
                                        <i class="fas fa-share-alt text-purple-500 mr-1"></i>
                                        Tampilkan Media Sosial
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="profil_show_principal" id="profil_show_principal" value="1" 
                                           {{ old('profil_show_principal', $profile->profil_show_principal ?? true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="profil_show_principal" class="ml-2 text-sm text-gray-700">
                                        <i class="fas fa-user-tie text-yellow-500 mr-1"></i>
                                        Tampilkan {{ __('kepala_sekolah') }}
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="profil_show_vision_mission" id="profil_show_vision_mission" value="1" 
                                           {{ old('profil_show_vision_mission', $profile->profil_show_vision_mission ?? true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="profil_show_vision_mission" class="ml-2 text-sm text-gray-700">
                                        <i class="fas fa-bullseye text-indigo-500 mr-1"></i>
                                        Tampilkan Visi & Misi
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="profil_show_history" id="profil_show_history" value="1" 
                                           {{ old('profil_show_history', $profile->profil_show_history ?? true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="profil_show_history" class="ml-2 text-sm text-gray-700">
                                        <i class="fas fa-history text-purple-500 mr-1"></i>
                                        Tampilkan Sejarah
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="profil_show_facilities" id="profil_show_facilities" value="1" 
                                           {{ old('profil_show_facilities', $profile->profil_show_facilities ?? true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="profil_show_facilities" class="ml-2 text-sm text-gray-700">
                                        <i class="fas fa-building text-orange-500 mr-1"></i>
                                        Tampilkan Fasilitas
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="profil_show_achievements" id="profil_show_achievements" value="1" 
                                           {{ old('profil_show_achievements', $profile->profil_show_achievements ?? true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="profil_show_achievements" class="ml-2 text-sm text-gray-700">
                                        <i class="fas fa-trophy text-red-500 mr-1"></i>
                                        Tampilkan Prestasi
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="profil_show_organization" id="profil_show_organization" value="1" 
                                           {{ old('profil_show_organization', $profile->profil_show_organization ?? true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="profil_show_organization" class="ml-2 text-sm text-gray-700">
                                        <i class="fas fa-sitemap text-blue-500 mr-1"></i>
                                        Tampilkan Struktur Organisasi
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" name="profil_show_emergency_contact" id="profil_show_emergency_contact" value="1" 
                                           {{ old('profil_show_emergency_contact', $profile->profil_show_emergency_contact ?? true) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="profil_show_emergency_contact" class="ml-2 text-sm text-gray-700">
                                        <i class="fas fa-exclamation-triangle text-yellow-500 mr-1"></i>
                                        Tampilkan Kontak Darurat
                                    </label>
                                </div>
                            </div>
                        </div>


                        <!-- Preview Section -->
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-6">
                            <h5 class="text-md font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-eye text-green-500 mr-2"></i>
                                Preview Halaman Profil
                            </h5>
                            <p class="text-gray-600 mb-4">Lihat bagaimana halaman profil akan tampil di frontend:</p>
                            <a href="{{ route('profil') }}" target="_blank" 
                               class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Lihat Halaman Profil Frontend
                            </a>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </a>
                        <button type="submit" class="text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200" style="background: var(--color-primary);" onmouseover="this.style.background='var(--color-primary-dark)'" onmouseout="this.style.background='var(--color-primary)'">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.tab-button {
    pointer-events: auto !important;
    cursor: pointer !important;
    position: relative;
    z-index: 10;
}

.tab-button:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.tab-button:active {
    transform: translateY(0);
}
</style>
@endpush

@push('scripts')
<script>
// Simple tab functionality - available immediately
function switchTab(tabId) {
    console.log('Switching to tab:', tabId);
    
    // Hide all tab contents
    const allContents = document.querySelectorAll('.tab-content');
    allContents.forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all buttons
    const allButtons = document.querySelectorAll('.tab-button');
    allButtons.forEach(btn => {
        btn.classList.remove('text-white');
        btn.style.background = '';
        btn.classList.add('text-gray-600', 'hover:text-gray-900', 'hover:bg-gray-100');
    });
    
    // Show target tab content
    const targetContent = document.getElementById('content-' + tabId);
    if (targetContent) {
        targetContent.classList.remove('hidden');
        console.log('Showing tab content:', 'content-' + tabId);
    } else {
        console.error('Target content not found:', 'content-' + tabId);
    }
    
    // Add active class to clicked button
    const targetButton = document.getElementById('tab-' + tabId);
    if (targetButton) {
        targetButton.classList.add('text-white');
        targetButton.style.background = 'var(--color-primary)';
        targetButton.classList.remove('text-gray-600', 'hover:text-gray-900', 'hover:bg-gray-100');
    }
}

// Make function available globally
window.switchTab = switchTab;

// Form submission debugging
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('profile-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('Form submitted!');
            console.log('Form data:', new FormData(form));
            
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            }
        });
    }
});

// Auto-fill functionality
document.addEventListener('DOMContentLoaded', function() {
    const namaSekolahField = document.getElementById('nama_sekolah');
    const alamatField = document.getElementById('alamat');
    const heroSubtitleField = document.getElementById('profil_hero_subtitle');
    const heroDescriptionField = document.getElementById('profil_hero_description');
    
    if (namaSekolahField && heroSubtitleField) {
        namaSekolahField.addEventListener('input', function() {
            if (!heroSubtitleField.value) {
                heroSubtitleField.value = this.value;
            }
        });
    }
    
    if (alamatField && heroDescriptionField) {
        alamatField.addEventListener('input', function() {
            if (!heroDescriptionField.value) {
                heroDescriptionField.value = this.value;
            }
        });
    }
    
    // Initialize fasilitas and prestasi editors
    initializeFasilitasEditor();
    initializePrestasiEditor();
});

// Fasilitas Editor Functions
let fasilitasCounter = 0;

function initializeFasilitasEditor() {
    const fasilitasData = document.getElementById('fasilitas-hidden').value;
    if (fasilitasData) {
        try {
            // Parse HTML to extract list items
            const parser = new DOMParser();
            const doc = parser.parseFromString(fasilitasData, 'text/html');
            const listItems = doc.querySelectorAll('li');
            
            listItems.forEach(item => {
                addFasilitasItem(item.textContent.trim());
            });
        } catch (e) {
            console.log('No existing fasilitas data or parsing error');
        }
    }
}

function addFasilitas() {
    addFasilitasItem('');
}

function addFasilitasItem(value = '') {
    fasilitasCounter++;
    const container = document.getElementById('fasilitas-list');
    const itemDiv = document.createElement('div');
    itemDiv.className = 'flex items-center space-x-3 p-3 bg-orange-50 border border-orange-200 rounded-lg';
    itemDiv.innerHTML = `
        <div class="flex-1">
            <input type="text" 
                   class="w-full px-3 py-2 border border-orange-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500" 
                   placeholder="Masukkan fasilitas..." 
                   value="${value}"
                   onchange="updateFasilitasData()">
        </div>
        <button type="button" onclick="removeFasilitasItem(this)" class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
            <i class="fas fa-trash text-sm"></i>
        </button>
    `;
    container.appendChild(itemDiv);
    updateFasilitasData();
}

function removeFasilitasItem(button) {
    button.parentElement.remove();
    updateFasilitasData();
}

function updateFasilitasData() {
    const container = document.getElementById('fasilitas-list');
    const inputs = container.querySelectorAll('input[type="text"]');
    const items = Array.from(inputs).map(input => input.value.trim()).filter(value => value);
    
    const html = items.length > 0 ? `<ul><li>${items.join('</li><li>')}</li></ul>` : '';
    document.getElementById('fasilitas-hidden').value = html;
}

// Prestasi Editor Functions
let prestasiCounter = 0;

function initializePrestasiEditor() {
    const prestasiData = document.getElementById('prestasi-hidden').value;
    if (prestasiData) {
        try {
            // Parse HTML to extract list items
            const parser = new DOMParser();
            const doc = parser.parseFromString(prestasiData, 'text/html');
            const listItems = doc.querySelectorAll('li');
            
            listItems.forEach(item => {
                addPrestasiItem(item.textContent.trim());
            });
        } catch (e) {
            console.log('No existing prestasi data or parsing error');
        }
    }
}

function addPrestasi() {
    addPrestasiItem('');
}

function addPrestasiItem(value = '') {
    prestasiCounter++;
    const container = document.getElementById('prestasi-list');
    const itemDiv = document.createElement('div');
    itemDiv.className = 'flex items-center space-x-3 p-3 bg-red-50 border border-red-200 rounded-lg';
    itemDiv.innerHTML = `
        <div class="flex-1">
            <input type="text" 
                   class="w-full px-3 py-2 border border-red-300 rounded-md focus:ring-2 focus:ring-red-500 focus:border-red-500" 
                   placeholder="Masukkan prestasi..." 
                   value="${value}"
                   onchange="updatePrestasiData()">
        </div>
        <button type="button" onclick="removePrestasiItem(this)" class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
            <i class="fas fa-trash text-sm"></i>
        </button>
    `;
    container.appendChild(itemDiv);
    updatePrestasiData();
}

function removePrestasiItem(button) {
    button.parentElement.remove();
    updatePrestasiData();
}

function updatePrestasiData() {
    const container = document.getElementById('prestasi-list');
    const inputs = container.querySelectorAll('input[type="text"]');
    const items = Array.from(inputs).map(input => input.value.trim()).filter(value => value);
    
    const html = items.length > 0 ? `<ul><li>${items.join('</li><li>')}</li></ul>` : '';
    document.getElementById('prestasi-hidden').value = html;
}

// Make functions available globally
window.addFasilitas = addFasilitas;
window.addPrestasi = addPrestasi;
window.removeFasilitasItem = removeFasilitasItem;
window.removePrestasiItem = removePrestasiItem;
window.updateFasilitasData = updateFasilitasData;
window.updatePrestasiData = updatePrestasiData;

</script>
@endpush
