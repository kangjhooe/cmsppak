@extends('layouts.admin-simple')

@section('title', 'Edit Agenda - Admin Panel')

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-xl p-6 text-white mb-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">Edit Agenda</h1>
                        <p class="text-purple-100">Edit agenda yang sudah ada</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-calendar-edit text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6">
                    <!-- Breadcrumb -->
                    <nav class="flex mb-6" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="{{ route('admin.agenda.index') }}" class="text-gray-700 hover:text-blue-600 ml-1 md:ml-2">
                                        Agenda
                                    </a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-gray-500 ml-1 md:ml-2">Edit: {{ $agenda->judul }}</span>
                                </div>
                            </li>
                        </ol>
                    </nav>

                    <form action="{{ route('admin.agenda.update', $agenda) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <!-- Judul Agenda -->
                        <div>
                            <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                                Judul Agenda <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="judul" 
                                   id="judul" 
                                   value="{{ old('judul', $agenda->judul) }}" 
                                   required
                                   placeholder="Contoh: Rapat Koordinasi Guru"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            @error('judul')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Jenis Agenda -->
                        <div>
                            <label for="jenis" class="block text-sm font-semibold text-gray-700 mb-2">
                                Jenis Agenda <span class="text-red-500">*</span>
                            </label>
                            <select name="jenis" 
                                    id="jenis" 
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                <option value="">Pilih jenis agenda</option>
                                <option value="akademik" {{ old('jenis', $agenda->jenis) == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="non_akademik" {{ old('jenis', $agenda->jenis) == 'non_akademik' ? 'selected' : '' }}>Non-Akademik</option>
                                <option value="umum" {{ old('jenis', $agenda->jenis) == 'umum' ? 'selected' : '' }}>Umum</option>
                            </select>
                            @error('jenis')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi Agenda
                            </label>
                            <textarea name="deskripsi" 
                                      id="deskripsi" 
                                      rows="4" 
                                      placeholder="Jelaskan detail agenda ini..."
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Tanggal dan Waktu -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label for="tanggal_mulai" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tanggal Mulai <span class="text-red-500">*</span>
                                </label>
                                <input type="date" 
                                       name="tanggal_mulai" 
                                       id="tanggal_mulai" 
                                       value="{{ old('tanggal_mulai', $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format('Y-m-d') : '') }}" 
                                       required
                                       min="{{ date('Y-m-d') }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('tanggal_mulai')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="tanggal_selesai" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tanggal Selesai
                                </label>
                                <input type="date" 
                                       name="tanggal_selesai" 
                                       id="tanggal_selesai" 
                                       value="{{ old('tanggal_selesai', $agenda->tanggal_selesai ? $agenda->tanggal_selesai->format('Y-m-d') : '') }}" 
                                       min="{{ date('Y-m-d') }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('tanggal_selesai')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="waktu_mulai" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Waktu Mulai <span class="text-red-500">*</span>
                                </label>
                                <input type="time" 
                                       name="waktu_mulai" 
                                       id="waktu_mulai" 
                                       value="{{ old('waktu_mulai', $agenda->waktu_mulai) }}" 
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('waktu_mulai')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="waktu_selesai" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Waktu Selesai <span class="text-red-500">*</span>
                                </label>
                                <input type="time" 
                                       name="waktu_selesai" 
                                       id="waktu_selesai" 
                                       value="{{ old('waktu_selesai', $agenda->waktu_selesai) }}" 
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                @error('waktu_selesai')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label for="lokasi" class="block text-sm font-semibold text-gray-700 mb-2">
                                Lokasi
                            </label>
                            <input type="text" 
                                   name="lokasi" 
                                   id="lokasi" 
                                   value="{{ old('lokasi', $agenda->lokasi) }}" 
                                   placeholder="Contoh: Ruang Guru, Aula Sekolah"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            @error('lokasi')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Peserta -->
                        <div>
                            <label for="peserta" class="block text-sm font-semibold text-gray-700 mb-2">
                                Peserta
                            </label>
                            <textarea name="peserta" 
                                      id="peserta" 
                                      rows="3" 
                                      placeholder="Contoh: Semua guru, Siswa kelas XII, Komite sekolah"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">{{ old('peserta', $agenda->peserta) }}</textarea>
                            @error('peserta')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select name="status" 
                                    id="status" 
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                <option value="">Pilih status</option>
                                <option value="upcoming" {{ old('status', $agenda->status) == 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                                <option value="ongoing" {{ old('status', $agenda->status) == 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung</option>
                                <option value="completed" {{ old('status', $agenda->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ old('status', $agenda->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Info Tambahan -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-medium text-blue-800">Informasi Agenda</h4>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <p><strong>Dibuat:</strong> {{ $agenda->created_at ? $agenda->created_at->format('d-m-Y H:i') : '-' }}</p>
                                        <p><strong>Terakhir diupdate:</strong> {{ $agenda->updated_at ? $agenda->updated_at->format('d-m-Y H:i') : '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.agenda.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Agenda
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Auto-set tanggal selesai jika tanggal mulai diubah
        document.getElementById('tanggal_mulai').addEventListener('change', function() {
            const tanggalMulai = this.value;
            const tanggalSelesai = document.getElementById('tanggal_selesai');
            
            if (tanggalMulai && !tanggalSelesai.value) {
                // Set tanggal selesai sama dengan tanggal mulai
                tanggalSelesai.value = tanggalMulai;
            }
            
            // Update min date untuk tanggal selesai
            tanggalSelesai.min = tanggalMulai;
        });

        // Auto-set waktu selesai jika waktu mulai diubah
        document.getElementById('waktu_mulai').addEventListener('change', function() {
            const waktuMulai = this.value;
            const waktuSelesai = document.getElementById('waktu_selesai');
            
            if (waktuMulai && !waktuSelesai.value) {
                // Set waktu selesai 1 jam setelah waktu mulai
                const [jam, menit] = waktuMulai.split(':');
                const jamSelesai = parseInt(jam) + 1;
                const waktuSelesaiValue = `${jamSelesai.toString().padStart(2, '0')}:${menit}`;
                waktuSelesai.value = waktuSelesaiValue;
            }
        });

        // Validasi waktu selesai harus setelah waktu mulai
        document.getElementById('waktu_selesai').addEventListener('change', function() {
            const waktuMulai = document.getElementById('waktu_mulai').value;
            const waktuSelesai = this.value;
            
            if (waktuMulai && waktuSelesai && waktuSelesai <= waktuMulai) {
                alert('Waktu selesai harus setelah waktu mulai!');
                this.value = '';
            }
        });

        // Validasi tanggal selesai harus setelah atau sama dengan tanggal mulai
        document.getElementById('tanggal_selesai').addEventListener('change', function() {
            const tanggalMulai = document.getElementById('tanggal_mulai').value;
            const tanggalSelesai = this.value;
            
            if (tanggalMulai && tanggalSelesai && tanggalSelesai < tanggalMulai) {
                alert('Tanggal selesai harus setelah atau sama dengan tanggal mulai!');
                this.value = '';
            }
        });

        // Preview perubahan waktu
        function updateTimePreview() {
            const tanggal = document.getElementById('tanggal_mulai').value;
            const waktuMulai = document.getElementById('waktu_mulai').value;
            const waktuSelesai = document.getElementById('waktu_selesai').value;
            
            if (tanggal && waktuMulai && waktuSelesai) {
                console.log(`Agenda akan berlangsung pada ${tanggal} dari ${waktuMulai} sampai ${waktuSelesai}`);
            }
        }

        // Event listeners untuk preview
        document.getElementById('tanggal_mulai').addEventListener('change', updateTimePreview);
        document.getElementById('waktu_mulai').addEventListener('change', updateTimePreview);
        document.getElementById('waktu_selesai').addEventListener('change', updateTimePreview);
    </script>
    @endpush
@endsection

