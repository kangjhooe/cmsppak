@extends('layouts.admin-simple')

@section('title', 'Tambah Guru/Staf Baru - ' . ($schoolName ?? ''))

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-900 mb-6">Tambah Guru/Staf Baru</h1>
                    
                    <form action="{{ route('admin.guru-staf.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <!-- Informasi Pribadi -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-blue-900 mb-4">Informasi Pribadi</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           name="nama_lengkap" 
                                           id="nama_lengkap" 
                                           value="{{ old('nama_lengkap') }}" 
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('nama_lengkap')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nip" class="block text-sm font-medium text-gray-700 mb-2">
                                        NIP
                                    </label>
                                    <input type="text" 
                                           name="nip" 
                                           id="nip" 
                                           value="{{ old('nip') }}" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('nip')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Jabatan -->
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-green-900 mb-4">Informasi Jabatan</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jabatan <span class="text-red-500">*</span>
                                    </label>
                                    <select name="jabatan" 
                                            id="jabatan" 
                                            required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih jabatan</option>
                                        <option value="Guru" {{ old('jabatan') == 'Guru' ? 'selected' : '' }}>Guru</option>
                                        <option value="Kepala Sekolah" {{ old('jabatan') == 'Kepala Sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                                        <option value="Wakil Kepala Sekolah" {{ old('jabatan') == 'Wakil Kepala Sekolah' ? 'selected' : '' }}>Wakil Kepala Sekolah</option>
                                        <option value="Staf TU" {{ old('jabatan') == 'Staf TU' ? 'selected' : '' }}>Staf TU</option>
                                        <option value="Staf Perpustakaan" {{ old('jabatan') == 'Staf Perpustakaan' ? 'selected' : '' }}>Staf Perpustakaan</option>
                                        <option value="Staf Kebersihan" {{ old('jabatan') == 'Staf Kebersihan' ? 'selected' : '' }}>Staf Kebersihan</option>
                                    </select>
                                    @error('jabatan')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="mata_pelajaran" class="block text-sm font-medium text-gray-700 mb-2">
                                        Mata Pelajaran
                                    </label>
                                    <input type="text" 
                                           name="mata_pelajaran" 
                                           id="mata_pelajaran" 
                                           value="{{ old('mata_pelajaran') }}" 
                                           placeholder="Contoh: Matematika, Bahasa Indonesia"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('mata_pelajaran')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select name="status" 
                                        id="status" 
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih status</option>
                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Biodata -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-yellow-900 mb-4">Biodata</h3>
                            
                            <div>
                                <label for="biodata" class="block text-sm font-medium text-gray-700 mb-2">
                                    Biodata <span class="text-red-500">*</span>
                                </label>
                                <textarea name="biodata" 
                                          id="biodata" 
                                          rows="4" 
                                          required
                                          placeholder="Masukkan biodata lengkap guru/staf..."
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('biodata') }}</textarea>
                                @error('biodata')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Informasi Kontak -->
                        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-purple-900 mb-4">Informasi Kontak</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email
                                    </label>
                                    <input type="email" 
                                           name="email" 
                                           id="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="contoh@email.com"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nomor Telepon
                                    </label>
                                    <input type="tel" 
                                           name="telepon" 
                                           id="telepon" 
                                           value="{{ old('telepon') }}" 
                                           placeholder="08xxxxxxxxxx"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @error('telepon')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Foto -->
                        <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
                            <h3 class="text-lg font-medium text-indigo-900 mb-4">Foto Profil</h3>
                            
                            <div>
                                <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                                    Upload Foto
                                </label>
                                <input type="file" 
                                       name="foto" 
                                       id="foto" 
                                       accept="image/*"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-2 text-sm text-gray-500">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.</p>
                                @error('foto')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.guru-staf.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

