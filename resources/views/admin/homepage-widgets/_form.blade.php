@php
    $widget = $widget ?? null;
    $config = $widget->config ?? [];
    $tampilkan = old('tampilkan', $config['tampilkan'] ?? ['imsak','subuh','duha','dzuhur','ashar','maghrib','isya']);
    $lokasiMode = old('lokasi_mode', $config['lokasi_mode'] ?? 'gps');
    $profile = \App\Models\Profile::first();
    $linksJson = old('links_json', json_encode($config['links'] ?? [
        ['label' => 'Profil', 'url' => url('/profil'), 'icon' => 'fas fa-school'],
        ['label' => 'Kontak', 'url' => url('/kontak'), 'icon' => 'fas fa-phone'],
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Judul *</label>
        <input type="text" name="judul" required value="{{ old('judul', $widget->judul ?? '') }}"
               class="w-full px-4 py-3 border border-gray-300 rounded-lg">
        @error('judul') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe *</label>
        <select name="tipe" x-model="tipe" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
            @foreach($types as $key => $label)
                <option value="{{ $key }}" {{ old('tipe', $widget->tipe ?? ($defaultType ?? 'agenda_mini')) === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Urutan</label>
        <input type="number" name="urutan" min="0" value="{{ old('urutan', $widget->urutan ?? 0) }}"
               class="w-full px-4 py-3 border border-gray-300 rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
        <select name="status" required class="w-full px-4 py-3 border border-gray-300 rounded-lg">
            <option value="aktif" {{ old('status', $widget->status ?? 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ old('status', $widget->status ?? '') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>
</div>

{{-- Prayer / Hijri config --}}
<div x-show="tipe === 'prayer_times' || tipe === 'hijri_calendar'" class="space-y-4 p-4 bg-slate-50 rounded-xl border" x-cloak>
    <h3 class="font-semibold text-gray-800">Pengaturan Lokasi</h3>
    <p class="text-xs text-gray-500 -mt-2">
        Jadwal sholat diambil dari data <strong>Kemenag RI</strong> (via API myQuran), berbasis kab/kota — bukan koordinat GPS exact.
    </p>

    <div>
        <label class="block text-sm text-gray-700 mb-2">Label lokasi di widget</label>
        <div class="space-y-2">
            <label class="flex items-start gap-3 p-3 bg-white rounded-lg border cursor-pointer hover:border-green-400 transition-colors"
                   :class="lokasiMode === 'gps' ? 'border-green-500 ring-1 ring-green-200' : 'border-gray-200'">
                <input type="radio" name="lokasi_mode" value="gps" x-model="lokasiMode" class="mt-1 text-green-600">
                <span>
                    <span class="block text-sm font-medium text-gray-800">GPS Profil {{ __('school') }}</span>
                    <span class="block text-xs text-gray-500 mt-0.5">
                        Menampilkan nama/label dari Profil {{ __('school') }}
                        @if($profile?->koordinat_lat && $profile?->koordinat_lng)
                            ({{ $profile->koordinat_lat }}, {{ $profile->koordinat_lng }})
                        @else
                            — koordinat belum diisi
                        @endif
                    </span>
                    <a href="{{ route('admin.profile.index') }}" class="inline-block text-xs text-cyan-600 hover:underline mt-1" target="_blank" rel="noopener">
                        Atur koordinat GPS di Profil →
                    </a>
                </span>
            </label>

            <label class="flex items-start gap-3 p-3 bg-white rounded-lg border cursor-pointer hover:border-green-400 transition-colors"
                   :class="lokasiMode === 'manual' ? 'border-green-500 ring-1 ring-green-200' : 'border-gray-200'">
                <input type="radio" name="lokasi_mode" value="manual" x-model="lokasiMode" class="mt-1 text-green-600">
                <span>
                    <span class="block text-sm font-medium text-gray-800">Koordinat Manual</span>
                    <span class="block text-xs text-gray-500 mt-0.5">Simpan lat/lng + label khusus widget (jadwal tetap mengikuti kota Kemenag di bawah)</span>
                </span>
            </label>

            <label class="flex items-start gap-3 p-3 bg-white rounded-lg border cursor-pointer hover:border-green-400 transition-colors"
                   :class="lokasiMode === 'kota' ? 'border-green-500 ring-1 ring-green-200' : 'border-gray-200'">
                <input type="radio" name="lokasi_mode" value="kota" x-model="lokasiMode" class="mt-1 text-green-600">
                <span>
                    <span class="block text-sm font-medium text-gray-800">Nama Kota</span>
                    <span class="block text-xs text-gray-500 mt-0.5">Label widget mengikuti nama kota Kemenag</span>
                </span>
            </label>
        </div>
        @error('lokasi_mode') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div x-show="lokasiMode === 'manual'" class="grid grid-cols-1 md:grid-cols-2 gap-4" x-cloak>
        <div>
            <label class="block text-sm text-gray-700 mb-1">Latitude *</label>
            <input type="number" name="lat" step="any" value="{{ old('lat', $config['lat'] ?? '') }}"
                   placeholder="-5.0371514" class="w-full px-3 py-2 border rounded-lg"
                   :required="lokasiMode === 'manual'">
            @error('lat') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm text-gray-700 mb-1">Longitude *</label>
            <input type="number" name="lng" step="any" value="{{ old('lng', $config['lng'] ?? '') }}"
                   placeholder="103.7562727" class="w-full px-3 py-2 border rounded-lg"
                   :required="lokasiMode === 'manual'">
            @error('lng') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm text-gray-700 mb-1">Label lokasi (opsional)</label>
            <input type="text" name="label_lokasi" value="{{ old('label_lokasi', $config['label_lokasi'] ?? '') }}"
                   placeholder="Contoh: Kampus Utama" class="w-full px-3 py-2 border rounded-lg">
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4">
        <div
            x-data="kotaKemenagSearch({
                initialKota: @js(old('kota', $config['kota'] ?? 'Jakarta')),
                initialId: @js(old('kota_id', $config['kota_id'] ?? '')),
                searchUrl: @js(route('admin.homepage-widgets.kota-search'))
            })"
            class="relative"
            @click.outside="open = false"
        >
            <label class="block text-sm text-gray-700 mb-1">Kota / Kab. Kemenag *</label>
            <div class="relative">
                <input type="text"
                       x-model="query"
                       @input.debounce.250ms="search"
                       @focus="open = true; if (results.length === 0 && query.length >= 2) search()"
                       @keydown.arrow-down.prevent="highlightNext()"
                       @keydown.arrow-up.prevent="highlightPrev()"
                       @keydown.enter.prevent="pickHighlighted()"
                       @keydown.escape="open = false"
                       placeholder="Ketik: Pesisir Barat, Jakarta, Palembang..."
                       autocomplete="off"
                       class="w-full px-3 py-2 border rounded-lg pr-10">
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none">
                    <i class="fas fa-search"></i>
                </span>
            </div>

            <input type="hidden" name="kota" :value="kota">
            <input type="hidden" name="kota_id" :value="kotaId">

            <div x-show="open && (loading || results.length || message)"
                 x-cloak
                 class="absolute z-30 mt-1 w-full bg-white border border-gray-200 rounded-lg shadow-lg max-h-60 overflow-auto">
                <template x-if="loading">
                    <div class="px-3 py-2 text-sm text-gray-500">Mencari kota...</div>
                </template>
                <template x-if="!loading && message">
                    <div class="px-3 py-2 text-sm text-amber-700" x-text="message"></div>
                </template>
                <template x-for="(item, index) in results" :key="item.id">
                    <button type="button"
                            @click="select(item)"
                            @mouseenter="highlighted = index"
                            class="w-full text-left px-3 py-2 text-sm hover:bg-green-50 flex items-center justify-between gap-2"
                            :class="highlighted === index ? 'bg-green-50' : ''">
                        <span x-text="item.lokasi"></span>
                        <span class="text-[10px] text-gray-400 font-mono" x-text="'#' + item.id"></span>
                    </button>
                </template>
            </div>

            <p class="text-xs mt-1" :class="kotaId ? 'text-green-700' : 'text-amber-700'">
                <span x-show="kotaId">
                    Terpilih: <strong x-text="kota"></strong>
                    <span class="text-gray-400">(ID <span x-text="kotaId"></span>)</span>
                </span>
                <span x-show="!kotaId">Belum memilih kota dari daftar — ketik lalu pilih hasil pencarian.</span>
            </p>
            @error('kota') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            @error('kota_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div x-show="tipe === 'prayer_times'">
        <label class="block text-sm text-gray-700 mb-2">Waktu yang ditampilkan</label>
        <div class="flex flex-wrap gap-3">
            @foreach([
                'imsak' => 'Imsak',
                'subuh' => 'Subuh',
                'terbit' => 'Terbit',
                'duha' => 'Duha',
                'dzuhur' => 'Dzuhur',
                'ashar' => 'Ashar',
                'maghrib' => 'Maghrib',
                'isya' => 'Isya',
            ] as $p => $label)
            <label class="inline-flex items-center gap-2 text-sm">
                <input type="checkbox" name="tampilkan[]" value="{{ $p }}" {{ in_array($p, $tampilkan) ? 'checked' : '' }} class="rounded text-green-600">
                {{ $label }}
            </label>
            @endforeach
        </div>
    </div>
    <div x-show="tipe === 'hijri_calendar'">
        <label class="inline-flex items-center gap-2 text-sm">
            <input type="checkbox" name="tampilkan_masehi" value="1" {{ old('tampilkan_masehi', $config['tampilkan_masehi'] ?? true) ? 'checked' : '' }} class="rounded text-green-600">
            Tampilkan tanggal Masehi
        </label>
    </div>
</div>

{{-- Agenda mini --}}
<div x-show="tipe === 'agenda_mini'" class="p-4 bg-slate-50 rounded-xl border" x-cloak>
    <label class="block text-sm text-gray-700 mb-1">Jumlah agenda</label>
    <input type="number" name="limit" min="1" max="10" value="{{ old('limit', $config['limit'] ?? 5) }}" class="w-40 px-3 py-2 border rounded-lg">
</div>

{{-- Quick links --}}
<div x-show="tipe === 'quick_links'" class="p-4 bg-slate-50 rounded-xl border space-y-2" x-cloak>
    <label class="block text-sm font-medium text-gray-700">Tautan (JSON)</label>
    <textarea name="links_json" rows="8" class="w-full px-3 py-2 border rounded-lg font-mono text-sm">{{ $linksJson }}</textarea>
    <p class="text-xs text-gray-500">Format: [{"label":"Profil","url":"/profil","icon":"fas fa-school"}]</p>
</div>

{{-- Custom HTML --}}
<div x-show="tipe === 'custom_html'" class="p-4 bg-slate-50 rounded-xl border space-y-2" x-cloak>
    <label class="block text-sm font-medium text-gray-700">Konten HTML</label>
    <textarea name="html" rows="8" class="w-full px-3 py-2 border rounded-lg font-mono text-sm">{{ old('html', $config['html'] ?? '') }}</textarea>
</div>

@once
@push('scripts')
<script>
function kotaKemenagSearch({ initialKota, initialId, searchUrl }) {
    return {
        query: initialKota || '',
        kota: initialKota || '',
        kotaId: initialId || '',
        results: [],
        open: false,
        loading: false,
        message: '',
        highlighted: -1,
        searchUrl,

        async search() {
            const q = this.query.trim();

            if (this.kotaId && this.query !== this.kota) {
                this.kotaId = '';
                this.kota = this.query;
            }

            if (q.length < 2) {
                this.results = [];
                this.message = q.length ? 'Ketik minimal 2 huruf' : '';
                this.open = true;
                return;
            }

            this.loading = true;
            this.message = '';
            this.open = true;
            this.highlighted = -1;

            try {
                const res = await fetch(this.searchUrl + '?q=' + encodeURIComponent(q), {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    credentials: 'same-origin',
                });
                const json = await res.json();
                this.results = Array.isArray(json.data) ? json.data : [];
                this.message = this.results.length ? '' : 'Kota tidak ditemukan. Coba "Pesisir Barat" atau "Lampung".';
                if (this.results.length === 1 && this.normalize(this.results[0].lokasi).includes(this.normalize(q))) {
                    // keep list open so user still confirms
                }
            } catch (e) {
                this.results = [];
                this.message = 'Gagal mencari kota. Coba lagi.';
            } finally {
                this.loading = false;
            }
        },

        select(item) {
            this.kota = item.lokasi;
            this.kotaId = String(item.id);
            this.query = item.lokasi;
            this.open = false;
            this.message = '';
            this.results = [];
        },

        highlightNext() {
            if (!this.results.length) return;
            this.highlighted = (this.highlighted + 1) % this.results.length;
        },

        highlightPrev() {
            if (!this.results.length) return;
            this.highlighted = this.highlighted <= 0 ? this.results.length - 1 : this.highlighted - 1;
        },

        pickHighlighted() {
            if (this.highlighted >= 0 && this.results[this.highlighted]) {
                this.select(this.results[this.highlighted]);
            } else if (this.results.length === 1) {
                this.select(this.results[0]);
            }
        },

        normalize(value) {
            return String(value || '').toLowerCase();
        },
    };
}
</script>
@endpush
@endonce
