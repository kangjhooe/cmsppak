<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;
use App\Models\GaleriItem;

class GaleriMultiSeeder extends Seeder
{
    public function run(): void
    {
        // Galeri 1: Kegiatan Akademik 2024
        $galeri1 = Galeri::create([
            'judul' => 'Kegiatan Akademik 2024',
            'deskripsi' => 'Dokumentasi berbagai kegiatan akademik yang berlangsung di Pondok Pesantren Al-Falah Krui sepanjang tahun 2024',
            'kategori' => 'akademik',
            'status' => 'active'
        ]);

        // Item untuk galeri 1
        GaleriItem::create([
            'galeri_id' => $galeri1->id,
            'judul' => 'Pembukaan Kelas Baru',
            'deskripsi' => 'Momen pembukaan kelas baru untuk tahun ajaran 2024/2025',
            'jenis' => 'foto',
            'file_path' => 'galeri/akademik/pembukaan-kelas.jpg',
            'urutan' => 1,
            'status' => 'active'
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri1->id,
            'judul' => 'Kegiatan Belajar Mengajar',
            'deskripsi' => 'Suasana belajar mengajar yang aktif dan interaktif',
            'jenis' => 'foto',
            'file_path' => 'galeri/akademik/belajar-mengajar.jpg',
            'urutan' => 2,
            'status' => 'active'
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri1->id,
            'judul' => 'Presentasi Siswa',
            'deskripsi' => 'Siswa mempresentasikan hasil penelitian mereka',
            'jenis' => 'video',
            'file_path' => 'galeri/akademik/presentasi-siswa.mp4',
            'thumbnail' => 'galeri/akademik/presentasi-thumbnail.jpg',
            'urutan' => 3,
            'status' => 'active'
        ]);

        // Galeri 2: Prestasi Siswa 2024
        $galeri2 = Galeri::create([
            'judul' => 'Prestasi Siswa 2024',
            'deskripsi' => 'Kumpulan prestasi dan pencapaian siswa Pondok Pesantren Al-Falah Krui di berbagai kompetisi',
            'kategori' => 'prestasi',
            'status' => 'active'
        ]);

        // Item untuk galeri 2
        GaleriItem::create([
            'galeri_id' => $galeri2->id,
            'judul' => 'Pemenang Lomba Matematika',
            'deskripsi' => 'Siswa yang berhasil memenangkan lomba matematika tingkat kabupaten',
            'jenis' => 'foto',
            'file_path' => 'galeri/prestasi/pemenang-matematika.jpg',
            'urutan' => 1,
            'status' => 'active'
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri2->id,
            'judul' => 'Penampilan Seni Budaya',
            'deskripsi' => 'Video penampilan seni budaya siswa dalam festival daerah',
            'jenis' => 'video',
            'file_path' => 'galeri/prestasi/seni-budaya.mp4',
            'thumbnail' => 'galeri/prestasi/seni-budaya-thumbnail.jpg',
            'urutan' => 2,
            'status' => 'active'
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri2->id,
            'judul' => 'Penyerahan Piala',
            'deskripsi' => 'Momen penyerahan piala dan sertifikat kepada siswa berprestasi',
            'jenis' => 'foto',
            'file_path' => 'galeri/prestasi/penyerahan-piala.jpg',
            'urutan' => 3,
            'status' => 'active'
        ]);

        // Galeri 3: Acara Sekolah 2024
        $galeri3 = Galeri::create([
            'judul' => 'Acara Sekolah 2024',
            'deskripsi' => 'Berbagai acara dan kegiatan sekolah yang diselenggarakan sepanjang tahun 2024',
            'kategori' => 'acara',
            'status' => 'active'
        ]);

        // Item untuk galeri 3
        GaleriItem::create([
            'galeri_id' => $galeri3->id,
            'judul' => 'Upacara Bendera',
            'deskripsi' => 'Upacara bendera setiap hari Senin yang diikuti seluruh warga sekolah',
            'jenis' => 'foto',
            'file_path' => 'galeri/acara/upacara-bendera.jpg',
            'urutan' => 1,
            'status' => 'active'
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri3->id,
            'judul' => 'Kegiatan Ekstrakurikuler',
            'deskripsi' => 'Video kegiatan ekstrakurikuler yang diikuti siswa',
            'jenis' => 'video',
            'file_path' => 'galeri/acara/ekstrakurikuler.mp4',
            'thumbnail' => 'galeri/acara/ekstrakurikuler-thumbnail.jpg',
            'urutan' => 2,
            'status' => 'active'
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri3->id,
            'judul' => 'Kunjungan Industri',
            'deskripsi' => 'Foto-foto kunjungan industri ke berbagai perusahaan',
            'jenis' => 'foto',
            'file_path' => 'galeri/acara/kunjungan-industri.jpg',
            'urutan' => 3,
            'status' => 'active'
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri3->id,
            'judul' => 'Workshop Guru',
            'deskripsi' => 'Kegiatan workshop dan pelatihan untuk meningkatkan kompetensi guru',
            'jenis' => 'foto',
            'file_path' => 'galeri/acara/workshop-guru.jpg',
            'urutan' => 4,
            'status' => 'active'
        ]);

        $this->command->info('Galeri multi-media berhasil dibuat!');
        $this->command->info('Total Galeri: ' . Galeri::count());
        $this->command->info('Total Item: ' . GaleriItem::count());
    }
}
