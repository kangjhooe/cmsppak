@php
    $hijri = $prayerService->getHijriDate($widget->config ?? []);
    $showMasehi = $widget->configValue('tampilkan_masehi', true);
@endphp

<div class="home-widget-inner home-hijri">
    <div class="home-widget-head home-widget-head--center">
        <h3>{{ $widget->judul }}</h3>
    </div>

    <div class="home-hijri__coin" aria-hidden="true">
        <span class="home-hijri__day">{{ $hijri['day'] }}</span>
    </div>
    <div class="home-hijri__month">{{ $hijri['month'] }} {{ $hijri['year'] }} H</div>
    @if($showMasehi)
        <p class="home-hijri__masehi">{{ $hijri['masehi'] }}</p>
    @endif
    <p class="home-widget-source home-widget-source--center">Sumber: {{ $hijri['source_label'] ?? 'Kemenag RI' }}</p>
</div>
