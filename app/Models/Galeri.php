<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'status'
    ];

    /**
     * Relasi ke galeri items
     */
    public function items()
    {
        return $this->hasMany(GaleriItem::class)->orderBy('urutan', 'asc');
    }

    /**
     * Relasi ke galeri items yang aktif
     */
    public function activeItems()
    {
        return $this->hasMany(GaleriItem::class)
            ->where('status', 'active')
            ->orderBy('urutan', 'asc')
            ->orderBy('created_at', 'desc');
    }

    /**
     * Relasi ke galeri items foto
     */
    public function fotoItems()
    {
        return $this->hasMany(GaleriItem::class)
            ->where('jenis', 'foto')
            ->where('status', 'active')
            ->orderBy('urutan', 'asc');
    }

    /**
     * Scope untuk galeri aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope untuk galeri berdasarkan kategori
     */
    public function scopeByCategory($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope untuk galeri berdasarkan jenis item
     */
    public function scopeByType($query, $jenis)
    {
        return $query->whereHas('activeItems', function($q) use ($jenis) {
            $q->where('jenis', $jenis);
        });
    }

    /**
     * Get jumlah item dalam galeri
     */
    public function getJumlahItemAttribute()
    {
        return $this->activeItems()->count();
    }

    /**
     * Get item pertama untuk thumbnail
     */
    public function getThumbnailItemAttribute()
    {
        // Jika activeItems sudah di-load, gunakan yang sudah ada
        if ($this->relationLoaded('activeItems')) {
            return $this->activeItems->first();
        }
        
        // Jika belum di-load, lakukan query
        return $this->activeItems()->first();
    }

    /**
     * Get URL thumbnail galeri
     */
    public function getThumbnailUrlAttribute()
    {
        $item = $this->thumbnailItem;
        if ($item) {
            return asset('storage/' . $item->file_path);
        }
        return asset('images/default-galeri.jpg');
    }
}
