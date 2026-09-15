<?php

namespace App\Helpers;

use App\Models\Profile;
use Illuminate\Support\Facades\Schema;

class InstitutionHelper
{
    public const TYPES = ['sekolah', 'madrasah', 'pesantren'];

    public static function currentJenis(?Profile $profile = null): string
    {
        $jenis = $profile?->jenis_lembaga
            ?? config('institution.default', 'pesantren');

        return self::normalize($jenis);
    }

    public static function normalize(?string $jenis): string
    {
        $jenis = strtolower(trim((string) $jenis));

        return in_array($jenis, self::TYPES, true)
            ? $jenis
            : config('institution.default', 'pesantren');
    }

    public static function terms(?string $jenis = null, ?Profile $profile = null): array
    {
        $jenis = $jenis ? self::normalize($jenis) : self::currentJenis($profile);
        $all = config('institution.types', []);

        return $all[$jenis] ?? $all['pesantren'] ?? [];
    }

    public static function term(string $key, ?string $default = null, ?string $jenis = null): string
    {
        $terms = self::terms($jenis);
        $value = $terms[$key] ?? $default ?? $key;

        return is_string($value) ? $value : (string) ($default ?? $key);
    }

    public static function usesIslamicFeatures(?string $jenis = null, ?Profile $profile = null): bool
    {
        return (bool) (self::terms($jenis, $profile)['islamic_widgets'] ?? false);
    }

    public static function typeOptions(): array
    {
        $options = [];

        foreach (config('institution.types', []) as $key => $terms) {
            $options[$key] = $terms['label'] ?? ucfirst($key);
        }

        return $options;
    }

    public static function applyTranslations(?Profile $profile = null): void
    {
        $locale = app()->getLocale();
        $translator = app('translator');
        $translator->get('school');

        $lines = [];
        foreach (self::terms(null, $profile) as $key => $value) {
            if (is_string($value) && $key !== 'label') {
                $lines['*.'.$key] = $value;
            }
        }

        if ($lines !== []) {
            $translator->addLines($lines, $locale);
        }
    }

    public static function resolveProfile(): ?Profile
    {
        try {
            if (! Schema::hasTable('profiles')) {
                return null;
            }

            return Profile::query()->first();
        } catch (\Throwable) {
            return null;
        }
    }
}

if (! function_exists('term')) {
    function term(string $key, ?string $default = null): string
    {
        return \App\Helpers\InstitutionHelper::term($key, $default);
    }
}
