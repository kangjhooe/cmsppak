<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Ambil profile yang ada
$profile = App\Models\Profile::first();

if($profile) {
    // Cari logo terbaru di folder storage
    $logoPath = 'storage/app/public/logos';
    $logoFiles = glob($logoPath . '/*.{png,jpg,jpeg,gif}', GLOB_BRACE);
    
    if(!empty($logoFiles)) {
        // Ambil file logo terbaru
        $latestLogo = '';
        $latestTime = 0;
        
        foreach($logoFiles as $file) {
            $fileTime = filemtime($file);
            if($fileTime > $latestTime) {
                $latestTime = $fileTime;
                $latestLogo = $file;
            }
        }
        
        if($latestLogo) {
            // Konversi path ke format yang benar untuk database
            $relativePath = str_replace('storage/app/public/', '', $latestLogo);
            
            echo "Found logo: " . $latestLogo . "\n";
            echo "Relative path: " . $relativePath . "\n";
            
            // Update database
            $profile->logo = $relativePath;
            $profile->save();
            
            echo "Database updated successfully!\n";
            echo "New logo URL: " . $profile->logo_url . "\n";
        } else {
            echo "No valid logo files found\n";
        }
    } else {
        echo "No logo files found in storage\n";
    }
} else {
    echo "No profile found\n";
}
