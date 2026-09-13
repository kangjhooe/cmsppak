<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'berita_id',
        'user_id',
        'nama',
        'email',
        'komentar',
        'status',
        'parent_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke Berita
    public function berita(): BelongsTo
    {
        return $this->belongsTo(Berita::class);
    }

    // Relasi ke User (optional, untuk user yang login)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke parent comment (untuk reply)
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Relasi ke child comments (replies)
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id')->where('status', 'approved');
    }

    // Scope untuk komentar yang approved
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Scope untuk komentar parent (bukan reply)
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    // Accessor untuk format tanggal
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d-m-Y H:i');
    }

    // Accessor untuk inisial nama
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->nama);
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return substr($initials, 0, 2);
    }
}
