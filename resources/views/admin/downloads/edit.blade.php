@extends('layouts.admin-simple')

@section('title', 'Edit File Download - Admin Panel')

@section('content')
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-xl p-6 text-white mb-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">Edit File Download</h1>
                        <p class="text-indigo-100">Edit file download yang sudah ada</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-edit text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6">
                    <form action="{{ route('admin.downloads.update', $download) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">Judul File <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   name="judul" 
                                   id="judul" 
                                   value="{{ old('judul', $download->judul) }}" 
                                   placeholder="Masukkan judul file"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                   required>
                            @error('judul')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" 
                                      id="deskripsi" 
                                      rows="3" 
                                      placeholder="Deskripsi singkat tentang file ini"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">{{ old('deskripsi', $download->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                            <select name="kategori" 
                                    id="kategori" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                    required>
                                <option value="">Pilih Kategori</option>
                                <option value="silabus" {{ old('kategori', $download->kategori) == 'silabus' ? 'selected' : '' }}>Silabus</option>
                                <option value="kurikulum" {{ old('kategori', $download->kategori) == 'kurikulum' ? 'selected' : '' }}>Kurikulum</option>
                                <option value="dokumen" {{ old('kategori', $download->kategori) == 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                                <option value="formulir" {{ old('kategori', $download->kategori) == 'formulir' ? 'selected' : '' }}>Formulir</option>
                                <option value="brosur" {{ old('kategori', $download->kategori) == 'brosur' ? 'selected' : '' }}>Brosur</option>
                                <option value="lainnya" {{ old('kategori', $download->kategori) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('kategori')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">File Saat Ini</label>
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                                @if($download->tipe_file == 'pdf')
                                    <i class="fas fa-file-pdf text-red-500 text-xl mr-3"></i>
                                @elseif(in_array($download->tipe_file, ['doc', 'docx']))
                                    <i class="fas fa-file-word text-blue-500 text-xl mr-3"></i>
                                @elseif(in_array($download->tipe_file, ['xls', 'xlsx']))
                                    <i class="fas fa-file-excel text-green-500 text-xl mr-3"></i>
                                @elseif(in_array($download->tipe_file, ['ppt', 'pptx']))
                                    <i class="fas fa-file-powerpoint text-orange-500 text-xl mr-3"></i>
                                @else
                                    <i class="fas fa-file text-gray-500 text-xl mr-3"></i>
                                @endif
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $download->nama_file }}</div>
                                    <div class="text-sm text-gray-500">{{ $download->ukuran_file_formatted }} • {{ strtoupper($download->tipe_file) }}</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="file" class="block text-sm font-semibold text-gray-700 mb-2">Ganti File (Opsional)</label>
                            <input type="file" 
                                   name="file" 
                                   id="file" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                   accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar">
                            <p class="mt-2 text-sm text-gray-500">
                                Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT, ZIP, RAR (Max: 50MB)
                            </p>
                            <p class="mt-1 text-sm text-orange-600 font-medium">
                                Kosongkan jika tidak ingin mengganti file
                            </p>
                            @error('file')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="is_active" 
                                       value="1" 
                                       {{ $download->is_active ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">File aktif dan dapat diakses pengunjung</span>
                            </label>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.downloads.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200">
                                Update File
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
