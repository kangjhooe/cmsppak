@extends('layouts.frontend')

@section('title', 'Kebijakan Cookie - ' . ($profile->nama_sekolah ?? $schoolName))

@section('content')
<div class="bg-green-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        @include('frontend.legal.partials.nav')

        <article class="bg-white rounded-xl shadow-lg p-6 sm:p-10">
            <header class="mb-8 pb-6 border-b border-gray-100">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Kebijakan Cookie</h1>
                <p class="text-sm text-gray-500">Terakhir diperbarui: {{ date('d F Y') }}</p>
            </header>

            <div class="prose prose-green max-w-none text-gray-700 space-y-6">
                <p>
                    Kebijakan Cookie ini menjelaskan penggunaan cookie pada situs
                    <strong>{{ $profile->nama_sekolah ?? $schoolName }}</strong>.
                    Cookie adalah file kecil yang disimpan di perangkat Anda saat mengunjungi situs web.
                </p>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">1. Cookie yang Kami Gunakan</h2>
                    <p class="mb-3">
                        Saat ini situs ini terutama menggunakan <strong>cookie teknis/wajib</strong>
                        agar fitur dasar berjalan dengan baik, antara lain:
                    </p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li><strong>Cookie sesi</strong> — menjaga status login pengguna admin/operator.</li>
                        <li><strong>Cookie CSRF / keamanan</strong> — membantu melindungi formulir dari permintaan palsu.</li>
                        <li><strong>Preferensi sesi singkat</strong> — bila diperlukan untuk menjaga kelancaran navigasi atau pesan sistem.</li>
                    </ul>
                    <p class="mt-3">
                        Kami tidak menggunakan cookie iklan atau pelacak pemasaran pihak ketiga pada situs ini.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">2. Mengapa Cookie Diperlukan</h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Menjaga keamanan area administrasi.</li>
                        <li>Memastikan formulir (kontak, komentar, buku tamu) berfungsi dengan aman.</li>
                        <li>Memberikan pengalaman penggunaan yang stabil.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">3. Cookie dari Konten Pihak Ketiga</h2>
                    <p>
                        Jika halaman menampilkan konten tertanam dari layanan lain (misalnya video YouTube
                        atau peta), layanan tersebut dapat mengatur cookie mereka sendiri sesuai kebijakan
                        masing-masing. Kami menganjurkan Anda membaca kebijakan privasi layanan terkait.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">4. Mengelola Cookie</h2>
                    <p class="mb-3">
                        Anda dapat mengatur atau menghapus cookie melalui pengaturan peramban Anda.
                        Perlu diketahui bahwa menonaktifkan cookie teknis dapat menyebabkan beberapa fitur
                        (terutama login admin) tidak berfungsi.
                    </p>
                    <p>
                        Panduan umum: buka pengaturan peramban → Privasi / Cookie → hapus atau blokir cookie
                        untuk situs ini.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">5. Perubahan Kebijakan</h2>
                    <p>
                        Jika di kemudian hari kami menambahkan layanan analitik atau cookie non-wajib lainnya,
                        halaman ini akan diperbarui agar tetap transparan.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">6. Informasi Lebih Lanjut</h2>
                    <p>
                        Untuk penjelasan pengolahan data pribadi secara umum, lihat
                        <a href="{{ route('privacy') }}" class="text-green-600 hover:text-green-800 font-medium">Kebijakan Privasi</a>.
                        Pertanyaan dapat diajukan melalui
                        <a href="{{ route('kontak') }}" class="text-green-600 hover:text-green-800 font-medium">Kontak</a>
                        @if($profile?->email)
                            atau
                            <a href="mailto:{{ $profile->email }}" class="text-green-600 hover:text-green-800">{{ $profile->email }}</a>
                        @endif.
                    </p>
                </section>
            </div>
        </article>
    </div>
</div>
@endsection
