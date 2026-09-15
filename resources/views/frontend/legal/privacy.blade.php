@extends('layouts.frontend')

@section('title', 'Kebijakan Privasi - ' . ($profile->nama_sekolah ?? $schoolName))

@section('content')
<div class="bg-green-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        @include('frontend.legal.partials.nav')

        <article class="bg-white rounded-xl shadow-lg p-6 sm:p-10">
            <header class="mb-8 pb-6 border-b border-gray-100">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Kebijakan Privasi</h1>
                <p class="text-sm text-gray-500">Terakhir diperbarui: {{ date('d F Y') }}</p>
            </header>

            <div class="prose prose-green max-w-none text-gray-700 space-y-6">
                <p>
                    Kebijakan Privasi ini menjelaskan bagaimana
                    <strong>{{ $profile->nama_sekolah ?? $schoolName }}</strong>
                    (“kami”) mengumpulkan, menggunakan, dan melindungi informasi yang Anda berikan
                    saat menggunakan situs web resmi sekolah ini.
                </p>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">1. Informasi yang Kami Kumpulkan</h2>
                    <p class="mb-3">Kami dapat mengumpulkan informasi berikut:</p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li><strong>Data yang Anda kirimkan sendiri</strong> — misalnya nama, email, nomor telepon, dan isi pesan melalui formulir kontak, buku tamu, atau komentar berita.</li>
                        <li><strong>Data teknis otomatis</strong> — seperti alamat IP, jenis peramban, perangkat, halaman yang dikunjungi, dan waktu kunjungan, untuk keperluan keamanan dan pemeliharaan situs.</li>
                        <li><strong>Data akun administrator</strong> — hanya untuk pengguna yang memiliki akses login ke panel admin (nama, email, dan kredensial akun).</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">2. Tujuan Penggunaan Data</h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Menyampaikan informasi publik sekolah (berita, agenda, galeri, unduhan, dan profil).</li>
                        <li>Menanggapi pertanyaan, pesan, atau komentar yang Anda kirimkan.</li>
                        <li>Menjaga keamanan, ketersediaan, dan kinerja situs.</li>
                        <li>Mengelola akses admin/operator sesuai peran yang ditetapkan sekolah.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">3. Penyimpanan dan Keamanan</h2>
                    <p>
                        Data disimpan pada sistem yang dikelola sekolah dan dilindungi dengan praktik keamanan yang wajar
                        (termasuk autentikasi untuk area admin). Kami tidak menjual data pribadi Anda kepada pihak ketiga.
                        Akses terhadap data terbatas pada personel yang berwenang.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">4. Berbagi Informasi</h2>
                    <p>
                        Kami tidak membagikan data pribadi kepada pihak luar kecuali jika diwajibkan oleh hukum,
                        diperlukan untuk melindungi hak dan keamanan sekolah/pengguna, atau Anda memberikan persetujuan.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">5. Hak Anda</h2>
                    <p class="mb-3">Anda dapat menghubungi kami untuk:</p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Meminta informasi mengenai data pribadi yang terkait dengan Anda.</li>
                        <li>Meminta perbaikan data yang tidak akurat.</li>
                        <li>Meminta penghapusan pesan/komentar yang Anda kirimkan, sepanjang tidak bertentangan dengan kewajiban hukum atau kebutuhan operasional sekolah.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">6. Cookie</h2>
                    <p>
                        Situs ini menggunakan cookie teknis yang diperlukan untuk menjalankan fitur dasar
                        (misalnya sesi login admin). Penjelasan lebih lanjut tersedia di
                        <a href="{{ route('cookies') }}" class="text-green-600 hover:text-green-800 font-medium">Kebijakan Cookie</a>.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">7. Perubahan Kebijakan</h2>
                    <p>
                        Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu.
                        Perubahan akan ditampilkan pada halaman ini beserta tanggal pembaruan.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-900 mb-3">8. Kontak</h2>
                    <p class="mb-2">
                        Jika ada pertanyaan terkait privasi data, silakan hubungi:
                    </p>
                    <ul class="list-none space-y-1 text-gray-700">
                        <li><strong>{{ $profile->nama_sekolah ?? $schoolName }}</strong></li>
                        @if($profile?->email)
                            <li>Email:
                                <a href="mailto:{{ $profile->email }}" class="text-green-600 hover:text-green-800">{{ $profile->email }}</a>
                            </li>
                        @endif
                        @if($profile?->telepon)
                            <li>Telepon:
                                <a href="tel:{{ $profile->telepon }}" class="text-green-600 hover:text-green-800">{{ $profile->telepon }}</a>
                            </li>
                        @endif
                        @if($profile?->alamat)
                            <li>Alamat: {{ $profile->alamat }}</li>
                        @endif
                        <li class="pt-2">
                            Atau kunjungi halaman
                            <a href="{{ route('kontak') }}" class="text-green-600 hover:text-green-800 font-medium">Kontak</a>.
                        </li>
                    </ul>
                </section>
            </div>
        </article>
    </div>
</div>
@endsection
