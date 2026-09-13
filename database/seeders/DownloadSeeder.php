<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Download;

class DownloadSeeder extends Seeder
{
    public function run(): void
    {
        // Create Sample Downloads
        $downloadsData = [
            [
                'judul' => 'Silabus Mata Pelajaran Matematika Kelas X',
                'deskripsi' => 'Silabus lengkap mata pelajaran Matematika untuk kelas X semester 1 dan 2 tahun ajaran 2024/2025.',
                'nama_file' => 'Silabus_Matematika_Kelas_X_2024-2025.pdf',
                'path_file' => 'downloads/silabus-matematika-kelas-x.pdf',
                'tipe_file' => 'pdf',
                'ukuran_file' => 2048576, // 2MB
                'jumlah_download' => 0,
                'kategori' => 'silabus',
                'is_active' => true
            ],
            [
                'judul' => 'Kurikulum Merdeka 2024',
                'deskripsi' => 'Dokumen kurikulum merdeka yang diterapkan di Pondok Pesantren Al-Falah Krui tahun 2024.',
                'nama_file' => 'Kurikulum_Merdeka_2024.pdf',
                'path_file' => 'downloads/kurikulum-merdeka-2024.pdf',
                'tipe_file' => 'pdf',
                'ukuran_file' => 3145728, // 3MB
                'jumlah_download' => 0,
                'kategori' => 'kurikulum',
                'is_active' => true
            ],
            [
                'judul' => 'Formulir Pendaftaran Siswa Baru',
                'deskripsi' => 'Formulir pendaftaran siswa baru untuk tahun ajaran 2024/2025.',
                'nama_file' => 'Formulir_Pendaftaran_Siswa_Baru_2024-2025.doc',
                'path_file' => 'downloads/formulir-pendaftaran-siswa-baru.doc',
                'tipe_file' => 'doc',
                'ukuran_file' => 1048576, // 1MB
                'jumlah_download' => 0,
                'kategori' => 'formulir',
                'is_active' => true
            ],
            [
                'judul' => 'Brosur Sekolah 2024',
                'deskripsi' => 'Brosur informasi lengkap Pondok Pesantren Al-Falah Krui tahun 2024.',
                'nama_file' => 'Brosur_Pondok_Pesantren_Al-Falah_Krui_2024.pdf',
                'path_file' => 'downloads/brosur-pondok-pesantren-alfalah-krui-2024.pdf',
                'tipe_file' => 'pdf',
                'ukuran_file' => 1572864, // 1.5MB
                'jumlah_download' => 0,
                'kategori' => 'brosur',
                'is_active' => true
            ]
        ];

        foreach ($downloadsData as $download) {
            Download::create($download);
        }
    }
}
