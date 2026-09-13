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
        
        return asset('images/default-thumbnail.jpg');
    }

    /**
     * Check apakah item adalah foto
     */
    public function isFoto()
    {
        return $this->jenis === 'foto';
    }
}
