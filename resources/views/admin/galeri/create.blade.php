@extends('layouts.admin-simple')

@section('title', 'Tambah Galeri Baru - ' . $schoolName)

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-2xl p-8 text-white mb-8 shadow-2xl relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-3">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                                    <i class="fas fa-images text-2xl text-white"></i>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold mb-1">Tambah Galeri Baru</h1>
                                    <p class="text-indigo-100 text-lg">Buat galeri dengan multiple media (foto/video)</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4 text-sm text-indigo-100">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <span>Upload Multiple Media</span>
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
                                <i class="fas fa-camera text-4xl text-white"></i>
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
                    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10" id="galeriForm">
                        @csrf
                        
                        <!-- Galeri Information Section -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 border border-gray-200 shadow-sm">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                    <i class="fas fa-info-circle text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">Informasi Galeri</h3>
                                    <p class="text-gray-600 text-sm">Isi informasi dasar galeri Anda</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <!-- Judul Galeri -->
                                <div class="lg:col-span-2">
                                    <label for="judul" class="block text-sm font-bold text-gray-800 mb-3 flex items-center">
                                        <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-tag text-white text-xs"></i>
                                        </div>
                                        Judul Galeri <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" 
                                           name="judul" 
                                           id="judul" 
                                           value="{{ old('judul') }}"
                                           class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 @error('judul') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror bg-white hover:border-gray-300"
                                           placeholder="Masukkan judul galeri yang menarik"
                                           required>
                                    @error('judul')
                                        <div class="mt-3 flex items-center text-red-600 bg-red-50 px-4 py-2 rounded-lg border border-red-200">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            <span class="text-sm font-medium">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Kategori -->
                                <div>
                                    <label for="kategori" class="block text-sm font-bold text-gray-800 mb-3 flex items-center">
                                        <div class="w-6 h-6 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-folder text-white text-xs"></i>
                                        </div>
                                        Kategori
                                    </label>
                                    <input type="text" 
                                           name="kategori" 
                                           id="kategori" 
                                           value="{{ old('kategori') }}"
                                           class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 @error('kategori') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror bg-white hover:border-gray-300"
                                           placeholder="Contoh: Kegiatan Sekolah, Acara, dll">
                                    @error('kategori')
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
                                        <option value="">Pilih status galeri</option>
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

                                <!-- Deskripsi -->
                                <div class="lg:col-span-2">
                                    <label for="deskripsi" class="block text-sm font-bold text-gray-800 mb-3 flex items-center">
                                        <div class="w-6 h-6 bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-align-left text-white text-xs"></i>
                                        </div>
                                        Deskripsi Galeri
                                    </label>
                                    <textarea name="deskripsi" 
                                              id="deskripsi" 
                                              rows="4"
                                              class="w-full px-5 py-4 border-2 border-gray-200 rounded-xl shadow-sm focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 transition-all duration-300 @error('deskripsi') border-red-500 focus:ring-red-500/20 focus:border-red-500 @enderror bg-white hover:border-gray-300 resize-none"
                                              placeholder="Masukkan deskripsi galeri yang menjelaskan isi dan tujuan galeri ini (opsional)">{{ old('deskripsi') }}</textarea>
                                    <div class="mt-2 text-xs text-gray-500 flex items-center">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        <span>Deskripsi akan membantu pengunjung memahami isi galeri</span>
                                    </div>
                                    @error('deskripsi')
                                        <div class="mt-3 flex items-center text-red-600 bg-red-50 px-4 py-2 rounded-lg border border-red-200">
                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                            <span class="text-sm font-medium">{{ $message }}</span>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Media Upload Section -->
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-8 border border-purple-200 shadow-sm">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                    <i class="fas fa-upload text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">Upload Media</h3>
                                    <p class="text-gray-600 text-sm">Minimal 4 media, maksimal 12 media</p>
                                </div>
                            </div>
                            
                            <div class="mb-6 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-2xl shadow-sm">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                        <i class="fas fa-lightbulb text-white text-sm"></i>
                                    </div>
                                    <div class="text-sm text-blue-800">
                                        <p class="font-bold mb-3 text-blue-900">💡 Panduan Upload Media:</p>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="space-y-2">
                                                <div class="flex items-center">
                                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                                    <span>Minimal 4 media, maksimal 12 media</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                                    <span>Format foto: JPG, PNG, GIF, WebP</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                                    <span>Format video: MP4, AVI, MOV, WMV</span>
                                                </div>
                                            </div>
                                            <div class="space-y-2">
                                                <div class="flex items-center">
                                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                                    <span>Maksimal 10MB per file</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                                    <span>YouTube URL didukung</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                                    <span>Auto-optimization & crop 3:4</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Media Upload Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="mediaUploadGrid">
                                @for($i = 0; $i < 12; $i++)
                                <div class="media-upload-item group border-2 border-dashed border-gray-300 rounded-2xl p-6 hover:border-purple-400 hover:shadow-lg transition-all duration-300 {{ $i >= 4 ? 'opacity-50' : '' }} bg-white" data-index="{{ $i }}">
                                    <div class="text-center">
                                        <!-- Media Type Selection -->
                                        <div class="mb-4">
                                            <select name="media_types[{{ $i }}]" 
                                                    class="w-full px-4 py-3 text-sm border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 media-type-select bg-white hover:border-gray-300"
                                                    onchange="toggleMediaType(this)">
                                                <option value="file">📁 Upload File</option>
                                                <option value="youtube">🎥 YouTube URL</option>
                                            </select>
                                        </div>

                                        <!-- File Upload Area -->
                                        <div class="upload-area mb-4 file-upload-section">
                                            <input type="file" 
                                                   name="media_files[{{ $i }}]" 
                                                   id="media_file_{{ $i }}"
                                                   class="hidden media-file-input" 
                                                   accept="image/*"
                                                   >
                                            
                                            <label for="media_file_{{ $i }}" class="cursor-pointer block">
                                                <div class="w-full h-36 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl flex flex-col items-center justify-center hover:from-purple-50 hover:to-pink-50 transition-all duration-300 border-2 border-dashed border-gray-200 hover:border-purple-300 group-hover:scale-105">
                                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mb-3 shadow-lg">
                                                        <i class="fas fa-cloud-upload-alt text-white text-lg"></i>
                                                    </div>
                                                    <span class="text-sm font-semibold text-gray-700 mb-1">Media {{ $i + 1 }}</span>
                                                    @if($i < 4)
                                                        <span class="text-xs text-red-500 font-bold bg-red-50 px-2 py-1 rounded-full">*Wajib</span>
                                                    @else
                                                        <span class="text-xs text-gray-500">Opsional</span>
                                                    @endif
                                                </div>
                                            </label>
                                        </div>

                                        <!-- YouTube URL Area -->
                                        <div class="youtube-url-section mb-4 hidden">
                                            <input type="url" 
                                                   name="youtube_urls[{{ $i }}]" 
                                                   placeholder="Masukkan URL YouTube"
                                                   class="w-full px-4 py-3 text-sm border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 youtube-url-input bg-white hover:border-gray-300"
                                                   >
                                            <p class="text-xs text-gray-500 mt-2 flex items-center justify-center">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                <span>Contoh: https://www.youtube.com/watch?v=VIDEO_ID</span>
                                            </p>
                                        </div>

                                        <!-- Media Info Form -->
                                        <div class="space-y-4">
                                            <!-- Judul Media -->
                                            <div>
                                                <input type="text" 
                                                       name="media_titles[{{ $i }}]" 
                                                       placeholder="Judul media"
                                                       class="w-full px-4 py-3 text-sm border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 bg-white hover:border-gray-300"
                                                       >
                                            </div>

                                            <!-- Urutan -->
                                            <div>
                                                <input type="number" 
                                                       name="media_orders[{{ $i }}]" 
                                                       value="{{ $i + 1 }}"
                                                       min="1" 
                                                       max="12"
                                                       placeholder="Urutan"
                                                       class="w-full px-4 py-3 text-sm border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 bg-white hover:border-gray-300">
                                            </div>
                                        </div>

                                        <!-- Preview Area -->
                                        <div class="preview-area mt-4 hidden">
                                            <div class="w-full h-24 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-200">
                                                <div class="preview-content text-center">
                                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-2">
                                                        <i class="fas fa-check text-white text-sm"></i>
                                                    </div>
                                                    <span class="text-xs text-gray-600">Preview</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endfor
                            </div>

                            <!-- Upload Progress -->
                            <div id="uploadProgress" class="hidden mt-8 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-2xl">
                                <div class="flex items-center mb-4">
                                    <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-upload text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-blue-900">Uploading Media...</h4>
                                        <p class="text-sm text-blue-700">Please wait while we process your files</p>
                                    </div>
                                </div>
                                <div class="bg-white rounded-xl p-4 shadow-sm">
                                    <div class="bg-gray-200 rounded-full h-3 mb-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-3 rounded-full transition-all duration-500" style="width: 0%"></div>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600">
                                        <span id="progressText">Preparing upload...</span>
                                        <span id="progressPercent">0%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row items-center justify-between pt-8 border-t-2 border-gray-200 gap-4">
                            <a href="{{ route('admin.galeri.index') }}" 
                               class="w-full sm:w-auto bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg transition-all duration-300 flex items-center justify-center group">
                                <i class="fas fa-arrow-left mr-3 group-hover:-translate-x-1 transition-transform duration-300"></i>
                                <span>Kembali ke Daftar Galeri</span>
                            </a>
                            
                            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 w-full sm:w-auto">
                                <button type="button" 
                                        id="previewBtn"
                                        class="w-full sm:w-auto bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg transition-all duration-300 flex items-center justify-center group">
                                    <i class="fas fa-eye mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                                    <span>Preview Galeri</span>
                                </button>
                                
                                <button type="submit" 
                                        id="submitBtn"
                                        class="w-full sm:w-auto bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-4 px-8 rounded-xl shadow-lg transition-all duration-300 flex items-center justify-center group">
                                    <i class="fas fa-save mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                                    <span>Simpan Galeri</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-3xl max-w-6xl w-full max-h-[95vh] overflow-hidden shadow-2xl border border-gray-200">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-eye text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold">Preview Galeri</h3>
                                <p class="text-purple-100 text-sm">Pratinjau galeri sebelum disimpan</p>
                            </div>
                        </div>
                        <button type="button" id="closePreview" class="w-10 h-10 bg-white/20 hover:bg-white/30 rounded-xl flex items-center justify-center transition-colors duration-200">
                            <i class="fas fa-times text-white text-lg"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Modal Content -->
                <div class="p-8 overflow-y-auto max-h-[calc(95vh-120px)]">
                    <div id="previewContent" class="space-y-6">
                        <!-- Preview content will be inserted here -->
                    </div>
                </div>
                
                <!-- Modal Footer -->
                <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <i class="fas fa-info-circle mr-2"></i>
                            <span>Ini adalah preview dari galeri yang akan Anda buat</span>
                        </div>
                        <div class="flex space-x-3">
                            <button type="button" id="closePreviewBtn" class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors duration-200">
                                Tutup
                            </button>
                            <button type="button" id="saveFromPreview" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white rounded-lg transition-all duration-200">
                                <i class="fas fa-save mr-2"></i>Simpan Galeri
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <style>
        .youtube-url-section.hidden {
            display: none !important;
        }
        .file-upload-section.hidden {
            display: none !important;
        }
        
        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.5s ease-out;
        }
        
        /* Loading animation */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
        
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        
        /* Hover effects */
        .media-upload-item:hover {
            transform: translateY(-2px);
        }
        
        /* Focus styles */
        .focus-ring:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(147, 51, 234, 0.1);
        }
    </style>
    <script>
        // Enhanced media type toggle function
        function toggleMediaType(select) {
            console.log('Toggle media type called with value:', select.value);
            
            // Find parent container
            const container = select.closest('.media-upload-item');
            if (!container) {
                console.log('Container not found');
                return;
            }
            
            // Find sections
            const fileSection = container.querySelector('.file-upload-section');
            const youtubeSection = container.querySelector('.youtube-url-section');
            const fileInput = container.querySelector('.media-file-input');
            const youtubeInput = container.querySelector('.youtube-url-input');
            
            console.log('Sections found:', {
                fileSection: !!fileSection,
                youtubeSection: !!youtubeSection
            });
            
            if (select.value === 'youtube') {
                // Show YouTube, hide file
                if (fileSection) {
                    fileSection.style.display = 'none';
                    if (fileInput) fileInput.value = ''; // Clear file input
                }
                if (youtubeSection) {
                    youtubeSection.style.display = 'block';
                    youtubeSection.classList.add('fade-in-up');
                }
                console.log('Switched to YouTube');
            } else {
                // Show file, hide YouTube
                if (fileSection) {
                    fileSection.style.display = 'block';
                    fileSection.classList.add('fade-in-up');
                }
                if (youtubeSection) {
                    youtubeSection.style.display = 'none';
                    if (youtubeInput) youtubeInput.value = ''; // Clear YouTube input
                }
                console.log('Switched to file upload');
            }
        }
        
        // Enhanced form validation
        function validateForm() {
            const form = document.getElementById('galeriForm');
            const judul = document.getElementById('judul').value.trim();
            const status = document.getElementById('status').value;
            
            let isValid = true;
            let errorMessages = [];
            
            // Validate required fields
            if (!judul) {
                errorMessages.push('Judul galeri harus diisi');
                isValid = false;
            }
            
            if (!status) {
                errorMessages.push('Status galeri harus dipilih');
                isValid = false;
            }
            
            // Count filled slots by selected type (file or youtube)
            let mediaCount = 0;
            document.querySelectorAll('.media-upload-item').forEach(item => {
                const type = item.querySelector('.media-type-select')?.value || 'file';
                if (type === 'youtube') {
                    const url = item.querySelector('.youtube-url-input')?.value?.trim();
                    if (url) mediaCount++;
                } else {
                    const fileInput = item.querySelector('.media-file-input');
                    if (fileInput?.files?.length > 0) mediaCount++;
                }
            });
            
            if (mediaCount < 4) {
                errorMessages.push('Minimal 4 media (foto atau YouTube) harus diisi');
                isValid = false;
            }
            
            // For testing: allow form submission without media
            console.log('Media count:', mediaCount);
            console.log('Form validation result:', isValid);
            
            // Show validation errors
            if (!isValid) {
                showNotification('error', 'Validasi Gagal', errorMessages.join('<br>'));
                return false;
            }
            
            return true;
        }
        
        // Enhanced notification system
        function showNotification(type, title, message) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-lg max-w-md ${type === 'error' ? 'bg-red-50 border border-red-200' : 'bg-green-50 border border-green-200'}`;
            
            notification.innerHTML = `
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas ${type === 'error' ? 'fa-exclamation-circle text-red-500' : 'fa-check-circle text-green-500'} text-lg"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="font-semibold ${type === 'error' ? 'text-red-800' : 'text-green-800'}">${title}</h4>
                        <p class="text-sm ${type === 'error' ? 'text-red-700' : 'text-green-700'} mt-1">${message}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }
        
        // Enhanced preview functionality
        function showPreview() {
            const modal = document.getElementById('previewModal');
            const content = document.getElementById('previewContent');
            
            // Get form data
            const judul = document.getElementById('judul').value || 'Judul Galeri';
            const kategori = document.getElementById('kategori').value || 'Kategori';
            const deskripsi = document.getElementById('deskripsi').value || 'Deskripsi galeri';
            const status = document.getElementById('status').value;
            
            // Build preview content
            content.innerHTML = `
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-images text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">${judul}</h2>
                            <p class="text-gray-600">${kategori} • ${status === 'active' ? '🟢 Active' : '🔴 Inactive'}</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6">${deskripsi}</p>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        ${generateMediaPreview()}
                    </div>
                </div>
            `;
            
            modal.classList.remove('hidden');
        }
        
        function generateMediaPreview() {
            let preview = '';
            const fileInputs = document.querySelectorAll('.media-file-input');
            const youtubeInputs = document.querySelectorAll('.youtube-url-input');
            
            // Add file previews
            fileInputs.forEach((input, index) => {
                if (input.files && input.files.length > 0) {
                    const file = input.files[0];
                    const title = document.querySelectorAll('input[name="media_titles[]"]')[index]?.value || `Media ${index + 1}`;
                    
                    preview += `
                        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                            <div class="w-full h-24 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg flex items-center justify-center mb-2">
                                <i class="fas fa-file-image text-blue-500 text-2xl"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-800 truncate">${title}</p>
                            <p class="text-xs text-gray-500">${file.name}</p>
                        </div>
                    `;
                }
            });
            
            // Add YouTube previews
            youtubeInputs.forEach((input, index) => {
                if (input.value.trim()) {
                    const title = document.querySelectorAll('input[name="media_titles[]"]')[index]?.value || `YouTube ${index + 1}`;
                    
                    preview += `
                        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200">
                            <div class="w-full h-24 bg-gradient-to-br from-red-50 to-red-100 rounded-lg flex items-center justify-center mb-2">
                                <i class="fab fa-youtube text-red-500 text-2xl"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-800 truncate">${title}</p>
                            <p class="text-xs text-gray-500">YouTube Video</p>
                        </div>
                    `;
                }
            });
            
            return preview || '<p class="col-span-full text-center text-gray-500 py-8">Belum ada media yang diupload</p>';
        }
        
        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Preview button
            const previewBtn = document.getElementById('previewBtn');
            if (previewBtn) {
                previewBtn.addEventListener('click', showPreview);
            }
            
            // Close preview modal
            const closePreview = document.getElementById('closePreview');
            const closePreviewBtn = document.getElementById('closePreviewBtn');
            const previewModal = document.getElementById('previewModal');
            
            if (closePreview) {
                closePreview.addEventListener('click', () => {
                    previewModal.classList.add('hidden');
                });
            }
            
            if (closePreviewBtn) {
                closePreviewBtn.addEventListener('click', () => {
                    previewModal.classList.add('hidden');
                });
            }
            
            // Save from preview
            const saveFromPreview = document.getElementById('saveFromPreview');
            if (saveFromPreview) {
                saveFromPreview.addEventListener('click', () => {
                    previewModal.classList.add('hidden');
                    document.getElementById('galeriForm').submit();
                });
            }
            
            // Form submission
            const form = document.getElementById('galeriForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    if (!validateForm()) {
                        e.preventDefault();
                    }
                });
            }
            
            // File input change handlers
            const fileInputs = document.querySelectorAll('.media-file-input');
            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const container = this.closest('.media-upload-item');
                    const previewArea = container.querySelector('.preview-area');
                    
                    if (this.files && this.files.length > 0) {
                        previewArea.classList.remove('hidden');
                        previewArea.classList.add('fade-in-up');
                    } else {
                        previewArea.classList.add('hidden');
                    }
                });
            });
        });
    </script>
    @endpush
@endsection
