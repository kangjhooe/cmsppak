<?php
/**
 * Script untuk memperbaiki masalah path gambar di hosting
 * Jalankan script ini setelah upload ke hosting
 */

echo "=== FIX HOSTING PATHS SCRIPT ===\n";
echo "Memperbaiki masalah logo dan foto pimpinan yang tidak muncul...\n\n";

// 1. Buat symbolic link storage jika belum ada
echo "1. Memeriksa symbolic link storage...\n";
$storageLink = public_path('storage');
$storageTarget = storage_path('app/public');

if (!is_link($storageLink) && !is_dir($storageLink)) {
    if (symlink($storageTarget, $storageLink)) {
        echo "   ✓ Symbolic link storage berhasil dibuat\n";
    } else {
        echo "   ✗ Gagal membuat symbolic link storage\n";
    }
} else {
    echo "   ✓ Symbolic link storage sudah ada\n";
}

// 2. Periksa file logo dan foto di database
echo "\n2. Memeriksa data logo dan foto di database...\n";

try {
    // Load Laravel environment
    require_once __DIR__ . '/vendor/autoload.php';
    $app = require_once __DIR__ . '/bootstrap/app.php';
    $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    
    $profile = \App\Models\Profile::first();
    
    if ($profile) {
        echo "   ✓ Data profile ditemukan\n";
        
        // Periksa logo
        if ($profile->logo) {
            $logoPath = storage_path('app/public/' . $profile->logo);
            if (file_exists($logoPath)) {
                echo "   ✓ File logo ditemukan: " . $profile->logo . "\n";
            } else {
                echo "   ✗ File logo tidak ditemukan: " . $profile->logo . "\n";
            }
        } else {
            echo "   ⚠ Logo belum diupload\n";
        }
        
        // Periksa foto kepala madrasah
        if ($profile->foto_kepala_madrasah) {
            $fotoPath = storage_path('app/public/' . $profile->foto_kepala_madrasah);
            if (file_exists($fotoPath)) {
                echo "   ✓ File foto kepala madrasah ditemukan: " . $profile->foto_kepala_madrasah . "\n";
            } else {
                echo "   ✗ File foto kepala madrasah tidak ditemukan: " . $profile->foto_kepala_madrasah . "\n";
            }
        } else {
            echo "   ⚠ Foto kepala madrasah belum diupload\n";
        }
        
    } else {
        echo "   ✗ Data profile tidak ditemukan\n";
    }
    
} catch (Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

// 3. Periksa permission folder storage
echo "\n3. Memeriksa permission folder storage...\n";
$storageDir = storage_path('app/public');
if (is_writable($storageDir)) {
    echo "   ✓ Folder storage dapat ditulis\n";
} else {
    echo "   ✗ Folder storage tidak dapat ditulis\n";
    echo "   Jalankan: chmod -R 755 " . $storageDir . "\n";
}

// 4. Periksa file .env
echo "\n4. Memeriksa konfigurasi .env...\n";
$envFile = base_path('.env');
if (file_exists($envFile)) {
    echo "   ✓ File .env ditemukan\n";
    
    $envContent = file_get_contents($envFile);
    if (strpos($envContent, 'APP_URL=') !== false) {
        echo "   ✓ APP_URL sudah dikonfigurasi\n";
    } else {
        echo "   ⚠ APP_URL belum dikonfigurasi\n";
    }
    
    if (strpos($envContent, 'APP_ENV=production') !== false) {
        echo "   ✓ Environment sudah di-set ke production\n";
    } else {
        echo "   ⚠ Environment belum di-set ke production\n";
    }
} else {
    echo "   ✗ File .env tidak ditemukan\n";
}

// 5. Test URL generation
echo "\n5. Testing URL generation...\n";
try {
    if (isset($profile) && $profile) {
        $logoUrl = $profile->logo_url;
        echo "   Logo URL: " . $logoUrl . "\n";
        
        $fotoUrl = $profile->foto_kepala_madrasah_url;
        echo "   Foto URL: " . ($fotoUrl ?: 'Tidak ada foto') . "\n";
    }
} catch (Exception $e) {
    echo "   ✗ Error testing URL: " . $e->getMessage() . "\n";
}

echo "\n=== SELESAI ===\n";
echo "Jika masih ada masalah, periksa:\n";
echo "1. Pastikan file .env sudah dikonfigurasi dengan benar\n";
echo "2. Pastikan APP_URL sesuai dengan domain hosting\n";
echo "3. Pastikan folder storage memiliki permission yang benar\n";
echo "4. Upload ulang logo dan foto pimpinan melalui admin panel\n";
echo "5. Clear cache: php artisan cache:clear && php artisan config:clear\n";
?>
