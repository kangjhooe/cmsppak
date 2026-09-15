@php
    $prayerService = app(\App\Services\PrayerTimeService::class);
@endphp

<aside class="space-y-4 lg:sticky lg:top-24 homepage-widgets">
    @forelse($homepageWidgets ?? [] as $index => $widget)
        @php $palette = $widget->palette; @endphp
        <div class="home-widget-card"
             style="--card-accent: {{ $palette['accent'] }}; --card-accent-bright: {{ $palette['accent-bright'] }}; --card-soft: {{ $palette['soft'] }}; --card-ink: {{ $palette['ink'] }}; --card-shadow: {{ $palette['shadow'] }}; --card-delay: {{ min($index * 90, 450) }}ms;">
            <span class="home-widget-card__blob" aria-hidden="true"></span>
            <span class="home-widget-card__shine" aria-hidden="true"></span>
            <div class="home-widget-card__bar"></div>
            <div class="home-widget-card__body">
                @includeIf('frontend.widgets.' . $widget->tipe, [
                    'widget' => $widget,
                    'prayerService' => $prayerService,
                ])
            </div>
        </div>
    @empty
        <div class="home-widget-card" style="--card-delay: 0ms;">
            <span class="home-widget-card__blob" aria-hidden="true"></span>
            <div class="home-widget-card__bar"></div>
            <div class="home-widget-card__body">
                <p class="text-sm text-gray-500">Widget beranda belum diatur.</p>
            </div>
        </div>
    @endforelse
</aside>
