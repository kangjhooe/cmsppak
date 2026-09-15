<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriItem extends Model
{
    use HasFactory;

    protected $table = 'galeri_items';

    protected $fillable = [
        'galeri_id',
        'judul',
        'deskripsi',
        'jenis',
        'file_path',
        'youtube_url',
        'thumbnail',
        'urutan',
        'status'
    ];

    /**
     * Relasi ke galeri
     */
    public function galeri()
    {
        return $this->belongsTo(Galeri::class);
    }

    /**
     * Scope untuk item aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope untuk item berdasarkan jenis
     */
    public function scopeByType($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }

    /**
     * Extract YouTube video ID from common URL formats.
     */
    public static function extractYoutubeId(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        $patterns = [
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/|youtube\.com\/live\/)([A-Za-z0-9_-]{11})/',
            '/(?:youtube\.com\/.*[?&]v=)([A-Za-z0-9_-]{11})/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }

    /**
     * Validate and normalize a YouTube URL (store watch URL).
     */
    public static function normalizeYoutubeUrl(?string $url): ?string
    {
        $id = self::extractYoutubeId($url);
        if (!$id) {
            return null;
        }

        return 'https://www.youtube.com/watch?v=' . $id;
    }

    public function getYoutubeIdAttribute(): ?string
    {
        return self::extractYoutubeId($this->youtube_url);
    }

    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        $id = $this->youtube_id;
        return $id ? 'https://www.youtube.com/embed/' . $id : null;
    }

    public function getYoutubeThumbnailUrlAttribute(): ?string
    {
        $id = $this->youtube_id;
        return $id ? 'https://img.youtube.com/vi/' . $id . '/hqdefault.jpg' : null;
    }

    /**
     * Preview/thumbnail URL for cards (foto file or YouTube thumb).
     */
    public function getPreviewUrlAttribute(): ?string
    {
        if ($this->jenis === 'youtube') {
            return $this->youtube_thumbnail_url;
        }

        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }

        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }

        return null;
    }

    /**
     * Get URL file
     */
    public function getFileUrlAttribute()
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return null;
    }

    /**
     * Get URL thumbnail
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }

        if ($this->jenis === 'youtube' && $this->youtube_thumbnail_url) {
            return $this->youtube_thumbnail_url;
        }

        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }

        return asset('images/default-thumbnail.jpg');
    }

    public function isFoto()
    {
        return $this->jenis === 'foto';
    }

    public function isYoutube()
    {
        return $this->jenis === 'youtube';
    }

    public function isVideo()
    {
        return $this->jenis === 'video';
    }
}
