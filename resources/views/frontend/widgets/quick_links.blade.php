@php
    $links = $widget->configValue('links', []);
@endphp

<div class="home-widget-inner">
    <div class="home-widget-head">
        <div class="min-w-0">
            <h3>{{ $widget->judul }}</h3>
        </div>
        <span class="home-widget-icon" aria-hidden="true">
            <i class="{{ $widget->icon }}"></i>
        </span>
    </div>

    <div class="home-quick-list">
        @forelse($links as $link)
            <a href="{{ $link['url'] }}" class="home-quick-link">
                <span class="home-quick-link__icon" aria-hidden="true">
                    <i class="{{ $link['icon'] ?? 'fas fa-link' }}"></i>
                </span>
                <span class="home-quick-link__label">{{ $link['label'] }}</span>
                <i class="fas fa-chevron-right home-quick-link__chevron"></i>
            </a>
        @empty
            <p class="home-widget-empty">Belum ada tautan</p>
        @endforelse
    </div>
</div>
