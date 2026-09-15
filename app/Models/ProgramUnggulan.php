<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramUnggulan extends Model
{
    use HasFactory;

    protected $table = 'program_unggulan';

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
            'green' => [
                'bg' => 'from-green-500 to-green-600',
                'bg-light' => 'from-green-50 to-green-100',
                'border' => 'border-green-200',
                'text' => 'text-green-700',
                'bg-overlay' => 'from-green-500/5 to-green-600/5',
                'accent' => '#15803d',
                'accent-bright' => '#22c55e',
                'soft' => '#ecfdf5',
                'ink' => '#14532d',
                'shadow' => 'rgba(21, 128, 61, 0.28)',
            ],
            'blue' => [
                'bg' => 'from-blue-500 to-blue-600',
                'bg-light' => 'from-blue-50 to-blue-100',
                'border' => 'border-blue-200',
                'text' => 'text-blue-700',
                'bg-overlay' => 'from-blue-500/5 to-blue-600/5',
                'accent' => '#1d4ed8',
                'accent-bright' => '#3b82f6',
                'soft' => '#eff6ff',
                'ink' => '#1e3a8a',
                'shadow' => 'rgba(29, 78, 216, 0.28)',
            ],
            'orange' => [
                'bg' => 'from-orange-500 to-orange-600',
                'bg-light' => 'from-orange-50 to-orange-100',
                'border' => 'border-orange-200',
                'text' => 'text-orange-700',
                'bg-overlay' => 'from-orange-500/5 to-orange-600/5',
                'accent' => '#c2410c',
                'accent-bright' => '#f97316',
                'soft' => '#fff7ed',
                'ink' => '#7c2d12',
                'shadow' => 'rgba(194, 65, 12, 0.28)',
            ],
            'purple' => [
                'bg' => 'from-purple-500 to-purple-600',
                'bg-light' => 'from-purple-50 to-purple-100',
                'border' => 'border-purple-200',
                'text' => 'text-purple-700',
                'bg-overlay' => 'from-purple-500/5 to-purple-600/5',
                'accent' => '#7c3aed',
                'accent-bright' => '#a78bfa',
                'soft' => '#f5f3ff',
                'ink' => '#4c1d95',
                'shadow' => 'rgba(124, 58, 237, 0.28)',
            ],
            'red' => [
                'bg' => 'from-red-500 to-red-600',
                'bg-light' => 'from-red-50 to-red-100',
                'border' => 'border-red-200',
                'text' => 'text-red-700',
                'bg-overlay' => 'from-red-500/5 to-red-600/5',
                'accent' => '#dc2626',
                'accent-bright' => '#f87171',
                'soft' => '#fef2f2',
                'ink' => '#7f1d1d',
                'shadow' => 'rgba(220, 38, 38, 0.28)',
            ],
            'yellow' => [
                'bg' => 'from-yellow-500 to-yellow-600',
                'bg-light' => 'from-yellow-50 to-yellow-100',
                'border' => 'border-yellow-200',
                'text' => 'text-yellow-700',
                'bg-overlay' => 'from-yellow-500/5 to-yellow-600/5',
                'accent' => '#ca8a04',
                'accent-bright' => '#facc15',
                'soft' => '#fefce8',
                'ink' => '#713f12',
                'shadow' => 'rgba(202, 138, 4, 0.28)',
            ],
        ];

        return $warnaMap[$this->warna] ?? $warnaMap['green'];
    }
}
