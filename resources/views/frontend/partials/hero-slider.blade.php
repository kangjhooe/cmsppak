{{-- Full-bleed cinematic hero slider --}}
@php
    $slides = $heroSlides ?? collect();
@endphp

@if($slides->count() > 0)
<section
    class="relative w-full overflow-hidden bg-[#0a1f0a] group/hero"
    x-data="{
        active: 0,
        total: {{ $slides->count() }},
        timer: null,
        progress: 0,
        duration: 6000,
        tick: null,
        start() {
            this.stop();
            if (this.total <= 1) return;
            this.progress = 0;
            const step = 50;
            this.tick = setInterval(() => {
                this.progress += (step / this.duration) * 100;
                if (this.progress >= 100) {
                    this.progress = 0;
                    this.active = (this.active + 1) % this.total;
                }
            }, step);
        },
        stop() {
            if (this.tick) clearInterval(this.tick);
        },
        go(i) { this.active = i; this.progress = 0; this.start(); },
        next() { this.active = (this.active + 1) % this.total; this.progress = 0; this.start(); },
        prev() { this.active = (this.active - 1 + this.total) % this.total; this.progress = 0; this.start(); }
    }"
    x-init="start()"
    @mouseenter="stop()"
    @mouseleave="start()"
>
    <div class="relative w-full" style="height: min(68vh, 680px); min-height: 380px;">
        @foreach($slides as $index => $slide)
            <div
                class="absolute inset-0 transition-opacity duration-700 ease-out"
                :class="active === {{ $index }} ? 'opacity-100 z-10' : 'opacity-0 z-0 pointer-events-none'"
                @if($index === 0) style="opacity: 1; z-index: 10;" @endif
            >
                <img
                    src="{{ $slide->gambar_url }}"
                    alt="{{ $slide->judul ?: ($profile->nama_sekolah ?? $schoolName) }}"
                    class="absolute inset-0 w-full h-full object-cover"
                    style="transform: scale(1.04); transition: transform 7s ease-out;"
                    :style="active === {{ $index }} ? 'transform: scale(1)' : 'transform: scale(1.04)'"
                    @if($index > 0) loading="lazy" @endif
                >

                {{-- Overlay: brand-tinted, readable left --}}
                <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/45 to-black/20"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a1f0a]/80 via-transparent to-black/10"></div>

                @if($slide->tampilkan_teks && ($slide->judul || $slide->subjudul || $slide->link_url))
                <div class="absolute inset-0 flex items-end sm:items-center pb-20 sm:pb-0">
                    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div
                            class="max-w-xl lg:max-w-2xl text-white transition-all duration-700"
                            :class="active === {{ $index }} ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-3'"
                            @if($index === 0) style="opacity: 1; transform: none;" @endif
                        >
                            <div class="inline-flex items-center gap-2 mb-4 text-xs sm:text-sm font-semibold tracking-wide uppercase text-[#CCFF99]">
                                <span class="w-8 h-px bg-[#CCFF99]"></span>
                                {{ $profile->nama_sekolah ?? $schoolName }}
                            </div>

                            @if($slide->judul)
                                <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl xl:text-[3.25rem] font-bold leading-[1.15] mb-4 text-white">
                                    {{ $slide->judul }}
                                </h1>
                            @endif

                            @if($slide->subjudul)
                                <p class="text-sm sm:text-base lg:text-lg text-white/85 mb-7 leading-relaxed max-w-lg">
                                    {{ $slide->subjudul }}
                                </p>
                            @endif

                            @if($slide->link_url)
                                <a href="{{ $slide->link_url }}"
                                   class="inline-flex items-center gap-2 px-6 py-3 bg-white text-[var(--color-primary-dark)] font-semibold rounded-full hover:bg-[#CCFF99] hover:text-[#003300] transition-colors duration-300 shadow-lg shadow-black/20">
                                    {{ $slide->link_teks ?: 'Selengkapnya' }}
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        @endforeach
    </div>

    @if($slides->count() > 1)
    {{-- Controls --}}
    <div class="absolute bottom-0 inset-x-0 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-5 flex items-end justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="text-white/90 text-sm font-semibold tabular-nums" x-text="String(active + 1).padStart(2,'0')"></span>
                <div class="w-16 sm:w-24 h-[2px] bg-white/25 rounded-full overflow-hidden">
                    <div class="h-full bg-[#CCFF99] transition-none" :style="'width:' + progress + '%'"></div>
                </div>
                <span class="text-white/50 text-sm tabular-nums">{{ str_pad($slides->count(), 2, '0', STR_PAD_LEFT) }}</span>
            </div>

            <div class="flex items-center gap-2">
                <button type="button" @click="prev()"
                        class="w-10 h-10 rounded-full border border-white/30 bg-white/10 hover:bg-white hover:text-[var(--color-primary-dark)] text-white backdrop-blur-sm flex items-center justify-center transition-colors"
                        aria-label="Slide sebelumnya">
                    <i class="fas fa-chevron-left text-xs"></i>
                </button>
                <button type="button" @click="next()"
                        class="w-10 h-10 rounded-full border border-white/30 bg-white/10 hover:bg-white hover:text-[var(--color-primary-dark)] text-white backdrop-blur-sm flex items-center justify-center transition-colors"
                        aria-label="Slide berikutnya">
                    <i class="fas fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>
    </div>
    @endif
</section>
@else
<section class="relative w-full overflow-hidden text-white"
         style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 55%, #003300 100%);">
    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 20% 20%, #CCFF99 0, transparent 40%), radial-gradient(circle at 80% 80%, #FFFF00 0, transparent 35%);"></div>
    <div class="relative min-h-[420px] flex items-center py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 mb-4 text-sm font-semibold tracking-wide uppercase text-[#CCFF99]">
                    <span class="w-8 h-px bg-[#CCFF99]"></span>
                    Beranda
                </div>
                <h1 class="font-display text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                    {{ $profile->nama_sekolah ?? $schoolName }}
                </h1>
                <p class="text-green-100/90 text-base lg:text-lg mb-8 max-w-xl leading-relaxed">
                    {{ $schoolDescription ?? 'Pendidikan berkualitas untuk membentuk generasi unggul.' }}
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('profil') }}" class="px-6 py-3 bg-white text-[var(--color-primary-dark)] rounded-full font-semibold hover:bg-[#CCFF99] transition-colors">Pelajari Lebih Lanjut</a>
                    <a href="{{ route('kontak') }}" class="px-6 py-3 border border-white/40 rounded-full font-semibold hover:bg-white/10 transition-colors">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
