@php
    $limit = (int) $widget->configValue('limit', 5);
    $items = ($agenda ?? collect())->take($limit);
@endphp

<div class="home-widget-inner">
    <div class="home-widget-head">
        <div class="min-w-0">
            <h3>{{ $widget->judul }}</h3>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('agenda') }}" class="home-widget-all">Semua</a>
            <span class="home-widget-icon" aria-hidden="true">
                <i class="{{ $widget->icon }}"></i>
            </span>
        </div>
    </div>

    <div class="home-agenda-list">
        @forelse($items as $event)
            <a href="{{ route('agenda.show', $event->id) }}" class="home-agenda-item">
                <div class="home-agenda-date">
                    <div class="home-agenda-date__day">{{ $event->tanggal_mulai ? $event->tanggal_mulai->format('d') : '--' }}</div>
                    <div class="home-agenda-date__month">{{ $event->tanggal_mulai ? $event->tanggal_mulai->format('M') : '' }}</div>
                </div>
                <div class="min-w-0 pt-0.5">
                    <div class="home-agenda-item__title">{{ $event->judul }}</div>
                    @if($event->waktu_mulai)
                        <div class="home-agenda-item__time">{{ $event->waktu_mulai }}</div>
                    @endif
                </div>
            </a>
        @empty
            <p class="home-widget-empty">Belum ada agenda</p>
        @endforelse
    </div>
</div>
