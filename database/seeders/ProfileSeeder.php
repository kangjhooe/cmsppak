<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Update atau create profile dengan data lengkap
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'nama_sekolah' => 'Pondok Pesantren Al-Falah Krui',
                'npsn' => '12345678',
                'alamat' => 'Jalan Raya Krui, Desa Krui, Kecamatan Pesisir Utara, Kabupaten Pesisir Barat, Lampung',
                'telepon' => '081274928879',
                'email' => 'info@alfalahkrui.sch.id',
                'website' => 'https://alfalahkrui.sch.id',
                'facebook' => 'https://web.facebook.com/alfalah.krui/',
                'instagram' => 'https://www.instagram.com/alfalah.krui',
                'youtube' => 'https://youtube.com/@alfalahkrui',
                'twitter' => 'https://twitter.com/alfalahkrui',
                'tiktok' => 'https://tiktok.com/@alfalah.krui',
                'whatsapp_admin' => '082316161699',
                'jam_operasional' => 'Senin-Jumat: 07:00-15:00 WIB, Sabtu: 07:00-12:00 WIB',
                'koordinat_lat' => -5.1868335,
                'koordinat_lng' => 103.9424996,
                'koordinat_alt' => 82,
                'visi' => 'Menjadi pondok pesantren yang unggul dalam membentuk generasi santri yang beriman, bertaqwa, berakhlak mulia, dan berprestasi tinggi.',
                'misi' => '1. Menyelenggarakan pendidikan pesantren yang berkualitas dengan mengintegrasikan ilmu pengetahuan dan teknologi dengan nilai-nilai Islam.\n2. Membentuk santri yang memiliki karakter Islami, mandiri, dan siap menghadapi tantangan global.\n3. Mengembangkan potensi santri secara optimal melalui kegiatan pembelajaran yang inovatif dan kreatif.',
                'sejarah' => 'Pondok Pesantren Al-Falah Krui didirikan pada tahun 1990 oleh Yayasan Al-Falah dengan visi untuk memberikan pendidikan berkualitas yang mengintegrasikan ilmu pengetahuan modern dengan nilai-nilai Islam. Berawal dari sebuah pesantren kecil dengan hanya 50 santri, kini telah berkembang menjadi salah satu pondok pesantren terkemuka di Lampung dengan ribuan santri dan berbagai prestasi akademik maupun non-akademik.',
                'kepala_sekolah' => 'Dr. H. Ahmad Fauzi, M.Pd.',
                'jumlah_siswa' => 500,
                'jumlah_guru' => 25,
                'jumlah_kelas' => 15,
                'tahun_berdiri' => 1990,
                'fasilitas' => '<h3>Fasilitas Utama</h3><ul><li>Masjid dengan kapasitas 500 jamaah</li><li>Perpustakaan dengan koleksi 10.000+ buku</li><li>Laboratorium Komputer dengan 30 PC</li><li>Laboratorium IPA (Fisika, Kimia, Biologi)</li><li>Laboratorium Bahasa dengan sistem multimedia</li><li>Ruang UKS dan Konseling</li><li>Kantin sehat dengan menu bergizi</li><li>Lapangan olahraga multifungsi</li><li>WiFi gratis di seluruh area pesantren</li><li>Parkir luas untuk santri dan tamu</li><li>Asrama santri putra dan putri</li><li>Ruang makan santri</li><li>Kamar mandi dan MCK yang memadai</li></ul>',
                'prestasi' => '<h3>Prestasi Akademik</h3><ul><li>Juara 1 Olimpiade Sains tingkat Kabupaten (2023)</li><li>Juara 2 Lomba Cerdas Cermat tingkat Provinsi (2023)</li><li>Juara 1 Lomba Debat Bahasa Inggris tingkat Kabupaten (2023)</li><li>Juara 3 Olimpiade Matematika tingkat Provinsi (2023)</li></ul><h3>Prestasi Non-Akademik</h3><ul><li>Juara 1 Lomba Adzan tingkat Kabupaten (2023)</li><li>Juara 2 Lomba Tahfidz Al-Qur\'an tingkat Provinsi (2023)</li><li>Juara 1 Lomba Kaligrafi tingkat Kabupaten (2023)</li><li>Juara 2 Lomba Marawis tingkat Provinsi (2023)</li></ul>',
                'struktur_organisasi' => '<h3>Struktur Organisasi Pondok Pesantren</h3><div style="text-align: center;"><h4>Pimpinan Pondok</h4><p><strong>Dr. H. Ahmad Fauzi, M.Pd.</strong></p><br><h4>Wakil Pimpinan</h4><p><strong>Siti Aminah, S.Pd.</strong></p><br><h4>Kepala Tata Usaha</h4><p><strong>Muhammad Rizki, S.Pd.</strong></p><br><h4>Wali Kelas</h4><p>15 Wali Kelas sesuai jumlah kelas</p><br><h4>Guru Mata Pelajaran</h4><p>25 Guru sesuai mata pelajaran</p><br><h4>Pengasuh Asrama</h4><p>10 Pengasuh Asrama Putra dan Putri</p><br><h4>Staf Administrasi</h4><p>5 Staf TU</p><br><h4>Petugas Kebersihan</h4><p>3 Petugas</p><br><h4>Petugas Keamanan</h4><p>2 Petugas</p></div>'
            ]
        );

        $this->command->info('Profile pondok pesantren berhasil diupdate dengan data lengkap!');
    }
}
