@extends('layouts.admin-simple')

@section('title', 'Tambah Berita Baru - ' . $schoolName)

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-xl p-6 text-white mb-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">Tambah Berita Baru</h1>
                        <p class="text-green-100">Buat berita baru untuk website</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-plus text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl">
                <div class="p-6">
                    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="beritaForm">
                        @csrf
                        
                        <div>
                            <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">Judul Berita <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   name="judul" 
                                   id="judul" 
                                   value="{{ old('judul') }}" 
                                   required
                                   placeholder="Masukkan judul berita"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            @error('judul')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="slug" class="block text-sm font-semibold text-gray-700 mb-2">Slug</label>
                            <input type="text" 
                                   name="slug" 
                                   id="slug" 
                                   value="{{ old('slug') }}"
                                   placeholder="Akan dibuat otomatis jika dikosongkan"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            @error('slug')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="gambar_utama" class="block text-sm font-semibold text-gray-700 mb-2">Gambar Berita</label>
                            <input type="file" 
                                   name="gambar_utama" 
                                   id="gambar_utama" 
                                   accept="image/*"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <p class="mt-2 text-sm text-gray-500">Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.</p>
                            @error('gambar_utama')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="konten" class="block text-sm font-semibold text-gray-700 mb-2">Konten Berita <span class="text-red-500">*</span></label>
                            <textarea name="konten" 
                                      id="konten" 
                                      rows="15" 
                                      placeholder="Tulis konten berita lengkap di sini..."
                                      class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 textarea-konten">{{ old('konten') }}</textarea>
                            @error('konten')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                                <select name="status" 
                                        id="status"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="published_at" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Publikasi</label>
                                <input type="datetime-local" 
                                       name="published_at" 
                                       id="published_at" 
                                       value="{{ old('published_at') }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                                <p class="mt-1 text-xs text-gray-500">Kosongkan untuk langsung publikasi sekarang</p>
                                @error('published_at')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                            <div class="border border-gray-300 rounded-md p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm text-gray-600">Pilih kategori berita</span>
                                    <button type="button" onclick="openKategoriModal()" 
                                            class="text-sm bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md transition-colors duration-200">
                                        <i class="fas fa-plus mr-1"></i> Tambah Kategori
                                    </button>
                                </div>
                                
                                @if($kategori->count() > 0)
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        @foreach($kategori as $kat)
                                            <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors duration-200">
                                                <input type="checkbox" 
                                                       name="kategori_id[]" 
                                                       value="{{ $kat->id }}"
                                                       {{ in_array($kat->id, old('kategori_id', [])) ? 'checked' : '' }}
                                                       class="mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                <div class="flex items-center">
                                                    <div class="w-4 h-4 rounded-full mr-2" style="background-color: {{ $kat->warna }};"></div>
                                                    <span class="text-sm font-medium text-gray-900">{{ $kat->nama }}</span>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-8 text-gray-500">
                                        <i class="fas fa-tags text-3xl mb-2"></i>
                                        <p>Belum ada kategori tersedia</p>
                                        <button type="button" onclick="openKategoriModal()" 
                                                class="mt-2 text-blue-500 hover:text-blue-600 font-medium">
                                            Tambah kategori pertama
                                        </button>
                                    </div>
                                @endif
                                
                                <p class="text-sm text-gray-500 mt-3">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Pilih satu atau lebih kategori untuk berita ini. Anda bisa menambah kategori baru jika diperlukan.
                                </p>
                            </div>
                            @error('kategori_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('kategori_id.*')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.berita.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200">
                                Simpan Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div id="kategoriModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Tambah Kategori Baru</h3>
                    <button onclick="closeKategoriModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="kategoriForm">
                    @csrf
                    <div class="mb-4">
                        <label for="modal_nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                        <input type="text" id="modal_nama" name="nama" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <label for="modal_deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="modal_deskripsi" name="deskripsi" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="modal_warna" class="block text-sm font-medium text-gray-700 mb-2">Warna</label>
                        <div class="flex items-center space-x-2">
                            <input type="color" id="modal_warna" name="warna" value="#007bff" required
                                   class="w-12 h-10 border border-gray-300 rounded">
                            <input type="text" id="modal_warna_text" value="#007bff" readonly
                                   class="flex-1 px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" id="modal_is_active" name="is_active" checked
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeKategoriModal()"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
    <!-- Quill Editor CSS -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <style>
        /* Textarea default styles */
        .textarea-konten {
            min-height: 300px !important;
            width: 100% !important;
        }

        /* Hide textarea when Quill is active */
        .textarea-konten.textarea-hidden {
            display: none !important;
        }

        /* Show textarea as fallback if Quill fails to load */
        .textarea-konten.fallback {
            display: block !important;
            min-height: 300px !important;
            width: 100% !important;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.75rem;
        }

        /* Quill editor container styling */
        .quill-editor {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            overflow: hidden;
        }

        .quill-editor .ql-toolbar {
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
        }

        .quill-editor .ql-container {
            min-height: 260px;
            border-bottom-left-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
        }

        .quill-editor .ql-editor {
            min-height: 240px;
        }
    </style>
    @endpush

    @push('scripts')
    <!-- Quill Editor JavaScript -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        // Initialize Quill Editor for content field
        document.addEventListener('DOMContentLoaded', function() {
            const isiTextarea = document.querySelector('#konten');
            const judulInput = document.querySelector('#judul');
            const slugInput = document.querySelector('#slug');
            const beritaForm = document.querySelector('#beritaForm');
            let quill = null;

            function showTextareaFallback() {
                if (!isiTextarea) return;
                isiTextarea.classList.remove('textarea-hidden');
                isiTextarea.classList.add('fallback');
            }

            function initializeQuill() {
                if (!isiTextarea) return;

                if (typeof Quill === 'undefined') {
                    console.error('Quill gagal dimuat dari CDN');
                    showTextareaFallback();
                    return;
                }

                if (quill) {
                    return;
                }

                const existingContainer = document.querySelector('#konten_editor');
                const quillContainer = existingContainer || document.createElement('div');

                if (!existingContainer) {
                    quillContainer.id = 'konten_editor';
                    quillContainer.classList.add('quill-editor');
                    isiTextarea.insertAdjacentElement('afterend', quillContainer);
                }

                quill = new Quill(quillContainer, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ header: [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'link'],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                            [{ indent: '-1' }, { indent: '+1' }],
                            ['blockquote', 'code-block'],
                            ['clean']
                        ]
                    }
                });

                const initialContent = isiTextarea.value ? isiTextarea.value.trim() : '';
                if (initialContent) {
                    quill.clipboard.dangerouslyPasteHTML(initialContent);
                }

                isiTextarea.classList.add('textarea-hidden');
                isiTextarea.classList.remove('fallback');

                quill.on('text-change', function() {
                    isiTextarea.value = quill.root.innerHTML;
                });
            }

            initializeQuill();

            // Auto-generate slug from judul
            if (judulInput && slugInput) {
                judulInput.addEventListener('input', function() {
                    if (!slugInput.value || slugInput.dataset.autoGenerated === 'true') {
                        const slug = this.value
                            .toLowerCase()
                            .replace(/[^a-z0-9\s-]/g, '')
                            .replace(/\s+/g, '-')
                            .replace(/-+/g, '-')
                            .trim('-');
                        slugInput.value = slug;
                        slugInput.dataset.autoGenerated = 'true';
                    }
                });

                // Mark as manual if user types in slug
                slugInput.addEventListener('input', function() {
                    this.dataset.autoGenerated = 'false';
                });
            }

            // Handle form submission
            if (beritaForm) {
                beritaForm.addEventListener('submit', function(e) {
                    console.log('Form submit triggered');

                    let content = '';

                    if (quill) {
                        content = quill.root.innerHTML;
                        isiTextarea.value = content;
                        console.log('Quill content updated ke textarea:', content.length, 'karakter');
                    } else if (isiTextarea) {
                        content = isiTextarea.value;
                        console.log('Menggunakan konten textarea:', content.length, 'karakter');
                    }

                    const plainText = quill ? quill.getText().trim() : content.trim();
                    if (!plainText) {
                        e.preventDefault();
                        alert('Isi berita tidak boleh kosong!');
                        if (quill) {
                            quill.focus();
                        } else if (isiTextarea) {
                            isiTextarea.focus();
                        }
                        return false;
                    }

                    // Validate other required fields
                    const judul = document.querySelector('#judul').value.trim();
                    if (!judul) {
                        e.preventDefault();
                        alert('Judul berita tidak boleh kosong!');
                        document.querySelector('#judul').focus();
                        return false;
                    }

                    console.log('Validasi form berhasil, melanjutkan submit...');
                    return true;
                });
            }

            if (!quill) {
                setTimeout(() => {
                    if (!quill) {
                        initializeQuill();
                    }
                }, 500);
            }
        });

        // Modal Kategori Functions
        function openKategoriModal() {
            document.getElementById('kategoriModal').classList.remove('hidden');
        }

        function closeKategoriModal() {
            document.getElementById('kategoriModal').classList.add('hidden');
            document.getElementById('kategoriForm').reset();
            document.getElementById('modal_warna').value = '#007bff';
            document.getElementById('modal_warna_text').value = '#007bff';
        }

        // Color picker sync
        document.getElementById('modal_warna').addEventListener('input', function() {
            document.getElementById('modal_warna_text').value = this.value;
        });

        // Auto-clear published_at when status is published
        document.getElementById('status').addEventListener('change', function() {
            const publishedAtInput = document.getElementById('published_at');
            if (this.value === 'published') {
                publishedAtInput.value = '';
                publishedAtInput.placeholder = 'Otomatis publikasi sekarang';
            } else {
                publishedAtInput.placeholder = '';
            }
        });

        // Form submit
        document.getElementById('kategoriForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('is_active', document.getElementById('modal_is_active').checked ? '1' : '0');
            
            fetch('{{ route("admin.kategori.store-ajax") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add new checkbox to the grid container
                    const gridContainer = document.querySelector('.grid.gap-3');
                    if (gridContainer) {
                        const newCheckbox = document.createElement('label');
                        newCheckbox.className = 'flex items-center cursor-pointer hover:bg-gray-50 p-3 rounded-lg border border-gray-200 transition-colors duration-200';
                        newCheckbox.innerHTML = `
                            <input type="checkbox" 
                                   name="kategori_id[]" 
                                   value="${data.kategori.id}"
                                   checked
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 mr-3">
                            <div class="flex items-center">
                                <span class="text-sm text-gray-700 font-medium">${data.kategori.nama}</span>
                            </div>
                        `;
                        gridContainer.appendChild(newCheckbox);
                    }
                    
                    // Close modal and show success
                    closeKategoriModal();
                    alert('Kategori berhasil ditambahkan!');
                } else {
                    alert('Error: ' + (data.message || 'Terjadi kesalahan'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan kategori');
            });
        });
    </script>
    @endpush
@endsection
