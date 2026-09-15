<?php

namespace App\Models;

use App\Helpers\StorageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'subjudul',
        'gambar',
        'link_url',
        'link_teks',
        'tampilkan_teks',
        'urutan',
        'status',
    ];

    protected $casts = [
        'tampilkan_teks' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('id', 'asc');
    }

    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar) {
            return StorageHelper::url($this->gambar);
        }

        return asset('images/hero/hero-main.jpg');
    }
}
