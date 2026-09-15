<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\StorageHelper;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sekolah',
        'jenis_lembaga',
        'npsn',
        'alamat',
        'telepon',
        'email',
        'website',
        'facebook',
        'instagram',
        'youtube',
        'twitter',
        'tiktok',
        'whatsapp_admin',
        'jam_operasional',
        'koordinat_lat',
        'koordinat_lng',
        'koordinat_alt',
        'visi',
        'misi',
        'sejarah',
        'kepala_sekolah',
        'jumlah_siswa',
        'jumlah_guru',
        'jumlah_kelas',
        'tahun_berdiri',
        'fasilitas',
        'prestasi',
        'struktur_organisasi',
        'logo',
        'favicon',
        'foto_kepala_madrasah',
        'hero_image',
        // Field untuk mengelola konten halaman profil frontend
        'profil_hero_title',
        'profil_hero_subtitle',
        'profil_hero_description',
        'profil_show_statistics',
        'profil_show_contact',
        'profil_show_social_media',
        'profil_show_principal',
        'profil_show_vision_mission',
        'profil_show_history',
        'profil_show_facilities',
        'profil_show_achievements',
        'profil_show_organization',
        'profil_show_emergency_contact',
        'profil_custom_sections'
    ];

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return StorageHelper::url($this->logo);
        }
        return asset('images/default-logo.png');
    }

    public function getFaviconUrlAttribute()
    {
        if ($this->favicon) {
            return StorageHelper::url($this->favicon);
        }
        return asset('favicon.ico');
    }

    public function getFotoKepalaMadrasahUrlAttribute()
    {
        if ($this->foto_kepala_madrasah) {
            return StorageHelper::url($this->foto_kepala_madrasah);
        }
        return null;
    }

    public function getHeroImageUrlAttribute()
    {
        if ($this->hero_image) {
            return StorageHelper::url($this->hero_image);
        }
        return asset('images/hero/hero-main.jpg');
    }

    public function getKoordinatFormattedAttribute()
    {
        if ($this->koordinat_lat && $this->koordinat_lng) {
            return "{$this->koordinat_lat}, {$this->koordinat_lng}";
        }
        return null;
    }

    public function getGoogleMapsUrlAttribute()
    {
        if ($this->koordinat_lat && $this->koordinat_lng) {
            return "https://maps.google.com/?q={$this->koordinat_lat},{$this->koordinat_lng}";
        }
        return null;
    }

    public function getWazeUrlAttribute()
    {
        if ($this->koordinat_lat && $this->koordinat_lng) {
            return "https://waze.com/ul?ll={$this->koordinat_lat},{$this->koordinat_lng}&navigate=yes";
        }
        return null;
    }

    public function getWhatsappUrlAttribute()
    {
        if ($this->whatsapp_admin) {
            $phone = preg_replace('/[^0-9]/', '', $this->whatsapp_admin);
            return "https://wa.me/{$phone}";
        }
        return null;
    }

    public function getTeleponUrlAttribute()
    {
        if ($this->telepon) {
            $phone = preg_replace('/[^0-9]/', '', $this->telepon);
            return "tel:{$phone}";
        }
        return null;
    }

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'profil_show_statistics' => 'boolean',
            'profil_show_contact' => 'boolean',
            'profil_show_social_media' => 'boolean',
            'profil_show_principal' => 'boolean',
            'profil_show_vision_mission' => 'boolean',
            'profil_show_history' => 'boolean',
            'profil_show_facilities' => 'boolean',
            'profil_show_achievements' => 'boolean',
            'profil_show_organization' => 'boolean',
            'profil_show_emergency_contact' => 'boolean',
            'profil_custom_sections' => 'array',
        ];
    }

    /**
     * Get default values for profile frontend settings
     */
    public function getDefaultProfilSettings()
    {
        return [
            'profil_hero_title' => 'Profil ' . __('school'),
            'profil_hero_subtitle' => $this->nama_sekolah ?? '',
            'profil_hero_description' => $this->alamat ?? '',
            'profil_show_statistics' => true,
            'profil_show_contact' => true,
            'profil_show_social_media' => true,
            'profil_show_principal' => true,
            'profil_show_vision_mission' => true,
            'profil_show_history' => true,
            'profil_show_facilities' => true,
            'profil_show_achievements' => true,
            'profil_show_organization' => true,
            'profil_show_emergency_contact' => true,
            'profil_custom_sections' => []
        ];
    }

    /**
     * Check if a section should be shown
     */
    public function shouldShowSection($sectionName)
    {
        $value = $this->{$sectionName} ?? true;
        return $value === true || $value === 1 || $value === '1';
    }

    public function getJenisLembagaNormalizedAttribute(): string
    {
        return \App\Helpers\InstitutionHelper::normalize($this->jenis_lembaga);
    }

    public function usesIslamicFeatures(): bool
    {
        return \App\Helpers\InstitutionHelper::usesIslamicFeatures($this->jenis_lembaga, $this);
    }
}
