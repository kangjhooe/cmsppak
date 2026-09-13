<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;
use App\Models\GaleriItem;
use Carbon\Carbon;

class GaleriDummySeeder extends Seeder
{
    public function run(): void
    {
        // Hapus galeri yang sudah ada jika ingin fresh start (optional)
        // Galeri::truncate();
        // GaleriItem::truncate();

        // Galeri 1: Kegiatan Belajar Mengajar
        $galeri1 = Galeri::create([
            'judul' => 'Kegiatan Belajar Mengajar 2024',
            'deskripsi' => 'Dokumentasi kegiatan belajar mengajar di kelas yang menunjukkan antusiasme siswa dalam pembelajaran. Foto-foto ini menampilkan berbagai aktivitas pembelajaran yang interaktif dan menyenangkan.',
            'kategori' => 'akademik',
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(5),
            'updated_at' => Carbon::now()->subDays(5),
        ]);

        // Item untuk galeri 1
        GaleriItem::create([
            'galeri_id' => $galeri1->id,
            'judul' => 'Siswa Sedang Belajar di Kelas',
            'deskripsi' => 'Momen siswa sedang fokus belajar di dalam kelas',
            'jenis' => 'foto',
            'file_path' => 'galeri/akademik/belajar-kelas-1.jpg',
            'urutan' => 1,
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(5),
            'updated_at' => Carbon::now()->subDays(5),
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri1->id,
            'judul' => 'Diskusi Kelompok',
            'deskripsi' => 'Siswa melakukan diskusi kelompok untuk menyelesaikan tugas',
            'jenis' => 'foto',
            'file_path' => 'galeri/akademik/diskusi-kelompok.jpg',
            'urutan' => 2,
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(5),
            'updated_at' => Carbon::now()->subDays(5),
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri1->id,
            'judul' => 'Presentasi Siswa',
            'deskripsi' => 'Siswa mempresentasikan hasil kerja kelompoknya',
            'jenis' => 'foto',
            'file_path' => 'galeri/akademik/presentasi-siswa.jpg',
            'urutan' => 3,
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(5),
            'updated_at' => Carbon::now()->subDays(5),
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri1->id,
            'judul' => 'Praktikum IPA',
            'deskripsi' => 'Kegiatan praktikum IPA di laboratorium',
            'jenis' => 'foto',
            'file_path' => 'galeri/akademik/praktikum-ipa.jpg',
            'urutan' => 4,
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(5),
            'updated_at' => Carbon::now()->subDays(5),
        ]);

        // Galeri 2: Prestasi dan Penghargaan
        $galeri2 = Galeri::create([
            'judul' => 'Prestasi dan Penghargaan 2024',
            'deskripsi' => 'Kumpulan foto prestasi dan penghargaan yang diraih oleh siswa dan sekolah. Dokumentasi ini mencatat berbagai pencapaian membanggakan di berbagai bidang akademik dan non-akademik.',
            'kategori' => 'prestasi',
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(3),
            'updated_at' => Carbon::now()->subDays(3),
        ]);

        // Item untuk galeri 2
        GaleriItem::create([
            'galeri_id' => $galeri2->id,
            'judul' => 'Penyerahan Piala Juara 1',
            'deskripsi' => 'Momen penyerahan piala juara 1 lomba cerdas cermat',
            'jenis' => 'foto',
            'file_path' => 'galeri/prestasi/penyerahan-piala.jpg',
            'urutan' => 1,
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(3),
            'updated_at' => Carbon::now()->subDays(3),
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri2->id,
            'judul' => 'Siswa Berprestasi',
            'deskripsi' => 'Foto siswa yang meraih prestasi di berbagai lomba',
            'jenis' => 'foto',
            'file_path' => 'galeri/prestasi/siswa-berprestasi.jpg',
            'urutan' => 2,
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(3),
            'updated_at' => Carbon::now()->subDays(3),
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri2->id,
            'judul' => 'Sertifikat Penghargaan',
            'deskripsi' => 'Koleksi sertifikat penghargaan yang diterima sekolah',
            'jenis' => 'foto',
            'file_path' => 'galeri/prestasi/sertifikat.jpg',
            'urutan' => 3,
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(3),
            'updated_at' => Carbon::now()->subDays(3),
        ]);

        // Galeri 3: Kegiatan Ekstrakurikuler
        $galeri3 = Galeri::create([
            'judul' => 'Kegiatan Ekstrakurikuler 2024',
            'deskripsi' => 'Dokumentasi berbagai kegiatan ekstrakurikuler yang diikuti siswa. Mulai dari pramuka, olahraga, seni, hingga kegiatan keagamaan yang mengembangkan bakat dan minat siswa.',
            'kategori' => 'kegiatan',
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(1),
            'updated_at' => Carbon::now()->subDays(1),
        ]);

        // Item untuk galeri 3
        GaleriItem::create([
            'galeri_id' => $galeri3->id,
            'judul' => 'Kegiatan Pramuka',
            'deskripsi' => 'Foto kegiatan pramuka di lapangan sekolah',
            'jenis' => 'foto',
            'file_path' => 'galeri/kegiatan/pramuka.jpg',
            'urutan' => 1,
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(1),
            'updated_at' => Carbon::now()->subDays(1),
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri3->id,
            'judul' => 'Lomba Olahraga',
            'deskripsi' => 'Kegiatan lomba olahraga antar kelas',
            'jenis' => 'foto',
            'file_path' => 'galeri/kegiatan/lomba-olahraga.jpg',
            'urutan' => 2,
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(1),
            'updated_at' => Carbon::now()->subDays(1),
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri3->id,
            'judul' => 'Pentas Seni',
            'deskripsi' => 'Penampilan siswa dalam pentas seni sekolah',
            'jenis' => 'foto',
            'file_path' => 'galeri/kegiatan/pentas-seni.jpg',
            'urutan' => 3,
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(1),
            'updated_at' => Carbon::now()->subDays(1),
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri3->id,
            'judul' => 'Kegiatan Keagamaan',
            'deskripsi' => 'Foto kegiatan keagamaan dan pengajian',
            'jenis' => 'foto',
            'file_path' => 'galeri/kegiatan/keagamaan.jpg',
            'urutan' => 4,
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(1),
            'updated_at' => Carbon::now()->subDays(1),
        ]);

        GaleriItem::create([
            'galeri_id' => $galeri3->id,
            'judul' => 'Kegiatan Outbound',
            'deskripsi' => 'Foto kegiatan outbound dan team building',
            'jenis' => 'foto',
            'file_path' => 'galeri/kegiatan/outbound.jpg',
            'urutan' => 5,
            'status' => 'active',
            'created_at' => Carbon::now()->subDays(1),
            'updated_at' => Carbon::now()->subDays(1),
        ]);

        $this->command->info('3 Galeri dummy berhasil dibuat!');
        $this->command->info('Total Galeri: ' . Galeri::count());
        $this->command->info('Total Item: ' . GaleriItem::count());
    }
}

