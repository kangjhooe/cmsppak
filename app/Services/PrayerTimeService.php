<?php

namespace App\Services;

use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PrayerTimeService
{
    public const LOKASI_GPS = 'gps';
    public const LOKASI_MANUAL = 'manual';
    public const LOKASI_KOTA = 'kota';

    /** Data jadwal bersumber Kemenag RI, diakses via API publik myQuran. */
    protected const MYQURAN_BASE = 'https://api.myquran.com/v2';

    /** Kalender Hijriyah (metode standar Indonesia / Kemenag-aligned). */
    protected const MYQURAN_CAL_BASE = 'https://api.myquran.com/v3';

    public function getToday(array $config = []): array
    {
        $date = Carbon::today()->format('Y-m-d');
        $location = $this->resolveLocation($config);
        $resolvedKota = $this->resolveKota(
            (string) ($config['kota'] ?? ''),
            isset($config['kota_id']) ? (string) $config['kota_id'] : null
        );
        $kotaId = $resolvedKota['id'] ?? null;
        $city = $resolvedKota['lokasi'] ?? ($config['kota'] ?? 'Jakarta');

        $cacheKey = 'prayer_times_kemenag_' . md5(implode('|', [
            $kotaId ?? '',
            $location['mode'],
            $location['lat'] ?? '',
            $location['lng'] ?? '',
            $location['cache_bust'] ?? '',
            $city,
            $date,
            implode(',', $config['tampilkan'] ?? []),
        ]));

        return Cache::remember($cacheKey, now()->endOfDay(), function () use ($city, $date, $config, $location, $kotaId) {
            try {
                if (!$kotaId) {
                    Log::warning('PrayerTimeService: kota_id Kemenag tidak ditemukan untuk "' . ($config['kota'] ?? '') . '"');
                    return $this->fallback($location['label'], $date, $location['mode']);
                }

                $response = Http::timeout(10)->get(self::MYQURAN_BASE . '/sholat/jadwal/' . $kotaId . '/' . $date);

                if (!$response->successful() || !($response->json('status') ?? false)) {
                    return $this->fallback($location['label'], $date, $location['mode']);
                }

                $data = $response->json('data') ?? [];
                $jadwal = $data['jadwal'] ?? [];
                $lokasiApi = trim(($data['lokasi'] ?? '') . (!empty($data['daerah']) ? ', ' . $data['daerah'] : ''));

                $labels = [
                    'imsak' => 'Imsak',
                    'subuh' => 'Subuh',
                    'terbit' => 'Terbit',
                    'duha' => 'Duha',
                    'dzuhur' => 'Dzuhur',
                    'ashar' => 'Ashar',
                    'maghrib' => 'Maghrib',
                    'isya' => 'Isya',
                ];

                $map = [
                    'imsak' => $jadwal['imsak'] ?? null,
                    'subuh' => $jadwal['subuh'] ?? null,
                    'terbit' => $jadwal['terbit'] ?? null,
                    'duha' => $jadwal['dhuha'] ?? ($jadwal['duha'] ?? null),
                    'dzuhur' => $jadwal['dzuhur'] ?? null,
                    'ashar' => $jadwal['ashar'] ?? null,
                    'maghrib' => $jadwal['maghrib'] ?? null,
                    'isya' => $jadwal['isya'] ?? null,
                ];

                $show = $config['tampilkan'] ?? ['imsak', 'subuh', 'duha', 'dzuhur', 'ashar', 'maghrib', 'isya'];
                $prayers = [];
                foreach ($show as $key) {
                    if (!empty($map[$key])) {
                        $prayers[] = [
                            'nama' => $labels[$key] ?? ucfirst($key),
                            'waktu' => substr((string) $map[$key], 0, 5),
                        ];
                    }
                }

                $label = !empty($config['label_lokasi'])
                    ? $config['label_lokasi']
                    : ($location['mode'] === self::LOKASI_KOTA
                        ? ($lokasiApi ?: $location['label'])
                        : $location['label']);

                return [
                    'kota' => $city,
                    'kota_id' => (string) $kotaId,
                    'lokasi_label' => $label ?: ($lokasiApi ?: $city),
                    'lokasi_api' => $lokasiApi,
                    'lokasi_mode' => $location['mode'],
                    'tanggal' => $date,
                    'prayers' => $prayers,
                    'hijri' => $this->fetchHijriMeta($date),
                    'source' => 'kemenag',
                    'source_label' => 'Kemenag RI',
                ];
            } catch (\Throwable $e) {
                Log::warning('PrayerTimeService failed: ' . $e->getMessage());
                return $this->fallback($location['label'], $date, $location['mode']);
            }
        });
    }

    /**
     * Resolve display location from widget config.
     *
     * Jadwal Kemenag berbasis kab/kota (bukan koordinat exact), jadi GPS/manual
     * dipakai untuk label; lookup jadwal tetap lewat kota_id / nama kota.
     */
    public function resolveLocation(array $config): array
    {
        $mode = $config['lokasi_mode'] ?? self::LOKASI_GPS;
        if (!in_array($mode, [self::LOKASI_GPS, self::LOKASI_MANUAL, self::LOKASI_KOTA], true)) {
            $mode = self::LOKASI_GPS;
        }

        $city = $config['kota'] ?? 'Jakarta';
        $profile = Profile::first();

        if ($mode === self::LOKASI_MANUAL) {
            $lat = $config['lat'] ?? null;
            $lng = $config['lng'] ?? null;

            if ($this->isValidCoord($lat, $lng)) {
                return [
                    'mode' => self::LOKASI_MANUAL,
                    'use_coords' => true,
                    'lat' => (float) $lat,
                    'lng' => (float) $lng,
                    'label' => $config['label_lokasi'] ?? $city,
                ];
            }

            $mode = self::LOKASI_GPS;
        }

        if ($mode === self::LOKASI_GPS) {
            $lat = $profile?->koordinat_lat;
            $lng = $profile?->koordinat_lng;

            if ($this->isValidCoord($lat, $lng)) {
                $label = $config['label_lokasi']
                    ?? ($profile->nama_sekolah ?? null)
                    ?? $city;

                return [
                    'mode' => self::LOKASI_GPS,
                    'use_coords' => true,
                    'lat' => (float) $lat,
                    'lng' => (float) $lng,
                    'label' => $label,
                    'cache_bust' => optional($profile->updated_at)->timestamp,
                ];
            }
        }

        return [
            'mode' => self::LOKASI_KOTA,
            'use_coords' => false,
            'lat' => null,
            'lng' => null,
            'label' => $config['label_lokasi'] ?? $city,
        ];
    }

    public function getHijriDate(array $config = []): array
    {
        Carbon::setLocale('id');
        $date = Carbon::today()->format('Y-m-d');
        $cacheKey = 'hijri_kemenag_' . $date;

        $hijri = Cache::remember($cacheKey, now()->endOfDay(), function () use ($date) {
            return $this->fetchHijriMeta($date);
        });

        $monthId = $this->normalizeHijriMonth(
            is_array($hijri['month'] ?? null) ? ($hijri['month']['en'] ?? '') : (string) ($hijri['month'] ?? '')
        );

        $day = $hijri['day'] ?? '-';
        $year = $hijri['year'] ?? '-';

        $resolved = $this->resolveKota(
            (string) ($config['kota'] ?? ''),
            isset($config['kota_id']) ? (string) $config['kota_id'] : null
        );

        return [
            'full' => trim($day . ' ' . $monthId . ' ' . $year . ' H'),
            'day' => $day,
            'month' => $monthId !== '' ? $monthId : '-',
            'year' => $year,
            'masehi' => $hijri['masehi'] ?? Carbon::today()->translatedFormat('l, d F Y'),
            'kota' => !empty($config['label_lokasi'])
                ? $config['label_lokasi']
                : ($resolved['lokasi'] ?? ($config['kota'] ?? 'Jakarta')),
            'source' => $hijri['source'] ?? 'fallback',
            'source_label' => 'Kemenag RI',
        ];
    }

    /**
     * Resolve kota name + id for save/display. Prefer explicit id when it matches the name;
     * otherwise search by name so ganti "Jakarta" → "Pesisir Barat" tidak tertahan di ID lama.
     *
     * @return array{id: ?string, lokasi: ?string}
     */
    public function resolveKota(string $kota, ?string $kotaId = null): array
    {
        $kota = trim($kota);
        $kotaId = $kotaId !== null ? trim($kotaId) : '';

        if ($kotaId !== '') {
            $byId = $this->findKotaById($kotaId);
            if ($byId) {
                if ($kota === '' || $this->kotaNameMatches($kota, $byId['lokasi'])) {
                    return $byId;
                }
                // Nama diganti tapi ID masih lama → cari ulang dari nama
            }
        }

        if ($kota === '') {
            $kota = 'Jakarta';
        }

        $found = $this->searchKota($kota, 1);

        return $found[0] ?? ['id' => null, 'lokasi' => $kota];
    }

    /**
     * Autocomplete / pencarian kota Kemenag.
     *
     * @return list<array{id: string, lokasi: string}>
     */
    public function searchKota(string $keyword, int $limit = 15): array
    {
        $keyword = trim($keyword);
        if ($keyword === '') {
            return array_slice($this->getAllKota(), 0, $limit);
        }

        $aliasId = $this->kotaAliases()[mb_strtolower($keyword)] ?? null;
        if ($aliasId) {
            $hit = $this->findKotaById($aliasId);
            if ($hit) {
                return [$hit];
            }
        }

        $tokens = preg_split('/\s+/u', mb_strtolower($keyword), -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $scored = [];

        foreach ($this->getAllKota() as $row) {
            $nama = mb_strtolower($row['lokasi']);
            $score = $this->scoreKotaMatch($nama, mb_strtolower($keyword), $tokens);
            if ($score > 0) {
                $scored[] = ['score' => $score, 'row' => $row];
            }
        }

        usort($scored, fn ($a, $b) => $b['score'] <=> $a['score']);

        return array_values(array_map(
            fn ($item) => $item['row'],
            array_slice($scored, 0, max(1, $limit))
        ));
    }

    /**
     * @return list<array{id: string, lokasi: string}>
     */
    public function getAllKota(): array
    {
        return Cache::remember('kemenag_kota_semua_v1', now()->addDays(7), function () {
            try {
                $response = Http::timeout(15)->get(self::MYQURAN_BASE . '/sholat/kota/semua');
                if (!$response->successful() || !($response->json('status') ?? false)) {
                    return [];
                }

                $rows = $response->json('data') ?? [];
                if (!is_array($rows)) {
                    return [];
                }

                return collect($rows)
                    ->map(fn ($row) => [
                        'id' => (string) ($row['id'] ?? ''),
                        'lokasi' => (string) ($row['lokasi'] ?? ''),
                    ])
                    ->filter(fn ($row) => $row['id'] !== '' && $row['lokasi'] !== '')
                    ->values()
                    ->all();
            } catch (\Throwable $e) {
                Log::warning('PrayerTimeService getAllKota failed: ' . $e->getMessage());
                return [];
            }
        });
    }

    protected function findKotaById(string $id): ?array
    {
        $id = trim($id);
        foreach ($this->getAllKota() as $row) {
            if ($row['id'] === $id) {
                return $row;
            }
        }

        return null;
    }

    protected function kotaNameMatches(string $keyword, string $lokasi): bool
    {
        $keyword = mb_strtolower(trim($keyword));
        $lokasi = mb_strtolower(trim($lokasi));

        if ($keyword === '' || $lokasi === '') {
            return false;
        }

        if ($keyword === $lokasi || str_contains($lokasi, $keyword)) {
            return true;
        }

        $tokens = preg_split('/\s+/u', $keyword, -1, PREG_SPLIT_NO_EMPTY) ?: [];

        return $this->scoreKotaMatch($lokasi, $keyword, $tokens) >= 50;
    }

    /**
     * @param  list<string>  $tokens
     */
    protected function scoreKotaMatch(string $nama, string $keyword, array $tokens): int
    {
        if ($nama === $keyword) {
            return 100;
        }

        if (str_contains($nama, $keyword)) {
            return 90;
        }

        // Strip "kab." / "kota " prefix for freer matching
        $namaBare = trim(preg_replace('/^(kab\.|kota)\s+/u', '', $nama) ?? $nama);
        if ($namaBare === $keyword || str_contains($namaBare, $keyword)) {
            return 85;
        }

        if ($tokens === []) {
            return 0;
        }

        $hit = 0;
        foreach ($tokens as $token) {
            if ($token !== '' && str_contains($nama, $token)) {
                $hit++;
            }
        }

        if ($hit === count($tokens)) {
            return 70 + min(10, $hit);
        }

        if ($hit > 0 && $hit >= (int) ceil(count($tokens) * 0.6)) {
            return 40 + $hit;
        }

        return 0;
    }

    /**
     * Nama lokal / sebutan umum → ID Kemenag.
     *
     * @return array<string, string>
     */
    protected function kotaAliases(): array
    {
        return [
            'krui' => '1008',
            'pesisir barat' => '1008',
            'kab. pesisir barat' => '1008',
            'kab pesisir barat' => '1008',
            'jakarta' => '1301',
            'kota jakarta' => '1301',
            'dki jakarta' => '1301',
        ];
    }

    /**
     * Kalender Hijriyah dari API myQuran v3 (metode standar Indonesia / Kemenag-aligned).
     */
    protected function fetchHijriMeta(string $date): array
    {
        try {
            $response = Http::timeout(8)->get(self::MYQURAN_CAL_BASE . '/cal/hijr/' . $date, [
                'method' => 'standar',
                'adj' => 0,
                'tz' => 'Asia/Jakarta',
            ]);

            if (!$response->successful() || !($response->json('status') ?? false)) {
                return $this->fallbackHijriMeta($date);
            }

            $hijr = $response->json('data.hijr') ?? [];
            $ce = $response->json('data.ce') ?? [];

            if (empty($hijr['day']) || empty($hijr['year'])) {
                return $this->fallbackHijriMeta($date);
            }

            return [
                'day' => (string) ($hijr['day'] ?? ''),
                'month' => (string) ($hijr['monthName'] ?? ''),
                'month_number' => $hijr['month'] ?? null,
                'year' => (string) ($hijr['year'] ?? ''),
                'weekday' => $hijr['dayName'] ?? null,
                'full' => $hijr['today'] ?? null,
                'masehi' => $ce['today'] ?? Carbon::parse($date)->locale('id')->translatedFormat('l, d F Y'),
                'designation' => 'AH',
                'source' => 'kemenag',
            ];
        } catch (\Throwable $e) {
            Log::warning('PrayerTimeService fetchHijriMeta failed: ' . $e->getMessage());
            return $this->fallbackHijriMeta($date);
        }
    }

    protected function fallbackHijriMeta(string $date): array
    {
        return [
            'day' => null,
            'month' => null,
            'year' => null,
            'masehi' => Carbon::parse($date)->locale('id')->translatedFormat('l, d F Y'),
            'source' => 'fallback',
        ];
    }

    protected function normalizeHijriMonth(string $month): string
    {
        $month = trim($month);
        if ($month === '') {
            return '';
        }

        $map = [
            // myQuran v3 (Indonesia)
            'Muharram' => 'Muharram',
            'Safar' => 'Safar',
            'Rabiulawal' => 'Rabiul Awal',
            'Rabiulakhir' => 'Rabiul Akhir',
            'Jumadilawal' => 'Jumadil Awal',
            'Jumadilakhir' => 'Jumadil Akhir',
            'Rajab' => 'Rajab',
            "Sya'ban" => "Sya'ban",
            'Syaban' => "Sya'ban",
            'Ramadhan' => 'Ramadan',
            'Ramadan' => 'Ramadan',
            'Syawal' => 'Syawal',
            "Dzulqa'dah" => "Dzulqa'dah",
            'Dzulqadah' => "Dzulqa'dah",
            'Dzulhijjah' => 'Dzulhijjah',
            // AlAdhan leftovers (jika masih ada di cache lama)
            'Rabiʻ I' => 'Rabiul Awal',
            'Rabiʻ II' => 'Rabiul Akhir',
            "Rabi' I" => 'Rabiul Awal',
            "Rabi' II" => 'Rabiul Akhir',
            'Jumada I' => 'Jumadil Awal',
            'Jumada II' => 'Jumadil Akhir',
            "Shaʻban" => "Sya'ban",
            "Sha'ban" => "Sya'ban",
            'Shawwal' => 'Syawal',
            "Dhuʻl-Qiʻdah" => "Dzulqa'dah",
            "Dhu'l-Qi'dah" => "Dzulqa'dah",
            "Dhuʻl-Hijjah" => 'Dzulhijjah',
            "Dhu'l-Hijjah" => 'Dzulhijjah',
        ];

        foreach ($map as $from => $to) {
            if (strcasecmp($month, $from) === 0) {
                return $to;
            }
        }

        return $month;
    }

    protected function isValidCoord(mixed $lat, mixed $lng): bool
    {
        if ($lat === null || $lng === null || $lat === '' || $lng === '') {
            return false;
        }

        if (!is_numeric($lat) || !is_numeric($lng)) {
            return false;
        }

        $lat = (float) $lat;
        $lng = (float) $lng;

        return $lat >= -90 && $lat <= 90 && $lng >= -180 && $lng <= 180;
    }

    protected function fallback(string $label, string $date, string $mode = self::LOKASI_KOTA): array
    {
        return [
            'kota' => $label,
            'lokasi_label' => $label,
            'lokasi_mode' => $mode,
            'tanggal' => $date,
            'prayers' => [
                ['nama' => 'Subuh', 'waktu' => '--:--'],
                ['nama' => 'Dzuhur', 'waktu' => '--:--'],
                ['nama' => 'Ashar', 'waktu' => '--:--'],
                ['nama' => 'Maghrib', 'waktu' => '--:--'],
                ['nama' => 'Isya', 'waktu' => '--:--'],
            ],
            'hijri' => [],
            'source' => 'fallback',
            'source_label' => 'Kemenag RI',
        ];
    }
}
