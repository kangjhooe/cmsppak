<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            [
                'nama' => 'Berita Umum',
                'slug' => 'berita-umum',
                'deskripsi' => 'Berita umum tentang lembaga',
                'warna' => '#3B82F6',
                'is_active' => true
            ],
            [
                'nama' => 'Prestasi',
                'slug' => 'prestasi',
                'deskripsi' => 'Prestasi dan pencapaian siswa',
                'warna' => '#10B981',
                'is_active' => true
            ],
            [
                'nama' => 'Kegiatan',
                'slug' => 'kegiatan',
                'deskripsi' => 'Kegiatan dan acara lembaga',
                'warna' => '#F59E0B',
                'is_active' => true
            ],
            [
                'nama' => 'Pendidikan',
                'slug' => 'pendidikan',
                'deskripsi' => 'Informasi seputar pendidikan',
                'warna' => '#8B5CF6',
                'is_active' => true
            ],
            [
                'nama' => 'Pengumuman',
                'slug' => 'pengumuman',
                'deskripsi' => 'Pengumuman penting',
                'warna' => '#EF4444',
                'is_active' => true
            ],
            [
                'nama' => 'Komunitas',
                'slug' => 'komunitas',
                'deskripsi' => 'Kehidupan komunitas dan kegiatan bersama',
                'warna' => '#06B6D4',
                'is_active' => true
            ],
            [
                'nama' => 'Keagamaan',
                'slug' => 'keagamaan',
                'deskripsi' => 'Konten keagamaan dan spiritual',
                'warna' => '#84CC16',
                'is_active' => true
            ],
            [
                'nama' => 'Olahraga',
                'slug' => 'olahraga',
                'deskripsi' => 'Kegiatan olahraga dan kesehatan',
                'warna' => '#F97316',
                'is_active' => true
            ]
        ];

        foreach ($kategori as $data) {
            Kategori::create($data);
        }
    }
}
