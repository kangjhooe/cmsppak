<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Konfigurasi Gambar Berita
    |--------------------------------------------------------------------------
    |
    | File ini berisi konfigurasi untuk gambar berita di aplikasi CMS sekolah.
    |
    */

    // Ukuran gambar standar
    'dimensions' => [
        'width' => 800,
        'height' => 400,
    ],

    // Kualitas kompresi JPG
    'quality' => 90,

    // Format yang didukung
    'supported_formats' => ['jpg', 'jpeg', 'png', 'webp'],

    // Direktori penyimpanan
    'directories' => [
        'berita' => 'public/images/berita',
        'default' => 'public/images',
    ],

    // Gambar contoh berdasarkan kategori
    'sample_images' => [
        'akademik' => [
            'berita-akademik-1.jpg' => 'Pendidikan Berkualitas',
            'berita-akademik-2.jpg' => 'Studi Belajar Efektif',
        ],
        'prestasi' => [
            'berita-prestasi-1.jpg' => 'Prestasi Membanggakan',
            'berita-prestasi-2.jpg' => 'Juara Kompetisi Nasional',
        ],
        'kegiatan' => [
            'berita-kegiatan-1.jpg' => 'Kegiatan Siswa Aktif',
            'berita-kegiatan-2.jpg' => 'Ekstrakurikuler Pengembangan Bakat',
        ],
        'non-akademik' => [
            'berita-umum-1.jpg' => 'Berita Informasi Terkini',
            'berita-umum-2.jpg' => 'Informasi Update Terbaru',
        ],
    ],

    // Gambar default
    'default_image' => 'default-news.jpg',

    // Warna tema untuk setiap kategori
    'category_colors' => [
        'akademik' => '#2563eb',      // Blue
        'prestasi' => '#f59e0b',      // Orange
        'kegiatan' => '#10b981',      // Green
        'non-akademik' => '#8b5cf6',  // Purple
        'default' => '#6b7280',       // Gray
    ],

    // Thumbnail settings
    'thumbnails' => [
        'small' => [300, 150],
        'medium' => [600, 300],
        'large' => [800, 400],
    ],

    // Watermark settings
    'watermark' => [
        'enabled' => false,
        'text' => env('NEWS_WATERMARK_TEXT', env('DEFAULT_SCHOOL_NAME', env('APP_NAME', 'CMS Sekolah'))),
        'position' => 'bottom-right',
        'opacity' => 0.7,
    ],

    // Upload settings
    'upload' => [
        'max_size' => 2048, // KB
        'allowed_types' => ['jpg', 'jpeg', 'png'],
        'auto_resize' => true,
        'create_thumbnails' => true,
    ],
];
