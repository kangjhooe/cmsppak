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
                'bg-light' => 'from-green-100 to-green-200',
                'border' => 'border-green-200',
                'text' => 'text-green-600',
                'bg-overlay' => 'from-green-500/5 to-green-600/5'
            ],
            'blue' => [
                'bg' => 'from-blue-500 to-blue-600',
                'bg-light' => 'from-blue-100 to-blue-200',
                'border' => 'border-blue-200',
                'text' => 'text-blue-600',
                'bg-overlay' => 'from-blue-500/5 to-blue-600/5'
            ],
            'orange' => [
                'bg' => 'from-orange-500 to-orange-600',
                'bg-light' => 'from-orange-100 to-orange-200',
                'border' => 'border-orange-200',
                'text' => 'text-orange-600',
                'bg-overlay' => 'from-orange-500/5 to-orange-600/5'
            ],
            'purple' => [
                'bg' => 'from-purple-500 to-purple-600',
                'bg-light' => 'from-purple-100 to-purple-200',
                'border' => 'border-purple-200',
                'text' => 'text-purple-600',
                'bg-overlay' => 'from-purple-500/5 to-purple-600/5'
            ],
            'red' => [
                'bg' => 'from-red-500 to-red-600',
                'bg-light' => 'from-red-100 to-red-200',
                'border' => 'border-red-200',
                'text' => 'text-red-600',
                'bg-overlay' => 'from-red-500/5 to-red-600/5'
            ],
            'yellow' => [
                'bg' => 'from-yellow-500 to-yellow-600',
                'bg-light' => 'from-yellow-100 to-yellow-200',
                'border' => 'border-yellow-200',
                'text' => 'text-yellow-600',
                'bg-overlay' => 'from-yellow-500/5 to-yellow-600/5'
            ]
        ];

        return $warnaMap[$this->warna] ?? $warnaMap['green'];
    }
}
