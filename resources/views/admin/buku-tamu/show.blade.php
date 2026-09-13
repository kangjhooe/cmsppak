@extends('layouts.admin-simple')

@section('title', 'Detail Pesan Buku Tamu - ' . $schoolName)

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Detail Pesan Buku Tamu</h3>
                        <p class="mt-1 text-sm text-gray-600">Lihat dan balas pesan dari pengunjung</p>
                    </div>
                    <a href="{{ route('admin.buku-tamu.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200">
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Detail Pesan -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h4 class="text-md font-medium text-gray-900">Informasi Pengirim</h4>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $bukuTamu->nama }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $bukuTamu->email }}</p>
                    </div>
                    
                    @if($bukuTamu->telepon)
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Telepon</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $bukuTamu->telepon }}</p>
                    </div>
                    @endif
                    
                    @if($bukuTamu->instansi)
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Instansi</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $bukuTamu->instansi }}</p>
                    </div>
                    @endif
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Kirim</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $bukuTamu->created_at->format('d-m-Y H:i') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <div class="mt-1">
                            @if($bukuTamu->status === 'unread')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Belum Dibaca
                                </span>
                            @elseif($bukuTamu->status === 'read')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Sudah Dibaca
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Sudah Dibalas
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Isi Pesan -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h4 class="text-md font-medium text-gray-900">Isi Pesan</h4>
            </div>
            <div class="p-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-900 whitespace-pre-wrap">{{ $bukuTamu->pesan }}</p>
                </div>
            </div>
        </div>

        <!-- Balasan (jika ada) -->
        @if($bukuTamu->balasan)
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h4 class="text-md font-medium text-gray-900">Balasan</h4>
                <p class="mt-1 text-sm text-gray-600">Dibalas pada {{ $bukuTamu->replied_at->format('d-m-Y H:i') }}</p>
            </div>
            <div class="p-6">
                <div class="bg-blue-50 rounded-lg p-4">
                    <p class="text-gray-900 whitespace-pre-wrap">{{ $bukuTamu->balasan }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Form Balasan -->
        @if($bukuTamu->status !== 'replied')
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" id="reply">
            <div class="px-6 py-4 border-b border-gray-200">
                <h4 class="text-md font-medium text-gray-900">Kirim Balasan</h4>
                <p class="mt-1 text-sm text-gray-600">Balas pesan pengunjung</p>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.buku-tamu.reply', $bukuTamu->id) }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="balasan" class="block text-sm font-semibold text-gray-700 mb-2">Balasan <span class="text-red-500">*</span></label>
                        <textarea name="balasan" id="balasan" rows="6" required
                                  class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                                  placeholder="Tuliskan balasan untuk pengunjung..."></textarea>
                        @error('balasan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200">
                            Kirim Balasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <div class="flex space-x-3">
                    @if($bukuTamu->status === 'unread')
                        <form action="{{ route('admin.buku-tamu.mark-as-read', $bukuTamu->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200">
                                Tandai Dibaca
                            </button>
                        </form>
                    @endif
                    
                    @if($bukuTamu->status === 'read' && !$bukuTamu->balasan)
                        <form action="{{ route('admin.buku-tamu.mark-as-replied', $bukuTamu->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200">
                                Tandai Sudah Dibalas
                            </button>
                        </form>
                    @endif
                    
                    <form action="{{ route('admin.buku-tamu.destroy', $bukuTamu->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition-colors duration-200"
                                onclick="return confirm('Yakin ingin menghapus pesan ini?')">
                            Hapus Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
