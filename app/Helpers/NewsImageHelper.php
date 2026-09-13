<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;

class NewsImageHelper
{
    /**
     * Dapatkan gambar untuk berita berdasarkan kategori
     */
    public static function getImageByCategory($kategori, $index = 0)
    {
        $config = Config::get('news_images.sample_images');
        $kategori = strtolower($kategori);
        
        if (isset($config[$kategori])) {
            $images = array_keys($config[$kategori]);
            if (isset($images[$index])) {
                return Config::get('news_images.directories.berita') . '/' . $images[$index];
            }
        }
        
        return Config::get('news_images.directories.default') . '/' . Config::get('news_images.default_image');
    }
    
    /**
     * Dapatkan gambar random untuk kategori tertentu
     */
    public static function getRandomImageByCategory($kategori)
    {
        $config = Config::get('news_images.sample_images');
        $kategori = strtolower($kategori);
        
        if (isset($config[$kategori])) {
            $images = array_keys($config[$kategori]);
            $randomImage = $images[array_rand($images)];
            return Config::get('news_images.directories.berita') . '/' . $randomImage;
        }
        
        return Config::get('news_images.directories.default') . '/' . Config::get('news_images.default_image');
    }
    
    /**
     * Dapatkan gambar default
     */
    public static function getDefaultImage()
    {
        return Config::get('news_images.directories.default') . '/' . Config::get('news_images.default_image');
    }
    
    /**
     * Dapatkan warna tema untuk kategori
     */
    public static function getCategoryColor($kategori)
    {
        $config = Config::get('news_images.category_colors');
        $kategori = strtolower($kategori);
        
        return $config[$kategori] ?? $config['default'];
    }
    
    /**
     * Dapatkan semua gambar contoh yang tersedia
     */
    public static function getAllSampleImages()
    {
        $config = Config::get('news_images.sample_images');
        $result = [];
        
        foreach ($config as $kategori => $images) {
            $result[$kategori] = [];
            foreach ($images as $filename => $description) {
                $result[$kategori][] = [
                    'filename' => $filename,
                    'path' => Config::get('news_images.directories.berita') . '/' . $filename,
                    'description' => $description,
                    'color' => self::getCategoryColor($kategori)
                ];
            }
        }
        
        return $result;
    }
    
    /**
     * Dapatkan URL gambar untuk view
     */
    public static function getImageUrl($imagePath)
    {
        if (empty($imagePath)) {
            return asset(Config::get('news_images.directories.default') . '/' . Config::get('news_images.default_image'));
        }
        
        return asset($imagePath);
    }
    
    /**
     * Dapatkan gambar yang sesuai untuk berita
     */
    public static function getImageForNews($berita)
    {
        if (!empty($berita->gambar_url)) {
            return self::getImageUrl($berita->gambar_url);
        }
        
        if (!empty($berita->kategori)) {
            return self::getImageUrl(self::getRandomImageByCategory($berita->kategori));
        }
        
        return self::getImageUrl(self::getDefaultImage());
    }
    
    /**
     * Dapatkan thumbnail untuk gambar
     */
    public static function getThumbnail($imagePath, $size = 'medium')
    {
        $config = Config::get('news_images.thumbnails');
        
        if (!isset($config[$size])) {
            $size = 'medium';
        }
        
        // Untuk saat ini return gambar asli
        // Bisa dikembangkan untuk membuat thumbnail otomatis
        return self::getImageUrl($imagePath);
    }
}
