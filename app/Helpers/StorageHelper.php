<?php

namespace App\Helpers;

class StorageHelper
{
    /**
     * Generate correct storage URL for hosting environment
     */
    public static function url($path)
    {
        if (empty($path)) {
            return null;
        }

        // Always use standard storage path for both local and hosting
        return asset('storage/' . $path);
    }

    /**
     * Generate correct storage URL for hosting environment (alias)
     */
    public static function storageUrl($path)
    {
        return self::url($path);
    }
}

