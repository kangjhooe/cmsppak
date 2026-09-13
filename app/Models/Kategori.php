<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'warna',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];


    public function berita(): BelongsToMany
    {
        return $this->belongsToMany(Berita::class, 'berita_kategori');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getBeritaCountAttribute()
    {
        return $this->berita()->count();
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($kategori) {
            if (empty($kategori->slug)) {
                $kategori->slug = \Illuminate\Support\Str::slug($kategori->nama);
            }
        });
        
        static::updating(function ($kategori) {
            if ($kategori->isDirty('nama') && empty($kategori->slug)) {
                $kategori->slug = \Illuminate\Support\Str::slug($kategori->nama);
            }
        });
    }
}
