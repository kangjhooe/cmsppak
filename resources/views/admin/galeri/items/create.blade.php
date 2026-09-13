@extends('layouts.admin-simple')

@section('title', 'Tambah Media Item - ' . $schoolName)

@section('content')
    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-2xl p-8 text-white mb-8 shadow-2xl relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                                    <i class="fas fa-plus text-2xl text-white"></i>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold mb-1">Tambah Media Item</h1>
                                    <p class="text-indigo-100 text-lg">Tambahkan media ke galeri: {{ $galeri->judul }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4 text-sm text-indigo-100">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <span>Foto, Video & YouTube</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <span>Preview Real-time</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <span>Auto-optimization</span>
                                </div>
                            </div>
                        </div>
                        <div class="hidden lg:block">
                            <div class="w-24 h-24 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-sm border border-white/20">
                                <i class="fas fa-images text-4xl text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-2xl rounded-2xl border border-gray-100">
                <div class="p-8">
                    <form action="{{ route('admin.galeri.items.store', $galeri) }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="mediaItemForm">
                        @csrf
                        
                        <!-- Media Type Selection -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 border border-gray-200 shadow-sm">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                    <i class="fas fa-cog text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">Jenis Media</h3>
                                    <p class="text-gray-600 text-sm">Pilih jenis media yang akan ditambahkan</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="media-type-option" data-type="foto">
                                    <input type="radio" name="jenis" value="foto" id="jenis_foto" class="hidden" required>
                                    <label for="jenis_foto" class="cursor-pointer block">
                                        <div class="bg-white rounded-xl p-6 border-2 border-gray-200 hover:border-blue-500 transition-all duration-300 text-center group">
                                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                                <i class="fas fa-image text-white text-2xl"></i>
                                            </div>
                                            <h4 class="text-lg font-semibold text-gray-800 mb-2">Foto</h4>
                                            <p class="text-sm text-gray-600">Upload gambar (JPG, PNG, GIF, WebP)</p>
                                        </div>
                                    </label>
                                </div>
                                
                                <div class="media-type-option" data-type="video">
                                    <input type="radio" name="jenis" value="video" id="jenis_video" class="hidden" required>
                                    <label for="jenis_video" class="cursor-pointer block">
                                        <div class="bg-white rounded-xl p-6 border-2 border-gray-200 hover:border-purple-500 transition-all duration-300 text-center group">
                                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                                <i class="fas fa-video text-white text-2xl"></i>
                                            </div>
                                            <h4 class="text-lg font-semibold text-gray-800 mb-2">Video</h4>
                                            <p class="text-sm text-gray-600">Upload video (MP4, AVI, MOV, WMV)</p>
                                        </div>
                                    </label>
                                </div>
                                
                                <div class="media-type-option" data-type="youtube">
                                    <input type="radio" name="jenis" value="youtube" id="jenis_youtube" class="hidden" required>
                                    <label for="jenis_youtube" class="cursor-pointer block">
                                        <div class="bg-white rounded-xl p-6 border-2 border-gray-200 hover:border-red-500 transition-all duration-300 text-center group">
                                            <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                                <i class="fab fa-youtube text-white text-2xl"></i>
                                            </div>
                                            <h4 class="text-lg font-semibold text-gray-800 mb-2">YouTube</h4>
                                            <p class="text-sm text-gray-600">Masukkan URL YouTube</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Media Information -->
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 border border-purple-200 shadow-sm">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                    <i class="fas fa-info-circle text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">Informasi Media</h3>
                                    <p class="text-gray-600 text-sm">Isi informasi media item</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Judul -->
                                <div class="lg:col-span-2">
                                    <label for="judul" class="block text-sm font-bold text-gray-800 mb-3 flex items-center">
                                        <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-tag text-white text-xs"></i>
                                        </div>
                                        Judul Media <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" 
                                           name="judul" 
                                           id="judul" 
                                           value="{{ old('judul') }}"
                                           class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 @error('judul') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror bg-white hover:border-gray-300"
                                           placeholder="Masukkan judul media"
                                           required>
                                    @error('judul')
                                        <div class="mt-3 flex items-center text-red-600 bg-red-50 px-4 py-2 rounded-lg border border-red-200">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            <span class="text-sm font-medium">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Deskripsi -->
                                <div class="lg:col-span-2">
                                    <label for="deskripsi" class="block text-sm font-bold text-gray-800 mb-3 flex items-center">
                                        <div class="w-6 h-6 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-align-left text-white text-xs"></i>
                                        </div>
                                        Deskripsi Media
                                    </label>
                                    <textarea name="deskripsi" 
                                              id="deskripsi" 
                                              rows="3"
                                              class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 @error('deskripsi') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror bg-white hover:border-gray-300 resize-none"
                                              placeholder="Masukkan deskripsi media (opsional)">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="mt-3 flex items-center text-red-600 bg-red-50 px-4 py-2 rounded-lg border border-red-200">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            <span class="text-sm font-medium">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Urutan -->
                                <div>
                                    <label for="urutan" class="block text-sm font-bold text-gray-800 mb-3 flex items-center">
                                        <div class="w-6 h-6 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-sort-numeric-up text-white text-xs"></i>
                                        </div>
                                        Urutan
                                    </label>
                                    <input type="number" 
                                           name="urutan" 
                                           id="urutan" 
                                           value="{{ old('urutan', 1) }}"
                                           min="1"
                                           class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 @error('urutan') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror bg-white hover:border-gray-300">
                                    @error('urutan')
                                        <div class="mt-3 flex items-center text-red-600 bg-red-50 px-4 py-2 rounded-lg border border-red-200">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            <span class="text-sm font-medium">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-bold text-gray-800 mb-3 flex items-center">
                                        <div class="w-6 h-6 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-toggle-on text-white text-xs"></i>
                                        </div>
                                        Status <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <select name="status" 
                                            id="status" 
                                            class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 @error('status') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror bg-white hover:border-gray-300"
                                            required>
                                        <option value="">Pilih status</option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>🟢 Active - Tampilkan di website</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>🔴 Inactive - Sembunyikan sementara</option>
                                    </select>
                                    @error('status')
                                        <div class="mt-3 flex items-center text-red-600 bg-red-50 px-4 py-2 rounded-lg border border-red-200">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            <span class="text-sm font-medium">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Media Upload Section -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 border border-blue-200 shadow-sm" id="mediaUploadSection">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                    <i class="fas fa-upload text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">Upload Media</h3>
                                    <p class="text-gray-600 text-sm">Upload file atau masukkan URL YouTube</p>
                                </div>
                            </div>
                            
                            <!-- File Upload -->
                            <div id="fileUploadSection" class="hidden">
                                <div class="mb-6">
                                    <label for="file" class="block text-sm font-bold text-gray-800 mb-3 flex items-center">
                                        <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-file-upload text-white text-xs"></i>
                                        </div>
                                        Upload File <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-dashed border-gray-300 rounded-xl hover:border-blue-400 transition-colors duration-200 bg-white">
                                        <div class="space-y-4 text-center">
                                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto">
                                                <i class="fas fa-cloud-upload-alt text-white text-2xl"></i>
                                            </div>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                    <span>Pilih file</span>
                                                    <input id="file" name="file" type="file" class="sr-only" accept="image/*,video/*">
                                                </label>
                                                <p class="pl-1">atau drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG, GIF, WebP, MP4, AVI, MOV, WMV sampai 10MB
                                            </p>
                                        </div>
                                    </div>
                                    @error('file')
                                        <div class="mt-3 flex items-center text-red-600 bg-red-50 px-4 py-2 rounded-lg border border-red-200">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            <span class="text-sm font-medium">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Thumbnail Upload -->
                                <div class="mb-6">
                                    <label for="thumbnail" class="block text-sm font-bold text-gray-800 mb-3 flex items-center">
                                        <div class="w-6 h-6 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-image text-white text-xs"></i>
                                        </div>
                                        Thumbnail (Opsional)
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-6 pb-6 border-2 border-dashed border-gray-300 rounded-xl hover:border-green-400 transition-colors duration-200 bg-white">
                                        <div class="space-y-3 text-center">
                                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mx-auto">
                                                <i class="fas fa-image text-white text-lg"></i>
                                            </div>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="thumbnail" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                                    <span>Pilih thumbnail</span>
                                                    <input id="thumbnail" name="thumbnail" type="file" class="sr-only" accept="image/*">
                                                </label>
                                                <p class="pl-1">atau drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG, GIF, WebP sampai 2MB
                                            </p>
                                        </div>
                                    </div>
                                    @error('thumbnail')
                                        <div class="mt-3 flex items-center text-red-600 bg-red-50 px-4 py-2 rounded-lg border border-red-200">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            <span class="text-sm font-medium">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- YouTube URL -->
                            <div id="youtubeUrlSection" class="hidden">
                                <div class="mb-6">
                                    <label for="youtube_url" class="block text-sm font-bold text-gray-800 mb-3 flex items-center">
                                        <div class="w-6 h-6 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fab fa-youtube text-white text-xs"></i>
                                        </div>
                                        YouTube URL <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="url" 
                                           name="youtube_url" 
                                           id="youtube_url" 
                                           value="{{ old('youtube_url') }}"
                                           class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 @error('youtube_url') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror bg-white hover:border-gray-300"
                                           placeholder="https://www.youtube.com/watch?v=VIDEO_ID">
                                    <div class="mt-2 text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        <span>Contoh: https://www.youtube.com/watch?v=VIDEO_ID atau https://youtu.be/VIDEO_ID</span>
                                    </div>
                                    @error('youtube_url')
                                        <div class="mt-3 flex items-center text-red-600 bg-red-50 px-4 py-2 rounded-lg border border-red-200">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            <span class="text-sm font-medium">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Preview Area -->
                            <div id="previewArea" class="hidden">
                                <label class="block text-sm font-bold text-gray-800 mb-3 flex items-center">
                                    <div class="w-6 h-6 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-eye text-white text-xs"></i>
                                    </div>
                                    Preview
                                </label>
                                <div class="bg-white rounded-xl p-6 border-2 border-gray-200">
                                    <div id="previewContent" class="text-center">
                                        <!-- Preview content will be inserted here -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row items-center justify-between pt-8 border-t-2 border-gray-200 gap-4">
                            <a href="{{ route('admin.galeri.edit', $galeri) }}" 
                               class="w-full sm:w-auto bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg transition-all duration-300 flex items-center justify-center group">
                                <i class="fas fa-arrow-left mr-3 group-hover:-translate-x-1 transition-transform duration-300"></i>
                                <span>Kembali ke Galeri</span>
                            </a>
                            
                            <button type="submit" 
                                    id="submitBtn"
                                    class="w-full sm:w-auto bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg transition-all duration-300 flex items-center justify-center group">
                                <i class="fas fa-save mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                                <span>Simpan Media Item</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <style>
        .media-type-option input[type="radio"]:checked + label > div {
            border-color: #3b82f6;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        }
        
        .media-type-option input[type="radio"]:checked + label > div .w-16 {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        
        .media-type-option[data-type="video"] input[type="radio"]:checked + label > div {
            border-color: #8b5cf6;
            background: linear-gradient(135deg, #faf5ff 0%, #e9d5ff 100%);
        }
        
        .media-type-option[data-type="video"] input[type="radio"]:checked + label > div .w-16 {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
        
        .media-type-option[data-type="youtube"] input[type="radio"]:checked + label > div {
            border-color: #ef4444;
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
        }
        
        .media-type-option[data-type="youtube"] input[type="radio"]:checked + label > div .w-16 {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mediaTypeOptions = document.querySelectorAll('.media-type-option');
            const fileUploadSection = document.getElementById('fileUploadSection');
            const youtubeUrlSection = document.getElementById('youtubeUrlSection');
            const previewArea = document.getElementById('previewArea');
            const previewContent = document.getElementById('previewContent');
            const fileInput = document.getElementById('file');
            const youtubeUrlInput = document.getElementById('youtube_url');

            // Media type selection
            mediaTypeOptions.forEach(option => {
                const radio = option.querySelector('input[type="radio"]');
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        const type = option.dataset.type;
                        showMediaSection(type);
                    }
                });
            });

            function showMediaSection(type) {
                // Hide all sections
                fileUploadSection.classList.add('hidden');
                youtubeUrlSection.classList.add('hidden');
                previewArea.classList.add('hidden');

                // Show appropriate section
                if (type === 'youtube') {
                    youtubeUrlSection.classList.remove('hidden');
                } else {
                    fileUploadSection.classList.remove('hidden');
                }
            }

            // File input change
            fileInput.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    showPreview(this.files[0]);
                }
            });

            // YouTube URL input
            youtubeUrlInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    showYouTubePreview(this.value);
                } else {
                    previewArea.classList.add('hidden');
                }
            });

            function showPreview(file) {
                previewArea.classList.remove('hidden');
                
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContent.innerHTML = `
                            <div class="space-y-4">
                                <img src="${e.target.result}" class="max-w-full h-48 object-cover rounded-lg mx-auto" alt="Preview">
                                <div class="text-center">
                                    <h4 class="font-semibold text-gray-800">${file.name}</h4>
                                    <p class="text-sm text-gray-600">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                                </div>
                            </div>
                        `;
                    };
                    reader.readAsDataURL(file);
                } else if (file.type.startsWith('video/')) {
                    previewContent.innerHTML = `
                        <div class="space-y-4">
                            <div class="w-full h-48 bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-video text-purple-500 text-4xl"></i>
                            </div>
                            <div class="text-center">
                                <h4 class="font-semibold text-gray-800">${file.name}</h4>
                                <p class="text-sm text-gray-600">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                            </div>
                        </div>
                    `;
                }
            }

            function showYouTubePreview(url) {
                previewArea.classList.remove('hidden');
                previewContent.innerHTML = `
                    <div class="space-y-4">
                        <div class="w-full h-48 bg-gradient-to-br from-red-50 to-red-100 rounded-lg flex items-center justify-center">
                            <i class="fab fa-youtube text-red-500 text-4xl"></i>
                        </div>
                        <div class="text-center">
                            <h4 class="font-semibold text-gray-800">YouTube Video</h4>
                            <p class="text-sm text-gray-600 break-all">${url}</p>
                        </div>
                    </div>
                `;
            }

            // Form validation
            const form = document.getElementById('mediaItemForm');
            form.addEventListener('submit', function(e) {
                const jenis = document.querySelector('input[name="jenis"]:checked');
                const judul = document.getElementById('judul').value.trim();
                const status = document.getElementById('status').value;

                if (!jenis) {
                    e.preventDefault();
                    alert('Pilih jenis media terlebih dahulu');
                    return false;
                }

                if (!judul) {
                    e.preventDefault();
                    alert('Judul media harus diisi');
                    return false;
                }

                if (!status) {
                    e.preventDefault();
                    alert('Status harus dipilih');
                    return false;
                }

                if (jenis.value === 'youtube') {
                    const youtubeUrl = document.getElementById('youtube_url').value.trim();
                    if (!youtubeUrl) {
                        e.preventDefault();
                        alert('YouTube URL harus diisi');
                        return false;
                    }
                } else {
                    const file = document.getElementById('file').files[0];
                    if (!file) {
                        e.preventDefault();
                        alert('File harus diupload');
                        return false;
                    }
                }
            });
        });
    </script>
    @endpush
@endsection
