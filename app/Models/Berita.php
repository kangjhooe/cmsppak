<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'gambar_utama',
        'status',
        'published_at',
        'view_count',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kategori(): BelongsToMany
    {
        return $this->belongsToMany(Kategori::class, 'berita_kategori');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->approved()->parents()->with('replies');
    }

    public function getGambarUrlAttribute()
    {
        if ($this->gambar_utama) {
            return asset('storage/' . $this->gambar_utama);
        }
        return asset('images/default-news.jpg');
    }

    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->konten), 200);
    }

    public function getShortExcerptAttribute()
    {
        return Str::limit(strip_tags($this->konten), 120);
    }

    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->konten));
        $minutesToRead = round($wordCount / 200); // Average reading speed: 200 words per minute
        return max(1, $minutesToRead);
    }

    public function getKategoriDisplayAttribute()
    {
        if ($this->kategori && $this->kategori->count() > 0) {
            return $this->kategori->pluck('nama')->join(', ');
        }
        return 'Tidak ada kategori';
    }

    public function hasKategori()
    {
        return $this->kategori && $this->kategori->count() > 0;
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeLatest($query, $limit = 6)
    {
        return $query->published()->latest('published_at')->limit($limit);
    }

    public function scopePopular($query, $limit = 6)
    {
        return $query->published()->orderBy('view_count', 'desc')->limit($limit);
    }

    public function scopeByKategori($query, $kategoriId)
    {
        return $query->whereHas('kategori', function($q) use ($kategoriId) {
            $q->where('kategori.id', $kategoriId);
        });
    }

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function($q) use ($searchTerm) {
            $q->where('judul', 'like', '%' . $searchTerm . '%')
              ->orWhere('konten', 'like', '%' . $searchTerm . '%');
        });
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
            
            // Auto-set published_at if status is published and published_at is empty
            if ($berita->status === 'published' && empty($berita->published_at)) {
                $berita->published_at = now();
            }
        });
        
        static::updating(function ($berita) {
            // Auto-set published_at if status is published and published_at is empty
            if ($berita->status === 'published' && empty($berita->published_at)) {
                $berita->published_at = now();
            }
        });
    }
}
