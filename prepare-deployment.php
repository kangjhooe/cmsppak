<?php
/**
 * Script untuk mempersiapkan deployment ke hosting dengan document root di public_html
 * Jalankan script ini sebelum upload ke hosting
 */

echo "=== CMS Deployment Preparation ===\n";
echo "Memersiapkan file untuk deployment ke hosting...\n\n";

// 1. Copy semua file dari public/ ke root
echo "1. Menyalin file dari public/ ke root...\n";
$publicFiles = [
    'index.php',
    '.htaccess',
    'css/',
    'js/',
    'images/',
    'build/',
    'favicon.ico',
    'favicon.svg',
    'robots.txt',
    'site.webmanifest'
];

foreach ($publicFiles as $file) {
    $source = "public/" . $file;
    $destination = $file;
    
    if (is_dir($source)) {
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }
        copyDirectory($source, $destination);
        echo "   ✓ Folder $file berhasil disalin\n";
    } elseif (file_exists($source)) {
        copy($source, $destination);
        echo "   ✓ File $file berhasil disalin\n";
    }
}

// 2. Update index.php untuk path yang benar
echo "\n2. Mengupdate index.php...\n";
$indexContent = file_get_contents('public/index.php');
$indexContent = str_replace("__DIR__.'/../", "__DIR__.'/", $indexContent);
file_put_contents('index.php', $indexContent);
echo "   ✓ index.php berhasil diupdate\n";

// 3. Buat .htaccess untuk root
echo "\n3. Membuat .htaccess untuk root...\n";
$htaccessContent = file_get_contents('public/.htaccess');
file_put_contents('.htaccess', $htaccessContent);
echo "   ✓ .htaccess berhasil dibuat\n";

// 4. Buat file .env untuk hosting
echo "\n4. Membuat template .env untuk hosting...\n";
$envTemplate = file_get_contents('.env');
$envTemplate = str_replace('APP_URL=http://localhost', 'APP_URL=https://yourdomain.com', $envTemplate);
$envTemplate = str_replace('APP_DEBUG=true', 'APP_DEBUG=false', $envTemplate);
$envTemplate = str_replace('APP_ENV=local', 'APP_ENV=production', $envTemplate);
file_put_contents('.env.hosting', $envTemplate);
echo "   ✓ .env.hosting berhasil dibuat\n";

// 5. Buat file deployment info
echo "\n5. Membuat file deployment info...\n";
$deploymentInfo = "=== DEPLOYMENT INFO ===\n";
$deploymentInfo .= "Tanggal: " . date('Y-m-d H:i:s') . "\n";
$deploymentInfo .= "File yang perlu diupload ke public_html:\n";
$deploymentInfo .= "- Semua file dan folder di root project\n";
$deploymentInfo .= "- Ganti .env.hosting menjadi .env\n";
$deploymentInfo .= "- Set permission: chmod -R 755 storage/ bootstrap/cache/\n";
$deploymentInfo .= "- Import database: database/cmsbq_database.sql\n";
file_put_contents('DEPLOYMENT-INFO.txt', $deploymentInfo);
echo "   ✓ DEPLOYMENT-INFO.txt berhasil dibuat\n";

echo "\n=== SELESAI ===\n";
echo "File siap untuk diupload ke hosting!\n";
echo "Lihat DEPLOYMENT-INFO.txt untuk instruksi lengkap.\n";

function copyDirectory($src, $dst) {
    $dir = opendir($src);
    if (!is_dir($dst)) {
        mkdir($dst, 0755, true);
    }
    while (($file = readdir($dir)) !== false) {
        if ($file != '.' && $file != '..') {
            if (is_dir($src . '/' . $file)) {
                copyDirectory($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}
?>
