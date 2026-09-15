<div class="home-widget-inner">
    <div class="home-widget-head">
        <div class="min-w-0">
            <h3>{{ $widget->judul }}</h3>
        </div>
        <span class="home-widget-icon" aria-hidden="true">
            <i class="{{ $widget->icon }}"></i>
        </span>
    </div>
    <div class="prose prose-sm max-w-none text-gray-600 prose-a:text-[var(--card-ink)]">
        {!! $widget->configValue('html', '') !!}
    </div>
</div>
