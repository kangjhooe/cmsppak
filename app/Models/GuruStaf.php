<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruStaf extends Model
{
    use HasFactory;

    protected $table = 'guru_staf';

    protected $fillable = [
        'nip',
        'nama_lengkap',
        'jabatan',
        'mata_pelajaran',
        'biodata',
        'foto',
        'email',
        'telepon',
        'status'
    ];

    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return asset('images/default-avatar.png');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Get kepala madrasah/sekolah
     */
    public function scopeKepalaMadrasah($query)
    {
        return $query->where('jabatan', 'kepala_sekolah')
                    ->orWhere('jabatan', 'kepala_madrasah')
                    ->where('status', 'aktif');
    }

    /**
     * Get kepala madrasah/sekolah yang aktif
     */
    public static function getKepalaMadrasah()
    {
        return self::kepalaMadrasah()->first();
    }
}
