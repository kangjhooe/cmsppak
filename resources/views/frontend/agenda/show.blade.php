@extends('layouts.frontend')

@section('title', $agenda->judul . ' - ' . $schoolName)

@section('content')
<div class="bg-gradient-to-br from-green-50 via-white to-green-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-600 transition-colors duration-200">
                        <i class="fas fa-home mr-2"></i>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('agenda') }}" class="text-gray-700 hover:text-green-600 ml-1 md:ml-2 transition-colors duration-200">
                            Agenda
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-500 ml-1 md:ml-2">{{ Str::limit($agenda->judul, 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Agenda Detail -->
        <article class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
            <!-- Header dengan gradient -->
            <div class="bg-gradient-to-r from-green-600 via-green-700 to-green-800 p-8 text-white text-center relative overflow-hidden">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div class="relative z-10">
                    <!-- Date Badge -->
                    <div class="mb-6">
                        <div class="bg-white/20 backdrop-blur-sm rounded-2xl p-6 inline-block border border-white/30">
                            <div class="text-5xl font-bold text-white">{{ $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format('d') : '-' }}</div>
                            <div class="text-xl text-white/90">{{ $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format('M') : '-' }}</div>
                            <div class="text-sm">{{ $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format('Y') : '-' }}</div>
                        </div>
                    </div>
                    
                    <h1 class="text-4xl font-bold mb-4 text-white">{{ $agenda->judul }}</h1>
                    
                    <!-- Countdown Timer -->
                    @if($agenda->tanggal_mulai && $agenda->tanggal_mulai->isFuture())
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-white/90 mb-4">Menuju Agenda Dimulai:</h3>
                        <div class="countdown-timer bg-white/20 backdrop-blur-sm rounded-2xl p-6 border border-white/30 inline-block">
                            <div class="flex items-center justify-center space-x-6">
                                <div class="countdown-item text-center">
                                    <div class="countdown-value text-3xl font-bold text-white" id="days">00</div>
                                    <div class="countdown-label text-sm text-white/80">Hari</div>
                                </div>
                                <div class="text-white/60 text-2xl font-bold">:</div>
                                <div class="countdown-item text-center">
                                    <div class="countdown-value text-3xl font-bold text-white" id="hours">00</div>
                                    <div class="countdown-label text-sm text-white/80">Jam</div>
                                </div>
                                <div class="text-white/60 text-2xl font-bold">:</div>
                                <div class="countdown-item text-center">
                                    <div class="countdown-value text-3xl font-bold text-white" id="minutes">00</div>
                                    <div class="countdown-label text-sm text-white/80">Menit</div>
                                </div>
                                <div class="text-white/60 text-2xl font-bold">:</div>
                                <div class="countdown-item text-center">
                                    <div class="countdown-value text-3xl font-bold text-white" id="seconds">00</div>
                                    <div class="countdown-label text-sm text-white/80">Detik</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($agenda->auto_status === 'ongoing')
                    <div class="mb-6">
                        <div class="bg-green-500/20 backdrop-blur-sm rounded-2xl p-4 border border-green-300/30 inline-block">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-300 mb-2">
                                    <i class="fas fa-play-circle mr-2"></i>
                                    Agenda Sedang Berlangsung!
                                </div>
                                <div class="text-sm text-green-200">
                                    Agenda ini sedang berlangsung saat ini
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif($agenda->auto_status === 'completed')
                    <div class="mb-6">
                        <div class="bg-gray-500/20 backdrop-blur-sm rounded-2xl p-4 border border-gray-300/30 inline-block">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-300 mb-2">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Agenda Telah Selesai!
                                </div>
                                <div class="text-sm text-gray-200">
                                    Agenda ini telah selesai dilaksanakan
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Status dan Jenis -->
                    <div class="flex flex-wrap items-center justify-center gap-4 mb-6">
                        <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium border border-white/30">
                            {{ ucfirst($agenda->jenis ?? 'Umum') }}
                        </span>
                        <span class="status-badge bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-medium border border-white/30">
                            @switch($agenda->auto_status)
                                @case('upcoming')
                                    Akan Datang
                                    @break
                                @case('ongoing')
                                    Sedang Berlangsung
                                    @break
                                @case('completed')
                                    Selesai
                                    @break
                                @case('cancelled')
                                    Dibatalkan
                                    @break
                                @default
                                    {{ ucfirst($agenda->status ?? 'Akan Datang') }}
                            @endswitch
                        </span>
                    </div>
                    
                    <!-- Info Waktu dan Lokasi -->
                    <div class="flex flex-wrap items-center justify-center gap-6 text-white/90">
                        @if($agenda->waktu_mulai)
                        <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                            <i class="fas fa-clock mr-2 text-white/80"></i>
                            <span>{{ $agenda->waktu_mulai }}</span>
                        </div>
                        @endif
                        
                        @if($agenda->lokasi)
                        <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                            <i class="fas fa-map-marker-alt mr-2 text-white/80"></i>
                            <span>{{ $agenda->lokasi }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                <div class="prose prose-lg max-w-none text-gray-700">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Deskripsi Agenda</h3>
                    <p class="text-lg leading-relaxed text-gray-600">{{ $agenda->deskripsi }}</p>
                </div>

                <!-- Footer -->
                <footer class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="text-sm text-gray-500">
                            <span>Dibuat pada: {{ $agenda->created_at->format('d-m-Y H:i') }}</span>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-500">Bagikan:</span>
                            <a href="#" class="text-green-600 hover:text-green-800 transition-colors duration-200 p-2 rounded-full hover:bg-green-50">
                                <i class="fab fa-twitter text-lg"></i>
                            </a>
                            <a href="#" class="text-green-600 hover:text-green-800 transition-colors duration-200 p-2 rounded-full hover:bg-green-50">
                                <i class="fab fa-facebook text-lg"></i>
                            </a>
                            <a href="#" class="text-green-600 hover:text-green-800 transition-colors duration-200 p-2 rounded-full hover:bg-green-50">
                                <i class="fab fa-whatsapp text-lg"></i>
                            </a>
                        </div>
                    </div>
                </footer>
            </div>
        </article>

        <!-- Related Agenda -->
        @if($agendaTerdekat->count() > 0)
        <div class="mt-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Agenda Terdekat Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($agendaTerdekat as $item)
                <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <div class="p-6">
                        <!-- Date Badge -->
                        <div class="text-center mb-4">
                            <div class="bg-gradient-to-br from-green-500 to-green-700 text-white rounded-xl p-4 inline-block">
                                <div class="text-2xl font-bold">{{ $item->tanggal_mulai ? $item->tanggal_mulai->format('d') : '-' }}</div>
                                <div class="text-sm">{{ $item->tanggal_mulai ? $item->tanggal_mulai->format('M') : '-' }}</div>
                                <div class="text-xs opacity-90">{{ $item->tanggal_mulai ? $item->tanggal_mulai->format('Y') : '-' }}</div>
                            </div>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-900 mb-3 text-center line-clamp-2">
                            {{ $item->judul }}
                        </h3>
                        
                        <!-- Status dan Jenis -->
                        <div class="flex items-center justify-center gap-2 mb-4">
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">
                                {{ ucfirst($item->jenis ?? 'Umum') }}
                            </span>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full">
                                {{ ucfirst($item->status ?? 'Upcoming') }}
                            </span>
                        </div>
                        
                        <div class="space-y-2 mb-4">
                            @if($item->waktu_mulai)
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-clock mr-2 text-green-500"></i>
                                <span>{{ $item->waktu_mulai }}</span>
                            </div>
                            @endif
                            @if($item->lokasi)
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-map-marker-alt mr-2 text-green-500"></i>
                                <span class="line-clamp-1">{{ $item->lokasi }}</span>
                            </div>
                            @endif
                        </div>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit($item->deskripsi, 100) }}
                        </p>

                        <div class="text-center">
                            <a href="{{ route('agenda.show', $item->id) }}" 
                                class="inline-flex items-center justify-center w-full px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-medium rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 transform hover:scale-105">
                                Detail Agenda
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Countdown Timer Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== COUNTDOWN TIMER DEBUG ===');
    
    // Ambil tanggal agenda dengan format yang benar
    const agendaDate = '{{ $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format("Y-m-d") : "" }}';
    const agendaTime = '{{ $agenda->waktu_mulai ? $agenda->waktu_mulai : "00:00" }}';
    
    console.log('Raw agenda date from Blade:', '{{ $agenda->tanggal_mulai }}');
    console.log('Raw agenda time from Blade:', '{{ $agenda->waktu_mulai }}');
    console.log('Formatted agenda date:', agendaDate);
    console.log('Formatted agenda time:', agendaTime);
    
    if (agendaDate && agendaTime) {
        // Bersihkan waktu agar hanya berisi HH:MM:SS
        let cleanTime = agendaTime;
        
        // Jika waktu berisi tanggal, ambil hanya bagian waktu
        if (cleanTime.includes(' ')) {
            const timeParts = cleanTime.split(' ');
            cleanTime = timeParts[timeParts.length - 1]; // Ambil bagian terakhir
            console.log('Cleaned time from datetime:', cleanTime);
        }
        
        // Jika waktu tidak memiliki detik, tambahkan :00
        if (cleanTime.split(':').length === 2) {
            cleanTime += ':00';
        }
        
        // Gabungkan tanggal dan waktu dengan format yang benar
        let eventDateTimeString = agendaDate + ' ' + cleanTime;
        console.log('Event DateTime string:', eventDateTimeString);
        
        let eventDateTime = new Date(eventDateTimeString);
        console.log('Event DateTime object:', eventDateTime);
        console.log('Event DateTime timestamp:', eventDateTime.getTime());
        console.log('Is valid date:', !isNaN(eventDateTime.getTime()));
        
        // Cek apakah tanggal valid
        if (isNaN(eventDateTime.getTime())) {
            console.log('❌ Invalid date format, trying alternative format');
            
            // Coba format alternatif dengan ISO string
            const alternativeFormat = agendaDate + 'T' + cleanTime;
            console.log('Alternative format:', alternativeFormat);
            
            const altEventDateTime = new Date(alternativeFormat);
            console.log('Alternative Event DateTime:', altEventDateTime);
            
            if (!isNaN(altEventDateTime.getTime())) {
                eventDateTime = altEventDateTime;
                console.log('✅ Alternative format works!');
            } else {
                console.log('❌ Both formats failed, cannot proceed');
                return;
            }
        }
        
        // Cek apakah agenda sudah dimulai
        const now = new Date().getTime();
        const distance = eventDateTime.getTime() - now;
        
        console.log('Current time:', new Date());
        console.log('Distance to event (ms):', distance);
        console.log('Distance to event (days):', Math.floor(distance / (1000 * 60 * 60 * 24)));
        
        // Hanya jalankan countdown jika agenda belum dimulai
        if (distance > 0) {
            console.log('✅ Agenda belum dimulai, starting countdown');
            
            // Inisialisasi tampilan countdown langsung
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            console.log('Calculated time components:', { days, hours, minutes, seconds });
            
            // Update tampilan langsung
            const daysElement = document.getElementById('days');
            const hoursElement = document.getElementById('hours');
            const minutesElement = document.getElementById('minutes');
            const secondsElement = document.getElementById('seconds');
            
            if (daysElement) {
                daysElement.textContent = days.toString().padStart(2, '0');
                console.log('✅ Updated days element:', daysElement.textContent);
            }
            if (hoursElement) {
                hoursElement.textContent = hours.toString().padStart(2, '0');
                console.log('✅ Updated hours element:', hoursElement.textContent);
            }
            if (minutesElement) {
                minutesElement.textContent = minutes.toString().padStart(2, '0');
                console.log('✅ Updated minutes element:', minutesElement.textContent);
            }
            if (secondsElement) {
                secondsElement.textContent = seconds.toString().padStart(2, '0');
                console.log('✅ Updated seconds element:', secondsElement.textContent);
            }
            
            // Jalankan countdown timer
            const countdown = setInterval(function() {
                const currentTime = new Date().getTime();
                const currentDistance = eventDateTime.getTime() - currentTime;
                
                if (currentDistance > 0) {
                    // Hitung hari, jam, menit, detik
                    const days = Math.floor(currentDistance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((currentDistance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((currentDistance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((currentDistance % (1000 * 60)) / 1000);
                    
                    // Update tampilan
                    const daysElement = document.getElementById('days');
                    const hoursElement = document.getElementById('hours');
                    const minutesElement = document.getElementById('minutes');
                    const secondsElement = document.getElementById('seconds');
                    
                    if (daysElement) daysElement.textContent = days.toString().padStart(2, '0');
                    if (hoursElement) hoursElement.textContent = hours.toString().padStart(2, '0');
                    if (minutesElement) minutesElement.textContent = minutes.toString().padStart(2, '0');
                    if (secondsElement) secondsElement.textContent = seconds.toString().padStart(2, '0');
                    
                    // Tambahkan efek visual saat detik berubah
                    if (secondsElement) {
                        secondsElement.style.transform = 'scale(1.1)';
                        secondsElement.style.color = '#fbbf24';
                        
                        setTimeout(() => {
                            secondsElement.style.transform = 'scale(1)';
                            secondsElement.style.color = 'white';
                        }, 200);
                    }
                    
                } else {
                    // Agenda telah dimulai
                    console.log('Countdown finished, agenda started');
                    clearInterval(countdown);
                    
                    // Update tampilan countdown
                    const daysElement = document.getElementById('days');
                    const hoursElement = document.getElementById('hours');
                    const minutesElement = document.getElementById('minutes');
                    const secondsElement = document.getElementById('seconds');
                    
                    if (daysElement) daysElement.textContent = '00';
                    if (hoursElement) hoursElement.textContent = '00';
                    if (minutesElement) minutesElement.textContent = '00';
                    if (secondsElement) secondsElement.textContent = '00';
                    
                    // Tampilkan pesan agenda telah dimulai
                    const countdownTimer = document.querySelector('.countdown-timer');
                    if (countdownTimer) {
                        countdownTimer.innerHTML = `
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-300 mb-2">
                                    <i class="fas fa-play-circle mr-2"></i>
                                    Agenda Telah Dimulai!
                                </div>
                                <div class="text-sm text-green-200">
                                    Agenda sedang berlangsung
                                </div>
                            </div>
                        `;
                    }
                    
                    // Update status badge
                    const statusBadge = document.querySelector('.status-badge');
                    if (statusBadge) {
                        statusBadge.textContent = 'Ongoing';
                        statusBadge.className = 'status-badge bg-green-500/20 backdrop-blur-sm text-green-300 px-4 py-2 rounded-full text-sm font-medium border border-green-300/30';
                    }
                }
            }, 1000);
        } else {
            console.log('❌ Agenda sudah dimulai, tidak perlu countdown');
        }
    } else {
        // Jika tidak ada tanggal atau waktu, sembunyikan countdown timer
        console.log('❌ No agenda date or time, hiding countdown');
        const countdownTimer = document.querySelector('.countdown-timer');
        if (countdownTimer) {
            countdownTimer.style.display = 'none';
        }
    }
    
    console.log('=== END COUNTDOWN TIMER DEBUG ===');
});
</script>
@endsection
