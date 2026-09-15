@extends('layouts.frontend')

@section('title', 'Syarat Layanan - ' . ($profile->nama_sekolah ?? $schoolName))

@section('content')
<div class="bg-green-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        @include('frontend.legal.partials.nav')

        <article class="bg-white rounded-xl shadow-lg p-6 sm:p-10">
            <header class="mb-8 pb-6 border-b border-gray-100">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Syarat Layanan</h1>
                <p class="text-sm text-gray-500">Terakhir diperbarui: {{ date('d F Y') }}</p>
            </header>

            <div class="prose prose-green max-w-none text-gray-700 space-y-6">
                <p>
                    Dengan mengakses dan menggunakan situs web
                    <strong>{{ $profile->nama_sekolah ?? $schoolName }}</strong>,
                    Anda menyetujui Syarat Layanan berikut. Jika Anda tidak setuju, mohon untuk tidak
                    menggunakan situs ini.
                </p>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">1. Tujuan Situs</h2>
                    <p>
                        Situs ini merupakan kanal informasi resmi sekolah untuk menyampaikan profil,
                        berita, agenda, galeri, unduhan, dan layanan komunikasi terkait kegiatan sekolah.
                        Konten bersifat informatif dan dapat diperbarui sewaktu-waktu.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">2. Penggunaan yang Diizinkan</h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Mengakses informasi publik untuk keperluan pendidikan, informasi, atau komunikasi dengan sekolah.</li>
                        <li>Mengirim pesan, komentar, atau buku tamu dengan cara yang sopan dan relevan.</li>
                        <li>Mengunduh materi yang disediakan secara resmi pada halaman unduhan, sesuai ketentuan yang berlaku.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">3. Penggunaan yang Dilarang</h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Mengirim konten yang mengandung ujaran kebencian, pencemaran nama baik, pornografi, atau pelanggaran hukum.</li>
                        <li>Menyalahgunakan formulir (spam, phishing, atau pesan menyesatkan).</li>
                        <li>Mencoba mengakses area admin tanpa otorisasi, merusak sistem, atau mengganggu layanan situs.</li>
                        <li>Menyalin, menjual, atau memodifikasi konten situs untuk kepentingan komersial tanpa izin sekolah.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">4. Konten Pengguna</h2>
                    <p>
                        Komentar, pesan kontak, atau entri buku tamu yang Anda kirimkan menjadi tanggung jawab Anda.
                        Sekolah berhak meninjau, memoderasi, menyembunyikan, atau menghapus konten yang melanggar
                        aturan, tidak relevan, atau berpotensi merugikan pihak lain.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">5. Hak Kekayaan Intelektual</h2>
                    <p>
                        Logo, nama sekolah, teks, foto, video, dan materi lain pada situs ini dilindungi.
                        Penggunaan ulang memerlukan izin tertulis dari pihak sekolah, kecuali jika secara tegas
                        dinyatakan dapat dibagikan untuk keperluan non-komersial.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">6. Penafian</h2>
                    <p>
                        Kami berupaya menjaga akurasi informasi, namun tidak menjamin bahwa seluruh konten selalu
                        lengkap, mutakhir, atau bebas kesalahan. Informasi pada situs tidak menggantikan
                        pengumuman resmi yang disampaikan melalui saluran sekolah lainnya bila terdapat perbedaan.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">7. Ketersediaan Layanan</h2>
                    <p>
                        Situs dapat mengalami pemeliharaan, gangguan teknis, atau pembaruan tanpa pemberitahuan
                        sebelumnya. Kami tidak bertanggung jawab atas kerugian yang timbul semata-mata karena
                        situs tidak dapat diakses untuk sementara.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">8. Perubahan Syarat</h2>
                    <p>
                        Syarat Layanan ini dapat diperbarui. Penggunaan berkelanjutan setelah pembaruan
                        dianggap sebagai penerimaan terhadap ketentuan yang berlaku.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">9. Hukum yang Berlaku</h2>
                    <p>
                        Syarat ini tunduk pada hukum Republik Indonesia. Sengketa yang timbul diupayakan
                        diselesaikan secara musyawarah terlebih dahulu.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">10. Kontak</h2>
                    <p>
                        Pertanyaan terkait Syarat Layanan dapat disampaikan melalui halaman
                        <a href="{{ route('kontak') }}" class="text-green-600 hover:text-green-800 font-medium">Kontak</a>
                        @if($profile?->email)
                            atau email
                            <a href="mailto:{{ $profile->email }}" class="text-green-600 hover:text-green-800">{{ $profile->email }}</a>
                        @endif.
                    </p>
                </section>
            </div>
        </article>
    </div>
</div>
@endsection
