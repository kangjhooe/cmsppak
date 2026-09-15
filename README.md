# CMS Pondok Pesantren Al-Falah Krui

Content Management System (CMS) untuk website pondok pesantren "Al-Falah Krui" yang dibangun menggunakan Laravel 10.

## Fitur Utama

### 🔐 Autentikasi & Keamanan
- Sistem login dengan Jetstream
- Role-based access control (Admin, Operator, Editor)
- Permission management dengan Spatie Laravel Permission
- Middleware keamanan untuk setiap role

### 🎛️ Admin Panel (`/admin`)
- **Dashboard**: Ringkasan data pondok pesantren
- **Manajemen User & Role**: Pengaturan user dan permission
- **Profil Pondok Pesantren**: Edit identitas, visi-misi, sejarah, kontak
- **Berita & Artikel**: Editor teks dengan upload gambar
- **Agenda/Kalender**: Manajemen kegiatan pesantren
- **Galeri**: Upload foto dan video dengan thumbnail
- **Buku Tamu**: Kelola pesan dari pengunjung

### 🌐 Frontend Publik
- **Homepage**: Slider, berita terbaru, agenda terdekat
- **Profil Pondok Pesantren**: Informasi lengkap pondok pesantren
- **Berita**: Listing dan detail artikel
- **Agenda**: Kalender kegiatan pondok pesantren
- **Galeri**: Tampilan foto dan video
- **Kontak**: Form buku tamu dengan reCAPTCHA

## Teknologi yang Digunakan

- **Backend**: Laravel 10
- **Frontend**: TailwindCSS, FontAwesome
- **Authentication**: Laravel Jetstream
- **Role & Permission**: Spatie Laravel Permission
- **Media Management**: Laravel Media Library
- **Database**: MySQL/SQLite
- **Editor**: CKEditor/TinyMCE (dapat ditambahkan)

## Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd cmsbq
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cmsbq
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Migration & Seeder
```bash
php artisan migrate
php artisan db:seed
```

### 6. Setup Storage
```bash
php artisan storage:link
```

### 7. Compile Assets
```bash
npm run build
```

### 8. Jalankan Server
```bash
php artisan serve
```

## Akun Default

Setelah menjalankan seeder, tersedia akun default:

### Admin
- Email: `admin@example.com`
- Password: `admin123`
- Role: Admin (akses penuh)

### Operator
- Email: `operator@example.com`
- Password: `operator123`
- Role: Operator (akses terbatas)

### Editor
- Email: `editor@example.com`
- Password: `editor123`
- Role: Editor (hanya berita & galeri)

## Struktur Database

### Tabel Utama
- `users` - Data pengguna sistem
- `roles` - Role pengguna
- `permissions` - Permission sistem
- `profiles` - Profil sekolah
- `berita` - Artikel dan berita
- `agenda` - Jadwal kegiatan
- `galeri` - Foto dan video
- `buku_tamu` - Pesan pengunjung

### Relasi
- User memiliki Role dan Permission
- Berita terkait dengan User (penulis)
- Semua tabel memiliki timestamps

## Struktur Folder

```
cmsbq/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Controller admin panel
│   │   └── Frontend/       # Controller frontend
│   ├── Models/             # Model database
│   └── Http/Middleware/    # Middleware custom
├── database/
│   ├── migrations/         # Struktur database
│   └── seeders/           # Data awal
├── resources/views/
│   ├── admin/             # View admin panel
│   └── frontend/          # View frontend
└── routes/
    └── web.php            # Definisi route
```

## Route Structure

### Frontend Routes
- `/` - Homepage
- `/profil` - Profil pondok pesantren
- `/berita` - Listing berita
- `/berita/{slug}` - Detail berita
- `/agenda` - Kalender agenda
- `/galeri` - Galeri foto & video
- `/kontak` - Halaman kontak

### Admin Routes (`/admin`)
- `/admin/dashboard` - Dashboard admin
- `/admin/profile` - Edit profil pondok pesantren
- `/admin/berita` - CRUD berita
- `/admin/agenda` - CRUD agenda
- `/admin/galeri` - CRUD galeri
- `/admin/buku-tamu` - Kelola buku tamu
- `/admin/users` - Manajemen user (admin only)
- `/admin/roles` - Manajemen role (admin only)

## Fitur Tambahan

### Upload File
- Logo pondok pesantren (gambar)
- Foto guru & staf (gambar)
- Gambar berita (gambar)
- File galeri (foto/video)
- Thumbnail galeri (gambar)

### Validasi Form
- Validasi server-side dengan Laravel
- Pesan error dalam bahasa Indonesia
- Validasi file upload (tipe, ukuran)

### Pagination
- Pagination untuk semua listing data
- Konfigurasi jumlah item per halaman

## Customization

### Mengubah Tema
- Edit file CSS di `resources/css/`
- Gunakan TailwindCSS utility classes
- Custom component di `resources/views/components/`

### Menambah Fitur
- Buat migration baru untuk tabel
- Buat model dengan relasi
- Buat controller dengan validasi
- Buat view dengan layout yang konsisten

### Mengubah Permission
- Edit seeder di `database/seeders/DatabaseSeeder.php`
- Tambah permission baru
- Assign permission ke role yang sesuai

## Deployment

### Production Server
1. Set `APP_ENV=production` di `.env`
2. Set `APP_DEBUG=false`
3. Optimize Laravel:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

### Web Server
- **Apache**: Pastikan mod_rewrite aktif
- **Nginx**: Gunakan konfigurasi Laravel standard
- **HTTPS**: Wajib untuk production

## Maintenance

### Backup Database
```bash
php artisan backup:run
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Update Dependencies
```bash
composer update
npm update
```

## Troubleshooting

### Common Issues
1. **Permission denied**: Pastikan folder `storage/` dan `bootstrap/cache/` writable
2. **Route not found**: Jalankan `php artisan route:clear`
3. **Database error**: Cek konfigurasi database di `.env`
4. **File upload error**: Pastikan `storage:link` sudah dibuat

### Log Files
- Laravel log: `storage/logs/laravel.log`
- Error log: Cek web server error log

## Support

Untuk bantuan teknis atau pertanyaan:
- Email: support@alfalahkrui.sch.id
- Dokumentasi: Lihat folder `docs/`
- Issue tracker: Gunakan fitur issue di repository

## License

Proyek ini dikembangkan untuk Pondok Pesantren Al-Falah Krui. Semua hak cipta dilindungi.

---

**Dibuat dengan ❤️ menggunakan Laravel 10**
