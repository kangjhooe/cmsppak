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
                'bg-light' => 'from-blue-50 to-blue-100',
                'text' => 'text-blue-700',
                'accent' => '#1d4ed8',
                'accent-bright' => '#3b82f6',
                'soft' => '#eff6ff',
                'ink' => '#1e3a8a',
                'shadow' => 'rgba(29, 78, 216, 0.28)',
            ],
            'green' => [
                'bg' => 'from-green-500 to-green-600',
                'bg-light' => 'from-green-50 to-green-100',
                'text' => 'text-green-700',
                'accent' => '#15803d',
                'accent-bright' => '#22c55e',
                'soft' => '#ecfdf5',
                'ink' => '#14532d',
                'shadow' => 'rgba(21, 128, 61, 0.28)',
            ],
            'purple' => [
                'bg' => 'from-purple-500 to-purple-600',
                'bg-light' => 'from-purple-50 to-purple-100',
                'text' => 'text-purple-700',
                'accent' => '#7c3aed',
                'accent-bright' => '#a78bfa',
                'soft' => '#f5f3ff',
                'ink' => '#4c1d95',
                'shadow' => 'rgba(124, 58, 237, 0.28)',
            ],
            'orange' => [
                'bg' => 'from-orange-500 to-orange-600',
                'bg-light' => 'from-orange-50 to-orange-100',
                'text' => 'text-orange-700',
                'accent' => '#c2410c',
                'accent-bright' => '#f97316',
                'soft' => '#fff7ed',
                'ink' => '#7c2d12',
                'shadow' => 'rgba(194, 65, 12, 0.28)',
            ],
            'pink' => [
                'bg' => 'from-pink-500 to-pink-600',
                'bg-light' => 'from-pink-50 to-pink-100',
                'text' => 'text-pink-700',
                'accent' => '#db2777',
                'accent-bright' => '#f472b6',
                'soft' => '#fdf2f8',
                'ink' => '#831843',
                'shadow' => 'rgba(219, 39, 119, 0.28)',
            ],
            'indigo' => [
                'bg' => 'from-indigo-500 to-indigo-600',
                'bg-light' => 'from-indigo-50 to-indigo-100',
                'text' => 'text-indigo-700',
                'accent' => '#4f46e5',
                'accent-bright' => '#818cf8',
                'soft' => '#eef2ff',
                'ink' => '#312e81',
                'shadow' => 'rgba(79, 70, 229, 0.28)',
            ],
        ];

        return $warnaMap[$this->warna] ?? $warnaMap['green'];
    }
}
