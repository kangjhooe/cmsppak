<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Download extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'judul',
        'deskripsi',
        'nama_file',
        'path_file',
        'tipe_file',
        'ukuran_file',
        'jumlah_download',
        'kategori',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'ukuran_file' => 'integer',
        'jumlah_download' => 'integer'
    ];

    public function getUkuranFileFormattedAttribute()
    {
        $bytes = $this->ukuran_file;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public function incrementDownload()
    {
        $this->increment('jumlah_download');
    }
}
