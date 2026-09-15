@php
    $slide = $slide ?? null;
@endphp

<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar {{ $slide ? '' : '*' }}</label>
    @if($slide)
        <img src="{{ $slide->gambar_url }}" alt="" class="w-full max-w-md h-40 object-cover rounded-xl mb-3">
    @endif
    <input type="file" name="gambar" accept="image/*" {{ $slide ? '' : 'required' }}
           class="w-full px-4 py-3 border border-gray-300 rounded-lg">
    <p class="mt-1 text-xs text-gray-500">Rekomendasi rasio 16:9 atau 21:9, maksimal 4MB</p>
    @error('gambar') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
        <input type="text" name="judul" value="{{ old('judul', $slide->judul ?? '') }}"
               class="w-full px-4 py-3 border border-gray-300 rounded-lg">
        @error('judul') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
        <input type="number" name="urutan" min="0" value="{{ old('urutan', $slide->urutan ?? 0) }}"
               class="w-full px-4 py-3 border border-gray-300 rounded-lg">
    </div>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Subjudul</label>
    <input type="text" name="subjudul" value="{{ old('subjudul', $slide->subjudul ?? '') }}"
           class="w-full px-4 py-3 border border-gray-300 rounded-lg">
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Link URL</label>
        <input type="url" name="link_url" value="{{ old('link_url', $slide->link_url ?? '') }}"
               placeholder="https://..."
               class="w-full px-4 py-3 border border-gray-300 rounded-lg">
        @error('link_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Teks Tombol</label>
        <input type="text" name="link_teks" value="{{ old('link_teks', $slide->link_teks ?? 'Selengkapnya') }}"
               class="w-full px-4 py-3 border border-gray-300 rounded-lg">
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
        <select name="status" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
            <option value="aktif" {{ old('status', $slide->status ?? 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ old('status', $slide->status ?? '') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>
    <div class="flex items-end pb-3">
        <label class="inline-flex items-center gap-2">
            <input type="checkbox" name="tampilkan_teks" value="1"
                   {{ old('tampilkan_teks', $slide->tampilkan_teks ?? true) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-green-600">
            <span class="text-sm text-gray-700">Tampilkan teks overlay di slide</span>
        </label>
    </div>
</div>
