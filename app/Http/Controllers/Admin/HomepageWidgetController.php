<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageWidget;
use App\Services\PrayerTimeService;
use Illuminate\Http\Request;

class HomepageWidgetController extends Controller
{
    public function index(Request $request)
    {
        $query = HomepageWidget::urut();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        $widgets = $query->paginate(12)->withQueryString();

        $stats = [
            'total' => HomepageWidget::count(),
            'aktif' => HomepageWidget::where('status', 'aktif')->count(),
            'nonaktif' => HomepageWidget::where('status', 'nonaktif')->count(),
        ];

        return view('admin.homepage-widgets.index', compact('widgets', 'stats'));
    }

    public function create()
    {
        $types = HomepageWidget::TYPES;
        $defaultType = \App\Helpers\InstitutionHelper::usesIslamicFeatures()
            ? 'prayer_times'
            : 'agenda_mini';

        return view('admin.homepage-widgets.create', compact('types', 'defaultType'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['config'] = $this->buildConfig($request);

        HomepageWidget::create($data);

        return redirect()->route('admin.homepage-widgets.index')
            ->with('success', 'Widget beranda berhasil ditambahkan');
    }

    public function edit(HomepageWidget $homepage_widget)
    {
        $types = HomepageWidget::TYPES;
        return view('admin.homepage-widgets.edit', [
            'widget' => $homepage_widget,
            'types' => $types,
        ]);
    }

    public function show(HomepageWidget $homepage_widget)
    {
        return redirect()->route('admin.homepage-widgets.edit', $homepage_widget);
    }

    public function update(Request $request, HomepageWidget $homepage_widget)
    {
        $data = $this->validated($request);
        $data['config'] = $this->buildConfig($request);

        $homepage_widget->update($data);

        return redirect()->route('admin.homepage-widgets.index')
            ->with('success', 'Widget beranda berhasil diperbarui');
    }

    public function destroy(HomepageWidget $homepage_widget)
    {
        $homepage_widget->delete();

        return redirect()->route('admin.homepage-widgets.index')
            ->with('success', 'Widget beranda berhasil dihapus');
    }

    public function searchKota(Request $request, PrayerTimeService $prayerTimeService)
    {
        $q = trim((string) $request->query('q', ''));
        $results = $prayerTimeService->searchKota($q, 20);

        return response()->json([
            'status' => true,
            'data' => $results,
        ]);
    }

    protected function validated(Request $request): array
    {
        $rules = [
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:' . implode(',', array_keys(HomepageWidget::TYPES)),
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
            'lokasi_mode' => 'nullable|in:gps,manual,kota',
            'kota' => 'nullable|string|max:100',
            'kota_id' => 'nullable|string|max:20',
            'label_lokasi' => 'nullable|string|max:120',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
            'tampilkan' => 'nullable|array',
            'tampilkan.*' => 'string',
            'limit' => 'nullable|integer|min:1|max:10',
            'links_json' => 'nullable|string',
            'html' => 'nullable|string',
            'tampilkan_masehi' => 'nullable|boolean',
        ];

        if (in_array($request->input('tipe'), ['prayer_times', 'hijri_calendar'], true)
            && $request->input('lokasi_mode') === 'manual') {
            $rules['lat'] = 'required|numeric|between:-90,90';
            $rules['lng'] = 'required|numeric|between:-180,180';
        }

        return $request->validate($rules, [
            'judul.required' => 'Judul widget wajib diisi',
            'tipe.required' => 'Tipe widget wajib dipilih',
            'lat.required' => 'Latitude wajib diisi untuk mode koordinat manual',
            'lng.required' => 'Longitude wajib diisi untuk mode koordinat manual',
        ]);
    }

    protected function buildConfig(Request $request): array
    {
        $tipe = $request->input('tipe');
        $lokasiMode = $request->input('lokasi_mode', 'gps');

        $resolved = app(PrayerTimeService::class)->resolveKota(
            (string) $request->input('kota', 'Jakarta'),
            $request->input('kota_id') ? (string) $request->input('kota_id') : null
        );

        $locationConfig = [
            'lokasi_mode' => $lokasiMode,
            'kota' => $resolved['lokasi'] ?? $request->input('kota', 'Jakarta'),
            'kota_id' => $resolved['id'] ?? null,
            'label_lokasi' => $request->input('label_lokasi') ?: null,
            'lat' => $lokasiMode === 'manual' ? $request->input('lat') : null,
            'lng' => $lokasiMode === 'manual' ? $request->input('lng') : null,
        ];

        return match ($tipe) {
            'prayer_times' => array_merge($locationConfig, [
                'tampilkan' => $request->input('tampilkan', ['imsak', 'subuh', 'duha', 'dzuhur', 'ashar', 'maghrib', 'isya']),
            ]),
            'hijri_calendar' => array_merge($locationConfig, [
                'tampilkan_masehi' => $request->boolean('tampilkan_masehi', true),
            ]),
            'agenda_mini' => [
                'limit' => (int) $request->input('limit', 5),
            ],
            'quick_links' => [
                'links' => $this->parseLinks($request->input('links_json')),
            ],
            'custom_html' => [
                'html' => $request->input('html', ''),
            ],
            default => [],
        };
    }

    protected function parseLinks(?string $json): array
    {
        if (!$json) {
            return [];
        }

        $decoded = json_decode($json, true);
        if (!is_array($decoded)) {
            return [];
        }

        return collect($decoded)
            ->filter(fn ($item) => !empty($item['label']) && !empty($item['url']))
            ->map(fn ($item) => [
                'label' => $item['label'],
                'url' => $item['url'],
                'icon' => $item['icon'] ?? 'fas fa-link',
            ])
            ->values()
            ->all();
    }
}
