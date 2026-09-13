<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $table = 'features';

    protected $fillable = [
        'judul',
        'deskripsi',
        'icon',
        'warna',
        'urutan',
        'status'
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan', 'asc');
    }

    public function getWarnaClassesAttribute()
    {
        $warnaMap = [
            'blue' => [
                'bg' => 'from-blue-500 to-blue-600',
            ],
            'green' => [
                'bg' => 'from-green-500 to-green-600',
            ],
            'purple' => [
                'bg' => 'from-purple-500 to-purple-600',
            ],
            'orange' => [
                'bg' => 'from-orange-500 to-orange-600',
            ],
            'pink' => [
                'bg' => 'from-pink-500 to-pink-600',
            ],
            'indigo' => [
                'bg' => 'from-indigo-500 to-indigo-600',
            ]
        ];

        return $warnaMap[$this->warna] ?? $warnaMap['blue'];
    }
}
