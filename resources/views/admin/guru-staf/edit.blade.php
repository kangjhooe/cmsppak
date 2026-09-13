@extends('layouts.admin-simple')

@section('title', 'Edit Guru/Staf - ' . ($schoolName ?? ''))

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-teal-600 to-teal-700 rounded-xl p-6 text-white mb-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">Edit Data Guru/Staf</h1>
                        <p class="text-teal-100">Perbarui informasi guru atau staf sekolah</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-edit text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6">
                    <form action="{{ route('admin.guru-staf.update', $guruStaf->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- NIP -->
                            <div>
                                <label for="nip" class="block text-sm font-semibold text-gray-700 mb-2">NIP</label>
                                <input type="text" 
                                       name="nip" 
                                       id="nip" 
                                       value="{{ old('nip', $guruStaf->nip) }}" 
                                       placeholder="Nomor Induk Pegawai"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('nip')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nama Lengkap -->
                            <div>
                                <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       name="nama_lengkap" 
                                       id="nama_lengkap" 
                                       value="{{ old('nama_lengkap', $guruStaf->nama_lengkap) }}" 
                                       required
                                       placeholder="Masukkan nama lengkap"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('nama_lengkap')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jabatan -->
                            <div>
                                <label for="jabatan" class="block text-sm font-semibold text-gray-700 mb-2">Jabatan <span class="text-red-500">*</span></label>
                                <select name="jabatan" 
                                        id="jabatan" 
                                        required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    <option value="">Pilih Jabatan</option>
                                    <option value="Kepala Sekolah" {{ old('jabatan', $guruStaf->jabatan) == 'Kepala Sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                                    <option value="Wakil Kepala Sekolah" {{ old('jabatan', $guruStaf->jabatan) == 'Wakil Kepala Sekolah' ? 'selected' : '' }}>Wakil Kepala Sekolah</option>
                                    <option value="Guru" {{ old('jabatan', $guruStaf->jabatan) == 'Guru' ? 'selected' : '' }}>Guru</option>
                                    <option value="Staf TU" {{ old('jabatan', $guruStaf->jabatan) == 'Staf TU' ? 'selected' : '' }}>Staf TU</option>
                                    <option value="Staf Perpustakaan" {{ old('jabatan', $guruStaf->jabatan) == 'Staf Perpustakaan' ? 'selected' : '' }}>Staf Perpustakaan</option>
                                    <option value="Staf Laboratorium" {{ old('jabatan', $guruStaf->jabatan) == 'Staf Laboratorium' ? 'selected' : '' }}>Staf Laboratorium</option>
                                    <option value="Staf Keamanan" {{ old('jabatan', $guruStaf->jabatan) == 'Staf Keamanan' ? 'selected' : '' }}>Staf Keamanan</option>
                                    <option value="Staf Kebersihan" {{ old('jabatan', $guruStaf->jabatan) == 'Staf Kebersihan' ? 'selected' : '' }}>Staf Kebersihan</option>
                                </select>
                                @error('jabatan')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Mata Pelajaran -->
                            <div>
                                <label for="mata_pelajaran" class="block text-sm font-semibold text-gray-700 mb-2">Mata Pelajaran</label>
                                <input type="text" 
                                       name="mata_pelajaran" 
                                       id="mata_pelajaran" 
                                       value="{{ old('mata_pelajaran', $guruStaf->mata_pelajaran) }}"
                                       placeholder="Contoh: Matematika, Bahasa Indonesia, dll"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('mata_pelajaran')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       value="{{ old('email', $guruStaf->email) }}"
                                       placeholder="contoh@email.com"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Telepon -->
                            <div>
                                <label for="telepon" class="block text-sm font-semibold text-gray-700 mb-2">Telepon</label>
                                <input type="text" 
                                       name="telepon" 
                                       id="telepon" 
                                       value="{{ old('telepon', $guruStaf->telepon) }}"
                                       placeholder="08xxxxxxxxxx"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('telepon')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                                <select name="status" 
                                        id="status" 
                                        required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    <option value="aktif" {{ old('status', $guruStaf->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status', $guruStaf->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Foto -->
                            <div>
                                <label for="foto" class="block text-sm font-semibold text-gray-700 mb-2">Foto</label>
                                <input type="file" 
                                       name="foto" 
                                       id="foto" 
                                       accept="image/*"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                <p class="mt-2 text-sm text-gray-500">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.</p>
                                @error('foto')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                
                                @if($guruStaf->foto)
                                    <div class="mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                        <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                                        <img src="{{ asset('storage/' . $guruStaf->foto) }}" 
                                             alt="Foto {{ $guruStaf->nama_lengkap }}" 
                                             class="h-20 w-20 object-cover rounded-lg shadow-sm">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Biodata -->
                        <div>
                            <label for="biodata" class="block text-sm font-semibold text-gray-700 mb-2">Biodata <span class="text-red-500">*</span></label>
                            <textarea name="biodata" 
                                      id="biodata" 
                                      rows="6" 
                                      required
                                      placeholder="Tuliskan biodata lengkap guru/staf..."
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">{{ old('biodata', $guruStaf->biodata) }}</textarea>
                            @error('biodata')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.guru-staf.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200">
                                Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Preview foto sebelum upload
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.createElement('img');
                preview.src = e.target.result;
                preview.className = 'h-20 w-20 object-cover rounded-lg shadow-sm';
                
                const container = document.querySelector('input[name="foto"]').parentNode;
                const existingPreview = container.querySelector('img');
                if (existingPreview) {
                    existingPreview.remove();
                }
                container.appendChild(preview);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
