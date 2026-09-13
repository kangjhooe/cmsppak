<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user pertama yang ada, atau buat user dummy jika belum ada
        $user = User::first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Administrator',
                'email' => 'admin@alfalahkrui.sch.id',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        $beritaData = [
            [
                'judul' => 'Pembukaan Tahun Ajaran Baru 2024/2025 dengan Semangat Baru',
                'ringkasan' => 'Tahun ajaran baru 2024/2025 telah dimulai di Pondok Pesantren Al-Falah Krui dengan berbagai kegiatan pembukaan yang meriah dan penuh semangat.',
                'konten' => '<h2>Pembukaan Tahun Ajaran Baru 2024/2025 dengan Semangat Baru</h2>
                <p>Tahun ajaran baru 2024/2025 telah dimulai di Pondok Pesantren Al-Falah Krui dengan berbagai kegiatan pembukaan yang meriah. Kegiatan pembukaan diawali dengan upacara bendera yang diikuti seluruh siswa, guru, dan staf sekolah.</p>
                <p>Setelah upacara, dilanjutkan dengan orientasi siswa baru yang akan berlangsung selama 3 hari. Orientasi ini meliputi pengenalan lingkungan sekolah, peraturan sekolah, dan berbagai kegiatan yang akan membantu siswa baru beradaptasi dengan lingkungan belajar yang baru.</p>
                <p>Kepala Sekolah, Dr. H. Ahmad Fauzi, M.Pd., dalam sambutannya menyampaikan harapan agar tahun ajaran ini dapat berjalan dengan lancar dan menghasilkan prestasi yang membanggakan. Beliau juga menekankan pentingnya menjaga semangat belajar dan disiplin dalam menjalani proses pendidikan.</p>
                <p>Selama orientasi, siswa baru akan diperkenalkan dengan berbagai program unggulan sekolah, fasilitas yang tersedia, dan kegiatan ekstrakurikuler yang dapat diikuti. Diharapkan dengan orientasi yang baik, siswa baru dapat segera beradaptasi dan aktif dalam berbagai kegiatan sekolah.</p>',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(1),
                'view_count' => 245,
                'meta_title' => 'Pembukaan Tahun Ajaran Baru 2024/2025 - Pondok Pesantren Al-Falah Krui',
                'meta_description' => 'Tahun ajaran baru 2024/2025 telah dimulai dengan berbagai kegiatan pembukaan yang meriah di Pondok Pesantren Al-Falah Krui.'
            ],
            [
                'judul' => 'Kunjungan Industri ke Pabrik Tekstil untuk Siswa Kelas XI',
                'ringkasan' => 'Sebanyak 45 siswa kelas XI melakukan kunjungan industri ke PT. Sinar Tekstil untuk mendapatkan wawasan praktis tentang dunia industri dan teknologi modern.',
                'konten' => '<h2>Kunjungan Industri ke Pabrik Tekstil untuk Siswa Kelas XI</h2>
                <p>Sebanyak 45 siswa kelas XI Pondok Pesantren Al-Falah Krui melakukan kunjungan industri ke PT. Sinar Tekstil yang berlokasi di Sidoarjo. Kunjungan ini bertujuan untuk memberikan wawasan praktis tentang dunia industri dan mempersiapkan siswa untuk memasuki dunia kerja.</p>
                <p>Selama kunjungan, siswa diajak melihat langsung proses produksi tekstil mulai dari bahan baku hingga produk jadi. Mereka juga mendapat penjelasan tentang teknologi modern yang digunakan dalam industri tekstil, termasuk penggunaan mesin-mesin canggih dan sistem manajemen kualitas.</p>
                <p>Kunjungan ini merupakan bagian dari program pembelajaran yang mengintegrasikan teori dengan praktik di dunia nyata, sehingga siswa dapat memahami aplikasi ilmu yang dipelajari di sekolah. Para siswa terlihat antusias mengikuti setiap sesi kunjungan dan banyak bertanya tentang proses produksi dan peluang karir di industri tekstil.</p>
                <p>Diharapkan dengan kunjungan ini, siswa dapat memperluas wawasan tentang dunia industri dan termotivasi untuk terus belajar dan mengembangkan diri sesuai dengan minat dan bakat masing-masing.</p>',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(3),
                'view_count' => 189,
                'meta_title' => 'Kunjungan Industri ke Pabrik Tekstil - Pondok Pesantren Al-Falah Krui',
                'meta_description' => 'Siswa kelas XI melakukan kunjungan industri ke PT. Sinar Tekstil untuk mendapatkan wawasan praktis tentang dunia industri.'
            ],
            [
                'judul' => 'Juara 1 Lomba Cerdas Cermat Antar Madrasah Se-Jawa Timur',
                'ringkasan' => 'Tim cerdas cermat Pondok Pesantren Al-Falah Krui berhasil meraih juara 1 dalam lomba cerdas cermat antar madrasah se-Jawa Timur yang diselenggarakan oleh Kanwil Kemenag Jatim.',
                'konten' => '<h2>Juara 1 Lomba Cerdas Cermat Antar Madrasah Se-Jawa Timur</h2>
                <p>Tim cerdas cermat Pondok Pesantren Al-Falah Krui yang terdiri dari 3 siswa berhasil meraih juara 1 dalam lomba cerdas cermat antar madrasah se-Jawa Timur yang diselenggarakan oleh Kanwil Kemenag Jatim.</p>
                <p>Prestasi ini membuktikan kualitas akademik siswa yang terus meningkat. Tim yang terdiri dari Ahmad Rizki (kelas XII), Siti Nurhaliza (kelas XI), dan Muhammad Fauzi (kelas X) berhasil mengalahkan 25 tim dari madrasah lain se-Jawa Timur.</p>
                <p>Lomba yang berlangsung selama 2 hari ini menguji pengetahuan siswa dalam berbagai mata pelajaran seperti Matematika, IPA, IPS, dan Bahasa Indonesia. Prestasi ini menjadi kebanggaan bagi seluruh warga sekolah dan motivasi untuk terus berprestasi.</p>
                <p>Kepala Sekolah menyampaikan apresiasi yang tinggi kepada tim yang telah mengharumkan nama sekolah. Beliau berharap prestasi ini dapat menjadi motivasi bagi siswa lain untuk terus belajar dan berprestasi di berbagai bidang.</p>',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(5),
                'view_count' => 312,
                'meta_title' => 'Juara 1 Lomba Cerdas Cermat - Pondok Pesantren Al-Falah Krui',
                'meta_description' => 'Tim cerdas cermat berhasil meraih juara 1 dalam lomba cerdas cermat antar madrasah se-Jawa Timur.'
            ],
            [
                'judul' => 'Kegiatan Bakti Sosial di Panti Asuhan Al-Ikhlas',
                'ringkasan' => 'Siswa-siswi Pondok Pesantren Al-Falah Krui mengadakan kegiatan bakti sosial di Panti Asuhan Al-Ikhlas dengan memberikan bantuan sembako dan mengadakan kegiatan edukatif.',
                'konten' => '<h2>Kegiatan Bakti Sosial di Panti Asuhan Al-Ikhlas</h2>
                <p>Siswa-siswi Pondok Pesantren Al-Falah Krui mengadakan kegiatan bakti sosial di Panti Asuhan Al-Ikhlas yang berlokasi di Kecamatan Pesisir Utara. Kegiatan ini merupakan bagian dari program pengabdian masyarakat yang rutin dilaksanakan setiap semester.</p>
                <p>Dalam kegiatan ini, siswa membawa bantuan sembako, pakaian layak pakai, dan perlengkapan sekolah untuk anak-anak panti asuhan. Selain itu, siswa juga mengadakan berbagai kegiatan edukatif seperti mengajar mengaji, belajar bersama, dan permainan edukatif yang menyenangkan.</p>
                <p>Kegiatan bakti sosial ini tidak hanya memberikan manfaat bagi penerima, tetapi juga memberikan pengalaman berharga bagi siswa dalam mengembangkan kepedulian sosial dan empati terhadap sesama. Melalui kegiatan ini, siswa belajar untuk berbagi dan peduli terhadap masyarakat sekitar.</p>
                <p>Kepala Panti Asuhan Al-Ikhlas menyampaikan terima kasih atas bantuan dan kunjungan dari Pondok Pesantren Al-Falah Krui. Beliau berharap kegiatan seperti ini dapat terus dilaksanakan untuk mempererat silaturahmi dan membantu sesama.</p>',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(7),
                'view_count' => 156,
                'meta_title' => 'Kegiatan Bakti Sosial di Panti Asuhan - Pondok Pesantren Al-Falah Krui',
                'meta_description' => 'Siswa-siswi mengadakan kegiatan bakti sosial di Panti Asuhan Al-Ikhlas dengan memberikan bantuan dan mengadakan kegiatan edukatif.'
            ],
            [
                'judul' => 'Workshop Penulisan Kreatif untuk Meningkatkan Literasi Siswa',
                'ringkasan' => 'Pondok Pesantren Al-Falah Krui mengadakan workshop penulisan kreatif yang diikuti oleh 50 siswa untuk meningkatkan kemampuan literasi dan menulis kreatif.',
                'konten' => '<h2>Workshop Penulisan Kreatif untuk Meningkatkan Literasi Siswa</h2>
                <p>Pondok Pesantren Al-Falah Krui mengadakan workshop penulisan kreatif yang diikuti oleh 50 siswa dari berbagai kelas. Workshop ini bertujuan untuk meningkatkan kemampuan literasi dan menulis kreatif siswa.</p>
                <p>Workshop dibawakan oleh penulis terkenal, Bapak Ahmad Dahlan, yang telah menerbitkan puluhan buku. Dalam workshop ini, siswa diajarkan teknik-teknik dasar menulis, cara mengembangkan ide, dan tips menulis yang menarik dan mudah dipahami.</p>
                <p>Selama workshop, siswa juga diberikan kesempatan untuk praktik menulis langsung dan mendapatkan feedback dari pemateri. Banyak siswa yang antusias mengikuti setiap sesi dan menghasilkan tulisan-tulisan kreatif yang menarik.</p>
                <p>Workshop ini diharapkan dapat meningkatkan minat baca dan tulis siswa, serta mengembangkan bakat menulis yang dimiliki siswa. Sekolah berencana untuk mengadakan workshop serupa secara rutin setiap semester.</p>',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(10),
                'view_count' => 203,
                'meta_title' => 'Workshop Penulisan Kreatif - Pondok Pesantren Al-Falah Krui',
                'meta_description' => 'Workshop penulisan kreatif diadakan untuk meningkatkan kemampuan literasi dan menulis kreatif siswa.'
            ],
            [
                'judul' => 'Peringatan Maulid Nabi Muhammad SAW dengan Khidmat',
                'ringkasan' => 'Pondok Pesantren Al-Falah Krui mengadakan peringatan Maulid Nabi Muhammad SAW dengan berbagai kegiatan keagamaan yang khidmat dan penuh hikmah.',
                'konten' => '<h2>Peringatan Maulid Nabi Muhammad SAW dengan Khidmat</h2>
                <p>Pondok Pesantren Al-Falah Krui mengadakan peringatan Maulid Nabi Muhammad SAW dengan berbagai kegiatan keagamaan yang khidmat dan penuh hikmah. Acara ini diikuti oleh seluruh siswa, guru, dan staf sekolah.</p>
                <p>Kegiatan dimulai dengan pembacaan shalawat dan doa bersama, dilanjutkan dengan ceramah agama yang membahas tentang kehidupan dan perjuangan Nabi Muhammad SAW. Ceramah disampaikan oleh Ustadz H. Muhammad Syafii, seorang ulama terkemuka di daerah ini.</p>
                <p>Selain ceramah, acara juga diisi dengan berbagai penampilan seni Islami seperti nasyid, pembacaan puisi Islami, dan drama tentang perjuangan Nabi Muhammad SAW. Semua penampilan disiapkan dengan baik oleh siswa dan guru.</p>
                <p>Peringatan Maulid Nabi ini menjadi momentum untuk meningkatkan kecintaan siswa terhadap Nabi Muhammad SAW dan meneladani akhlak mulia beliau dalam kehidupan sehari-hari. Acara berlangsung dengan khidmat dan penuh makna.</p>',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(12),
                'view_count' => 278,
                'meta_title' => 'Peringatan Maulid Nabi Muhammad SAW - Pondok Pesantren Al-Falah Krui',
                'meta_description' => 'Peringatan Maulid Nabi Muhammad SAW diadakan dengan berbagai kegiatan keagamaan yang khidmat dan penuh hikmah.'
            ],
            [
                'judul' => 'Pelatihan Kepemimpinan untuk Pengurus OSIS dan Organisasi Siswa',
                'ringkasan' => 'Sekolah mengadakan pelatihan kepemimpinan untuk pengurus OSIS dan organisasi siswa lainnya guna meningkatkan kemampuan kepemimpinan dan manajemen organisasi.',
                'konten' => '<h2>Pelatihan Kepemimpinan untuk Pengurus OSIS dan Organisasi Siswa</h2>
                <p>Sekolah mengadakan pelatihan kepemimpinan untuk pengurus OSIS dan organisasi siswa lainnya. Pelatihan ini bertujuan untuk meningkatkan kemampuan kepemimpinan dan manajemen organisasi para pengurus.</p>
                <p>Pelatihan dibawakan oleh trainer profesional, Ibu Siti Aisyah, yang memiliki pengalaman luas dalam bidang kepemimpinan dan manajemen organisasi. Materi yang disampaikan meliputi konsep kepemimpinan, komunikasi efektif, manajemen waktu, dan pengambilan keputusan.</p>
                <p>Selama pelatihan, peserta juga diberikan kesempatan untuk praktik langsung melalui simulasi dan role play. Para peserta terlihat antusias mengikuti setiap sesi dan aktif dalam diskusi serta praktik yang diberikan.</p>
                <p>Diharapkan dengan pelatihan ini, pengurus OSIS dan organisasi siswa dapat menjalankan tugasnya dengan lebih baik dan efektif, serta dapat menjadi contoh yang baik bagi siswa lainnya dalam hal kepemimpinan dan pengabdian.</p>',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(15),
                'view_count' => 167,
                'meta_title' => 'Pelatihan Kepemimpinan OSIS - Pondok Pesantren Al-Falah Krui',
                'meta_description' => 'Pelatihan kepemimpinan diadakan untuk pengurus OSIS dan organisasi siswa guna meningkatkan kemampuan kepemimpinan.'
            ],
            [
                'judul' => 'Festival Seni dan Budaya Islami 2024',
                'ringkasan' => 'Pondok Pesantren Al-Falah Krui mengadakan Festival Seni dan Budaya Islami 2024 yang menampilkan berbagai penampilan seni Islami dari siswa dan guru.',
                'konten' => '<h2>Festival Seni dan Budaya Islami 2024</h2>
                <p>Pondok Pesantren Al-Falah Krui mengadakan Festival Seni dan Budaya Islami 2024 yang menampilkan berbagai penampilan seni Islami dari siswa dan guru. Festival ini diadakan di halaman sekolah dan dihadiri oleh seluruh warga sekolah serta tamu undangan.</p>
                <p>Berbagai penampilan ditampilkan dalam festival ini, antara lain nasyid, qasidah, marawis, kaligrafi, dan drama Islami. Setiap kelas menampilkan penampilan terbaik mereka dengan persiapan yang matang dan penuh semangat.</p>
                <p>Festival ini tidak hanya menjadi ajang untuk menampilkan bakat seni siswa, tetapi juga menjadi sarana untuk memperkuat nilai-nilai Islami dan kebersamaan antar siswa. Semua penampilan disambut dengan antusias oleh penonton.</p>
                <p>Kepala Sekolah dalam sambutannya menyampaikan apresiasi yang tinggi kepada semua peserta yang telah mempersiapkan penampilan dengan baik. Beliau berharap festival seperti ini dapat terus dilaksanakan setiap tahun untuk mengembangkan bakat seni siswa dan memperkuat nilai-nilai Islami.</p>',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(18),
                'view_count' => 334,
                'meta_title' => 'Festival Seni dan Budaya Islami 2024 - Pondok Pesantren Al-Falah Krui',
                'meta_description' => 'Festival Seni dan Budaya Islami 2024 menampilkan berbagai penampilan seni Islami dari siswa dan guru.'
            ],
            [
                'judul' => 'Sosialisasi Program Beasiswa untuk Siswa Berprestasi',
                'ringkasan' => 'Sekolah mengadakan sosialisasi program beasiswa untuk siswa berprestasi yang diberikan oleh berbagai lembaga dan yayasan peduli pendidikan.',
                'konten' => '<h2>Sosialisasi Program Beasiswa untuk Siswa Berprestasi</h2>
                <p>Sekolah mengadakan sosialisasi program beasiswa untuk siswa berprestasi yang diberikan oleh berbagai lembaga dan yayasan peduli pendidikan. Sosialisasi ini diikuti oleh siswa kelas X, XI, dan XII beserta orang tua.</p>
                <p>Dalam sosialisasi ini, dijelaskan berbagai jenis beasiswa yang tersedia, syarat-syarat untuk mendapatkan beasiswa, dan cara mengajukan beasiswa. Beberapa jenis beasiswa yang disosialisasikan antara lain beasiswa prestasi akademik, beasiswa untuk siswa kurang mampu, dan beasiswa untuk siswa berprestasi di bidang non-akademik.</p>
                <p>Para siswa dan orang tua terlihat antusias mengikuti sosialisasi ini dan banyak yang bertanya tentang detail program beasiswa. Tim panitia sosialisasi memberikan penjelasan yang lengkap dan jelas tentang setiap program beasiswa yang tersedia.</p>
                <p>Program beasiswa ini diharapkan dapat membantu siswa yang berprestasi atau kurang mampu untuk dapat melanjutkan pendidikan dengan lebih baik. Sekolah akan terus mengupayakan kerjasama dengan berbagai lembaga untuk memperluas kesempatan beasiswa bagi siswa.</p>',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(20),
                'view_count' => 198,
                'meta_title' => 'Sosialisasi Program Beasiswa - Pondok Pesantren Al-Falah Krui',
                'meta_description' => 'Sosialisasi program beasiswa diadakan untuk memberikan informasi tentang berbagai program beasiswa yang tersedia.'
            ],
            [
                'judul' => 'Kegiatan Outbound untuk Meningkatkan Kerjasama Tim',
                'ringkasan' => 'Siswa kelas X mengikuti kegiatan outbound di Taman Wisata Alam untuk meningkatkan kerjasama tim, komunikasi, dan kepemimpinan melalui berbagai permainan dan tantangan.',
                'konten' => '<h2>Kegiatan Outbound untuk Meningkatkan Kerjasama Tim</h2>
                <p>Siswa kelas X mengikuti kegiatan outbound di Taman Wisata Alam yang berlokasi di Kecamatan Pesisir Utara. Kegiatan ini bertujuan untuk meningkatkan kerjasama tim, komunikasi, dan kepemimpinan melalui berbagai permainan dan tantangan.</p>
                <p>Kegiatan outbound diisi dengan berbagai permainan team building seperti flying fox, jembatan tali, dan permainan kerjasama tim lainnya. Setiap permainan dirancang untuk menguji kerjasama, komunikasi, dan kemampuan memecahkan masalah secara bersama-sama.</p>
                <p>Selama kegiatan, siswa terlihat sangat antusias dan aktif mengikuti setiap permainan. Banyak siswa yang belajar tentang pentingnya kerjasama tim dan komunikasi yang efektif dalam mencapai tujuan bersama. Kegiatan ini juga menjadi sarana untuk mempererat persahabatan antar siswa.</p>
                <p>Kegiatan outbound ini diharapkan dapat memberikan pengalaman berharga bagi siswa dalam hal kerjasama tim dan kepemimpinan, serta dapat diterapkan dalam kehidupan sehari-hari baik di sekolah maupun di lingkungan masyarakat.</p>',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(22),
                'view_count' => 221,
                'meta_title' => 'Kegiatan Outbound - Pondok Pesantren Al-Falah Krui',
                'meta_description' => 'Siswa kelas X mengikuti kegiatan outbound untuk meningkatkan kerjasama tim dan kepemimpinan melalui berbagai permainan.'
            ]
        ];

        foreach ($beritaData as $berita) {
            // Generate slug dari judul jika belum ada
            if (!isset($berita['slug'])) {
                $berita['slug'] = Str::slug($berita['judul']);
            }
            
            // Set user_id
            $berita['user_id'] = $user->id;
            
            // Pastikan slug unik dengan menambahkan angka jika perlu
            $originalSlug = $berita['slug'];
            $counter = 1;
            while (Berita::where('slug', $berita['slug'])->exists()) {
                $berita['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            Berita::create($berita);
        }

        $this->command->info('10 berita dummy berhasil dibuat!');
    }
}

