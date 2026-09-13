<?php

namespace App\Helpers;

class SafeCollectionHelper
{
    /**
     * Safe count method untuk collection yang mungkin null
     */
    public static function safeCount($collection)
    {
        if (is_null($collection)) {
            return 0;
        }
        
        if (is_array($collection)) {
            return count($collection);
        }
        
        if (method_exists($collection, 'count')) {
            return $collection->count();
        }
        
        return 0;
    }
    
    /**
     * Safe where method untuk collection yang mungkin null
     */
    public static function safeWhere($collection, $key, $value)
    {
        if (is_null($collection)) {
            return collect([]);
        }
        
        if (method_exists($collection, 'where')) {
            return $collection->where($key, $value);
        }
        
        return collect([]);
    }
    
    /**
     * Safe pluck method untuk collection yang mungkin null
     */
    public static function safePluck($collection, $key)
    {
        if (is_null($collection)) {
            return collect([]);
        }
        
        if (method_exists($collection, 'pluck')) {
            return $collection->pluck($key);
        }
        
        return collect([]);
    }
    
    /**
     * Safe unique method untuk collection yang mungkin null
     */
    public static function safeUnique($collection, $key = null)
    {
        if (is_null($collection)) {
            return collect([]);
        }
        
        if (method_exists($collection, 'unique')) {
            return $collection->unique($key);
        }
        
        return collect([]);
    }
}
