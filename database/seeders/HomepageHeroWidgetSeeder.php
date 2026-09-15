<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use App\Models\HomepageWidget;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomepageHeroWidgetSeeder extends Seeder
{
    public function run(): void
    {
        $profile = Profile::first();

        if (HeroSlide::count() === 0) {
            $source = null;

            if ($profile?->hero_image && Storage::disk('public')->exists($profile->hero_image)) {
                $source = storage_path('app/public/' . $profile->hero_image);
            } elseif (File::exists(public_path('images/hero/hero-main.jpg'))) {
                $source = public_path('images/hero/hero-main.jpg');
            }

            if ($source) {
                $filename = 'hero-slides/' . basename($source);
                Storage::disk('public')->put($filename, File::get($source));

                HeroSlide::create([
                    'judul' => $profile->nama_sekolah ?? 'Selamat Datang',
                    'subjudul' => 'Pendidikan berkualitas untuk membentuk generasi unggul',
                    'gambar' => $filename,
                    'link_url' => url('/profil'),
                    'link_teks' => 'Pelajari Lebih Lanjut',
                    'tampilkan_teks' => true,
                    'urutan' => 1,
                    'status' => 'aktif',
                ]);
            }
        }

        if (HomepageWidget::count() === 0) {
            $usesIslamic = \App\Helpers\InstitutionHelper::usesIslamicFeatures(
                $profile?->jenis_lembaga,
                $profile
            );

            $widgets = [];

            if ($usesIslamic) {
                $widgets[] = [
                    'judul' => 'Waktu Sholat',
                    'tipe' => 'prayer_times',
                    'config' => json_encode([
                        'lokasi_mode' => 'gps',
                        'kota' => 'Jakarta',
                        'kota_id' => '1301',
                        'tampilkan' => ['imsak', 'subuh', 'duha', 'dzuhur', 'ashar', 'maghrib', 'isya'],
                    ]),
                    'urutan' => 1,
                    'status' => 'aktif',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $widgets[] = [
                    'judul' => 'Kalender Hijriyah',
                    'tipe' => 'hijri_calendar',
                    'config' => json_encode([
                        'lokasi_mode' => 'gps',
                        'kota' => 'Jakarta',
                        'kota_id' => '1301',
                        'tampilkan_masehi' => true,
                    ]),
                    'urutan' => 2,
                    'status' => 'aktif',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $widgets[] = [
                'judul' => 'Agenda Terdekat',
                'tipe' => 'agenda_mini',
                'config' => json_encode(['limit' => 5]),
                'urutan' => $usesIslamic ? 3 : 1,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $widgets[] = [
                'judul' => 'Tautan Cepat',
                'tipe' => 'quick_links',
                'config' => json_encode([
                    'links' => [
                        ['label' => 'Profil', 'url' => url('/profil'), 'icon' => 'fas fa-school'],
                        ['label' => 'Berita', 'url' => url('/berita'), 'icon' => 'fas fa-newspaper'],
                        ['label' => 'Galeri', 'url' => url('/galeri'), 'icon' => 'fas fa-images'],
                        ['label' => 'Kontak', 'url' => url('/kontak'), 'icon' => 'fas fa-phone'],
                    ],
                ]),
                'urutan' => $usesIslamic ? 4 : 2,
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            HomepageWidget::insert($widgets);
        }
    }
}
