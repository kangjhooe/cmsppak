<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageWidget extends Model
{
    use HasFactory;

    public const TYPES = [
        'prayer_times' => 'Waktu Sholat',
        'hijri_calendar' => 'Kalender Hijriyah',
        'agenda_mini' => 'Agenda Singkat',
        'quick_links' => 'Tautan Cepat',
        'custom_html' => 'HTML Kustom',
    ];

    protected $fillable = [
        'judul',
        'tipe',
        'config',
        'urutan',
        'status',
    ];

    protected $casts = [
        'config' => 'array',
    ];

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeUrut($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('id', 'asc');
    }

    public function getTipeLabelAttribute(): string
    {
        return self::TYPES[$this->tipe] ?? $this->tipe;
    }

    public function configValue(string $key, mixed $default = null): mixed
    {
        return data_get($this->config, $key, $default);
    }

    public function getIconAttribute(): string
    {
        return match ($this->tipe) {
            'prayer_times' => 'fas fa-mosque',
            'hijri_calendar' => 'fas fa-moon',
            'agenda_mini' => 'fas fa-calendar-check',
            'quick_links' => 'fas fa-link',
            default => 'fas fa-layer-group',
        };
    }

    public function getPaletteAttribute(): array
    {
        $palettes = [
            'prayer_times' => [
                'accent' => '#15803d',
                'accent-bright' => '#22c55e',
                'soft' => '#ecfdf5',
                'ink' => '#14532d',
                'shadow' => 'rgba(21, 128, 61, 0.28)',
            ],
            'hijri_calendar' => [
                'accent' => '#b45309',
                'accent-bright' => '#f59e0b',
                'soft' => '#fffbeb',
                'ink' => '#78350f',
                'shadow' => 'rgba(180, 83, 9, 0.28)',
            ],
            'agenda_mini' => [
                'accent' => '#1d4ed8',
                'accent-bright' => '#3b82f6',
                'soft' => '#eff6ff',
                'ink' => '#1e3a8a',
                'shadow' => 'rgba(29, 78, 216, 0.28)',
            ],
            'quick_links' => [
                'accent' => '#7c3aed',
                'accent-bright' => '#a78bfa',
                'soft' => '#f5f3ff',
                'ink' => '#4c1d95',
                'shadow' => 'rgba(124, 58, 237, 0.28)',
            ],
            'custom_html' => [
                'accent' => '#0f766e',
                'accent-bright' => '#14b8a6',
                'soft' => '#f0fdfa',
                'ink' => '#134e4a',
                'shadow' => 'rgba(15, 118, 110, 0.28)',
            ],
        ];

        return $palettes[$this->tipe] ?? $palettes['custom_html'];
    }
}
