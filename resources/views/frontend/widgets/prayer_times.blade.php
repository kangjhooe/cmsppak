@php
    $data = $prayerService->getToday($widget->config ?? []);
    $now = \Carbon\Carbon::now()->format('H:i');
    $nextKey = null;
    foreach ($data['prayers'] ?? [] as $i => $prayer) {
        if ($prayer['waktu'] !== '--:--' && $prayer['waktu'] > $now) {
            $nextKey = $i;
            break;
        }
    }
    if ($nextKey === null && !empty($data['prayers'])) {
        $nextKey = 0;
    }

    $lokasiLabel = $data['lokasi_label'] ?? ($data['kota'] ?? '');
    $lokasiMode = $data['lokasi_mode'] ?? 'gps';
    $modeIcon = match ($lokasiMode) {
        'manual' => 'fa-map-marker-alt',
        'kota' => 'fa-city',
        default => 'fa-location-arrow',
    };
@endphp

<div class="home-widget-inner">
    <div class="home-widget-head">
        <div class="min-w-0">
            <h3>{{ $widget->judul }}</h3>
            <p class="home-widget-meta">
                <span class="home-widget-meta__accent">
                    <i class="fas {{ $modeIcon }}"></i>
                    <span class="truncate max-w-[11rem]">{{ $lokasiLabel }}</span>
                </span>
                <span class="home-widget-meta__dot">·</span>
                <span>{{ \Carbon\Carbon::parse($data['tanggal'] ?? now())->locale('id')->translatedFormat('d M Y') }}</span>
            </p>
        </div>
        <span class="home-widget-icon" aria-hidden="true">
            <i class="{{ $widget->icon }}"></i>
        </span>
    </div>

    <div class="home-prayer-grid">
        @foreach($data['prayers'] ?? [] as $i => $prayer)
            <div @class([
                    'home-prayer-slot',
                    'home-prayer-slot--next' => $nextKey === $i,
                ])
                style="animation-delay: {{ 120 + ($i * 60) }}ms">
                <div class="home-prayer-slot__name">
                    <span>{{ $prayer['nama'] }}</span>
                    @if($nextKey === $i)
                        <span class="home-prayer-slot__badge">berikutnya</span>
                    @endif
                </div>
                <div class="home-prayer-slot__time">{{ $prayer['waktu'] }}</div>
            </div>
        @endforeach
    </div>

    <p class="home-widget-source">Sumber: {{ $data['source_label'] ?? 'Kemenag RI' }}</p>
</div>
