<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\Galeri;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $operatorRole = Role::firstOrCreate(['name' => 'operator']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);

        // Create Permissions
        $permissions = [
            'view_dashboard',
            'manage_users',
            'manage_roles',
            'manage_profile',
            'manage_berita',
            'manage_agenda',
            'manage_galeri',
            'manage_downloads',
            'manage_buku_tamu'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all());
        
        $operatorRole->givePermissionTo([
            'view_dashboard',
            'manage_profile',
            'manage_berita',
            'manage_agenda',
            'manage_galeri',
            'manage_downloads',
            'manage_buku_tamu'
        ]);
        
        $editorRole->givePermissionTo([
            'view_dashboard',
            'manage_berita',
            'manage_agenda',
            'manage_galeri',
            'manage_downloads'
        ]);

        // Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole($adminRole);

        // Create Operator User
        $operator = User::firstOrCreate(
            ['email' => 'operator@example.com'],
            [
                'name' => 'Operator',
                'password' => Hash::make('operator123'),
                'email_verified_at' => now(),
            ]
        );
        $operator->assignRole($operatorRole);

        // Create Editor User
        $editor = User::firstOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Editor',
                'password' => Hash::make('editor123'),
                'email_verified_at' => now(),
            ]
        );
        $editor->assignRole($editorRole);

        // Create Default Profile
        Profile::create([
            'nama_sekolah' => 'Pondok Pesantren Al-Falah Krui',
            'jenis_lembaga' => 'pesantren',
            'npsn' => '12345678',
            'alamat' => 'Jalan Pesantren, Desa Padang Rindu, Kecamatan Pesisir Utara, Kabupaten Pesisir Barat',
            'telepon' => '081274928879',
            'email' => 'info@alfalahkrui.sch.id',
            'website' => 'https://alfalahkrui.sch.id',
            'facebook' => 'https://facebook.com/alfalahkrui',
            'instagram' => 'https://instagram.com/alfalahkrui',
            'youtube' => 'https://youtube.com/@alfalahkrui',
            'twitter' => 'https://twitter.com/alfalahkrui',
            'whatsapp_admin' => '081274928879',
            'jam_operasional' => 'Senin-Jumat: 07:00-15:00 WIB, Sabtu: 07:00-12:00 WIB',
            'koordinat_lat' => -5.0371514,
            'koordinat_lng' => 103.7562727,
            'koordinat_alt' => 82,
            'visi' => 'Menjadi lembaga pendidikan Islam yang unggul dalam membentuk generasi yang beriman, bertaqwa, berakhlak mulia, dan berprestasi tinggi.',
            'misi' => '1. Menyelenggarakan pendidikan yang berkualitas dengan mengintegrasikan ilmu pengetahuan dan teknologi dengan nilai-nilai Islam.\n2. Membentuk peserta didik yang memiliki karakter Islami, mandiri, dan siap menghadapi tantangan global.\n3. Mengembangkan potensi peserta didik secara optimal melalui kegiatan pembelajaran yang inovatif dan kreatif.',
            'sejarah' => 'Pondok Pesantren Al-Falah Krui didirikan pada tahun 1990 oleh Yayasan Al-Falah dengan visi untuk memberikan pendidikan berkualitas yang mengintegrasikan ilmu pengetahuan modern dengan nilai-nilai Islam. Berawal dari sebuah pesantren kecil dengan hanya 50 santri, kini telah berkembang menjadi salah satu pesantren terkemuka di Lampung dengan ribuan santri dan berbagai prestasi akademik maupun non-akademik.',
            'kepala_sekolah' => 'Dr. H. Ahmad Fauzi, M.Pd.',
            'jumlah_siswa' => 500,
            'jumlah_guru' => 25,
            'jumlah_kelas' => 15,
            'tahun_berdiri' => 1990,
            'fasilitas' => '<h3>Fasilitas Utama</h3><ul><li>Masjid dengan kapasitas 500 jamaah</li><li>Perpustakaan dengan koleksi 10.000+ buku</li><li>Laboratorium Komputer dengan 30 PC</li><li>Laboratorium IPA (Fisika, Kimia, Biologi)</li><li>Laboratorium Bahasa dengan sistem multimedia</li><li>Ruang UKS dan Konseling</li><li>Kantin sehat dengan menu bergizi</li><li>Lapangan olahraga multifungsi</li><li>WiFi gratis di seluruh area sekolah</li><li>Parkir luas untuk siswa dan tamu</li></ul>',
            'prestasi' => '<h3>Prestasi Akademik</h3><ul><li>Juara 1 Olimpiade Sains tingkat Kabupaten (2023)</li><li>Juara 2 Lomba Cerdas Cermat tingkat Provinsi (2023)</li><li>Juara 1 Lomba Debat Bahasa Inggris tingkat Kabupaten (2023)</li><li>Juara 3 Olimpiade Matematika tingkat Provinsi (2023)</li></ul><h3>Prestasi Non-Akademik</h3><ul><li>Juara 1 Lomba Adzan tingkat Kabupaten (2023)</li><li>Juara 2 Lomba Tahfidz Al-Qur\'an tingkat Provinsi (2023)</li><li>Juara 1 Lomba Kaligrafi tingkat Kabupaten (2023)</li><li>Juara 2 Lomba Marawis tingkat Provinsi (2023)</li></ul>',
            'struktur_organisasi' => '<h3>Struktur Organisasi Sekolah</h3><div style="text-align: center;"><h4>Kepala Sekolah</h4><p><strong>Dr. H. Ahmad Fauzi, M.Pd.</strong></p><br><h4>Wakil Kepala Sekolah</h4><p><strong>Siti Aminah, S.Pd.</strong></p><br><h4>Kepala Tata Usaha</h4><p><strong>Muhammad Rizki, S.Pd.</strong></p><br><h4>Wali Kelas</h4><p>15 Wali Kelas sesuai jumlah kelas</p><br><h4>Guru Mata Pelajaran</h4><p>25 Guru sesuai mata pelajaran</p><br><h4>Staf Administrasi</h4><p>5 Staf TU</p><br><h4>Petugas Kebersihan</h4><p>3 Petugas</p><br><h4>Petugas Keamanan</h4><p>2 Petugas</p></div>'
        ]);

        // Create Sample Berita
        $beritaData = [
            [
                'judul' => 'Pembukaan Tahun Ajaran Baru 2024/2025',
                'slug' => 'pembukaan-tahun-ajaran-baru-2024-2025',
                'ringkasan' => 'Tahun ajaran baru 2024/2025 telah dimulai di Pondok Pesantren Al-Falah Krui dengan berbagai kegiatan pembukaan yang meriah.',
                'konten' => '<h2>Pembukaan Tahun Ajaran Baru 2024/2025</h2><p>Tahun ajaran baru 2024/2025 telah dimulai di Pondok Pesantren Al-Falah Krui. Kegiatan pembukaan diawali dengan upacara bendera yang diikuti seluruh siswa, guru, dan staf sekolah.</p><p>Setelah upacara, dilanjutkan dengan orientasi siswa baru yang akan berlangsung selama 3 hari. Orientasi ini meliputi pengenalan lingkungan sekolah, peraturan sekolah, dan berbagai kegiatan yang akan membantu siswa baru beradaptasi dengan lingkungan belajar yang baru.</p><p>Kepala Sekolah, Dr. H. Ahmad Fauzi, M.Pd., dalam sambutannya menyampaikan harapan agar tahun ajaran ini dapat berjalan dengan lancar dan menghasilkan prestasi yang membanggakan.</p>',
                'status' => 'published',
                'user_id' => $admin->id,
                'published_at' => now(),
            ],
            [
                'judul' => 'Kunjungan Industri ke Pabrik Tekstil',
                'slug' => 'kunjungan-industri-ke-pabrik-tekstil',
                'ringkasan' => 'Sebanyak 45 siswa kelas XI melakukan kunjungan industri ke PT. Sinar Tekstil untuk mendapatkan wawasan praktis tentang dunia industri.',
                'konten' => '<h2>Kunjungan Industri ke Pabrik Tekstil</h2><p>Sebanyak 45 siswa kelas XI Pondok Pesantren Al-Falah Krui melakukan kunjungan industri ke PT. Sinar Tekstil yang berlokasi di Sidoarjo. Kunjungan ini bertujuan untuk memberikan wawasan praktis tentang dunia industri dan mempersiapkan siswa untuk memasuki dunia kerja.</p><p>Selama kunjungan, siswa diajak melihat langsung proses produksi tekstil mulai dari bahan baku hingga produk jadi. Mereka juga mendapat penjelasan tentang teknologi modern yang digunakan dalam industri tekstil.</p><p>Kunjungan ini merupakan bagian dari program pembelajaran yang mengintegrasikan teori dengan praktik di dunia nyata, sehingga siswa dapat memahami aplikasi ilmu yang dipelajari di sekolah.</p>',
                'status' => 'published',
                'user_id' => $operator->id,
                'published_at' => now()->subDays(2),
            ],
            [
                'judul' => 'Juara 1 Lomba Cerdas Cermat Antar Madrasah',
                'slug' => 'juara-1-lomba-cerdas-cermat-antar-madrasah',
                'ringkasan' => 'Tim cerdas cermat Pondok Pesantren Al-Falah Krui berhasil meraih juara 1 dalam lomba cerdas cermat antar madrasah se-Jawa Timur.',
                'konten' => '<h2>Juara 1 Lomba Cerdas Cermat Antar Madrasah</h2><p>Tim cerdas cermat Pondok Pesantren Al-Falah Krui yang terdiri dari 3 siswa berhasil meraih juara 1 dalam lomba cerdas cermat antar madrasah se-Jawa Timur yang diselenggarakan oleh Kanwil Kemenag Jatim.</p><p>Prestasi ini membuktikan kualitas akademik siswa yang terus meningkat. Tim yang terdiri dari Ahmad Rizki (kelas XII), Siti Nurhaliza (kelas XI), dan Muhammad Fauzi (kelas X) berhasil mengalahkan 25 tim dari madrasah lain se-Jawa Timur.</p><p>Lomba yang berlangsung selama 2 hari ini menguji pengetahuan siswa dalam berbagai mata pelajaran seperti Matematika, IPA, IPS, dan Bahasa Indonesia. Prestasi ini menjadi kebanggaan bagi seluruh warga sekolah dan motivasi untuk terus berprestasi.</p>',
                'status' => 'published',
                'user_id' => $editor->id,
                'published_at' => now()->subDays(5),
            ]
        ];

        foreach ($beritaData as $berita) {
            Berita::create($berita);
        }

        // Create Sample Agenda
        $agendaData = [
            [
                'judul' => 'Rapat Koordinasi Guru',
                'deskripsi' => 'Rapat koordinasi bulanan untuk membahas program pembelajaran dan evaluasi siswa.',
                'tanggal_mulai' => now()->addDays(3),
                'tanggal_selesai' => now()->addDays(3),
                'waktu_mulai' => now()->addDays(3)->setTime(13, 0),
                'waktu_selesai' => now()->addDays(3)->setTime(15, 0),
                'lokasi' => 'Ruang Meeting Guru',
                'jenis' => 'non_akademik',
                'status' => 'upcoming'
            ],
            [
                'judul' => 'Ujian Tengah Semester',
                'deskripsi' => 'Pelaksanaan ujian tengah semester untuk semua mata pelajaran.',
                'tanggal_mulai' => now()->addDays(10),
                'tanggal_selesai' => now()->addDays(14),
                'waktu_mulai' => now()->addDays(10)->setTime(7, 0),
                'waktu_selesai' => now()->addDays(14)->setTime(12, 0),
                'lokasi' => 'Ruang Kelas',
                'jenis' => 'akademik',
                'status' => 'upcoming'
            ],
            [
                'judul' => 'Kunjungan Orang Tua',
                'deskripsi' => 'Kunjungan orang tua untuk membahas perkembangan akademik siswa.',
                'tanggal_mulai' => now()->addDays(20),
                'tanggal_selesai' => now()->addDays(20),
                'waktu_mulai' => now()->addDays(20)->setTime(8, 0),
                'waktu_selesai' => now()->addDays(20)->setTime(16, 0),
                'lokasi' => 'Aula Sekolah',
                'jenis' => 'umum',
                'status' => 'upcoming'
            ]
        ];

        foreach ($agendaData as $agenda) {
            Agenda::create($agenda);
        }

        // Create Sample Galeri
        $galeriData = [
            [
                'judul' => 'Upacara Bendera',
                'deskripsi' => 'Foto kegiatan upacara bendera setiap hari Senin.',
                'jenis' => 'foto',
                'file_path' => 'galeri/upacara-bendera.jpg',
                'thumbnail' => 'galeri/thumb-upacara-bendera.jpg',
                'status' => 'active'
            ],
            [
                'judul' => 'Kegiatan Belajar Mengajar',
                'deskripsi' => 'Foto kegiatan belajar mengajar di dalam kelas.',
                'jenis' => 'foto',
                'file_path' => 'galeri/belajar-mengajar.jpg',
                'thumbnail' => 'galeri/thumb-belajar-mengajar.jpg',
                'status' => 'active'
            ],
            [
                'judul' => 'Kegiatan Ekstrakurikuler',
                'deskripsi' => 'Video kegiatan ekstrakurikuler pramuka.',
                'jenis' => 'video',
                'file_path' => 'galeri/ekstrakurikuler-pramuka.mp4',
                'thumbnail' => 'galeri/thumb-pramuka.jpg',
                'status' => 'active'
            ]
        ];

        foreach ($galeriData as $galeri) {
            Galeri::create($galeri);
        }

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
            \App\Models\Download::create($download);
        }
    }
}
